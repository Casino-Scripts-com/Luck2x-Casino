process.env['NODE_TLS_REJECT_UNAUTHORIZED'] = 0;

let fs 				= require('fs'),
	config 			= require('./config.js'),
	app             = require('express')(),
	server,
	getProtocolOptions = () => config.https ? {
		protocol: 'https',
		protocolOptions: {
			key: fs.readFileSync(config.ssl.key),
			cert: fs.readFileSync(config.ssl.cert)
		}
	} : {
		protocol: 'http'
	},
	options 		= getProtocolOptions(),
	fakeStatus		= 0;


if(options.protocol == 'https') server = require('https').createServer(options.protocolOptions, app); 
else server = require('http').createServer(app);  

let	io              = require('socket.io')(server),
double          = new (require('./double'))(io, config.domain),
	redis 			= require('redis'),
    redisClient 	= redis.createClient({
		path : '/var/run/redis/redis.sock'
	}),
	requestify 		= require('requestify'),
	acho 			= require('acho'),
	log 			= acho({
		upper: true
	}),
	online 			= 40,
	ipsConnected	= [],
	kingTimer = 0,
	kingStart = 0;

server.listen(config.port);
log.info('The local server is running on '+ options.protocol + '://' + config.domain + ':' + config.port);

double.start();

io.sockets.on('connection', function(socket) {
	var address = socket.handshake.address;
	if(!ipsConnected.hasOwnProperty(address)) {
		ipsConnected[address] = 1;
		online = online + 1;
	}
	updateOnline(online);
    socket.on('disconnect', function() {
		if(ipsConnected.hasOwnProperty(address)) {
			delete ipsConnected[address];
			online = online - 1;
		}
		updateOnline(online);
	});
});

function updateOnline(online) {
	io.sockets.emit('online', online);
//	requestify.post(options.protocol + '://' + config.domain + '/api/getOnline')
//	.then(function(response) {
//		var res = JSON.parse(response.body);
//		io.sockets.emit('online', online+res);
//	},function(response){
//		log.error('Error in function [getOnline]');
//	});
}

redisClient.subscribe('message');
redisClient.subscribe('chat.clear');
redisClient.subscribe('new.msg');
redisClient.subscribe('del.msg');
redisClient.subscribe('ban.msg');
redisClient.subscribe('updateBalance');
redisClient.subscribe('updateBalanceAfter');
redisClient.subscribe('updateBonus');
redisClient.subscribe('updateBonusAfter');
redisClient.subscribe('wheel');
redisClient.subscribe('jackpot.timer');
redisClient.subscribe('jackpot.slider');
redisClient.subscribe('jackpot');
redisClient.subscribe('new.flip');
redisClient.subscribe('end.flip');
redisClient.subscribe('battle.newBet');
redisClient.subscribe('battle.startTime');
redisClient.subscribe('dice');
redisClient.subscribe('bonus');
redisClient.subscribe('updateKing');
redisClient.subscribe('mines');
redisClient.subscribe('roulette');

redisClient.on('message', function(channel, message) {
	if(channel == 'chat.clear') io.sockets.emit('clear', JSON.parse(message));
	if(channel == 'new.msg') io.sockets.emit('chat', JSON.parse(message));
	if(channel == 'del.msg') io.sockets.emit('chatdel', JSON.parse(message));
	if(channel == 'ban.msg') io.sockets.emit('ban_message', JSON.parse(message));
	if(channel == 'updateKing') {
		console.log('Bet received')
		kingTimer = 10;
		message = JSON.parse(message);
		if(Number(message.players.length >= 2)) {
			startKingTimer()
		}
		io.sockets.emit('updateKing', message);
		return;
	}
	if(channel == 'updateBalanceAfter') {
		message = JSON.parse(message);
		setTimeout(function() {
			io.sockets.emit('updateBalance', message);
		}, message.timer*1000);
	}
	if(channel == 'updateBonusAfter') {
		message = JSON.parse(message);
		setTimeout(function() {
			io.sockets.emit('updateBonus', message);
		}, message.timer*1000);
	}
	if(channel == 'jackpot.timer') {
		message = JSON.parse(message);
		startJackpotTimer(message);
		return;
	}
	if(channel == 'battle.startTime') {
		message = JSON.parse(message);
        startBattleTimer(message.time);
        return;
    }
	if(channel == 'wheel' && JSON.parse(message).type == 'wheel_timer') {
		message = JSON.parse(message);
        startWheelTimer(message.timer[2]);
		return;
    }

	if(channel == 'roulette' && JSON.parse(message).type == 'back_timer') {
        message = JSON.parse(message);
        return double.startTimer(message.timer);
    }
	if(typeof message == 'string') return io.sockets.emit(channel, JSON.parse(message));
	io.sockets.emit(channel, message);
});
/* King */
function startKingTimer(res) {
	if(kingStart == 1) return;
	kingStart = 1;
	let timer = setInterval(() => {
		if(kingTimer <= 0) {
			clearInterval(timer);
			io.sockets.emit('kingTimer', {
				type: 'timer',
				data: {
					timer: (kingTimer >= 10) ? '00:'+kingTimer : '00:0'+kingTimer
				}
			});
			endKingGame()
			return;
		}
		kingTimer--;
		io.sockets.emit('kingTimer', {
			type: 'timer',
			data: {
				timer: (kingTimer >= 10) ? '00:'+kingTimer : '00:0'+kingTimer
			}
		});
	}, 1*1000)
}
function endKingGame() {
	requestify.post(options.protocol + '://' + config.domain + '/api/king/slider')
    .then(function(res) {
		io.sockets.emit('kingWinner', {
			type: 'win',
			data: {
	
			}
		});
		kingStart = 0;
		setTimeout(() => {
			newKingGame()
		}, 3000);
    }, function(res) {
    	endKingGame()
		log.error('Error in function king slider');
    });
}
function newKingGame() {
	requestify.post(options.protocol + '://' + config.domain + '/api/king/newGame')
    .then(function(res) {
		io.sockets.emit('kingClear', {
			type: 'clear',
			data: {
			}
		});
		kingStart = 10;
    }, function(res) {
    	newKingGame()
		log.error('Error in function king newGame');
    });
}
/* Jackpot */

var currentTimers = [];
function startJackpotTimer(res) {
	if(typeof currentTimers[res.room] == 'undefined') currentTimers[res.room] = 0;
	if(currentTimers[res.room] != 0 && (currentTimers[res.room] - new Date().getTime()) < ((res.time+1)*1000)) return;
	currentTimers[res.room] = new Date().getTime();
	let time = res.time;
	let timer = setInterval(() => {
		if(time <= 0) {
			clearInterval(timer);
			io.sockets.emit('jackpot', {
				type: 'timer',
				room: res.room,
				data: {
					min: Math.floor(time/60),
					sec: time-(Math.floor(time/60)*60)
				}
			});
			currentTimers[res.room] = 0;
			showJackpotSlider(res.room, res.game);
			return;
		}
		time--;
		io.sockets.emit('jackpot', {
			type: 'timer',
			room: res.room,
			data: {
				min: Math.floor(time/60),
				sec: time-(Math.floor(time/60)*60)
			}
		});
	}, 1*1000)
}

function showJackpotSlider(room, game) {
	requestify.post(options.protocol + '://' + config.domain + '/api/jackpot/slider', {
		room: room,
		game: game
	})
    .then(function(res) {
		let timeout = setTimeout(() => {
			clearInterval(timeout);
			newJackpotGame(room);
		}, 12*1000)
    }, function(res) {
		log.error('Error in function slider');
    });
}

function newJackpotGame(room) {
	requestify.post(options.protocol + '://' + config.domain + '/api/jackpot/newGame', {
        room : room
    })
    .then(function(res) {
        res = JSON.parse(res.body);
		io.sockets.emit('jackpot', {
			type: 'newGame',
			room: room,
			data: res
		});
    }, function(res) {
		log.error('[ROOM '+room+'] Error in function newGame');
    });
}

function getStatusJackpot(room) {
	requestify.post(options.protocol + '://' + config.domain + '/api/jackpot/getGame', {
        room : room
    })
	.then(function(res) {
		res = JSON.parse(res.body);
		if(res.status == 1) startJackpotTimer(res);
		if(res.status == 2) showJackpotSlider(res.room, res.game);
		if(res.status == 3) newJackpotGame(res.room);
	}, function(res) {
        log.error(res);
		log.error('[ROOM '+room+'] Error in function getStatusJackpot');
	});
}

requestify.post(options.protocol + '://' + config.domain + '/api/jackpot/getRooms')
.then(function(res) {
	rooms = JSON.parse(res.body);
	rooms.forEach(function(room) {
		getStatusJackpot(room.name);
	});
}, function(res) {
	log.error('[APP] Error in function getRooms');
});

/* Wheel */
function startWheelTimer(time) {
	updateWheelStatus(1);
	let timer = setInterval(() => {
		if(time <= 0) {
			clearInterval(timer);
			io.sockets.emit('wheel', {
				type: 'timer',
				min: Math.floor(time/60),
				sec: time-(Math.floor(time/60)*60)
			});
			showWheelSlider();
			return;
		}
		time--;
		io.sockets.emit('wheel', {
			type: 'timer',
			min: Math.floor(time/60),
			sec: time-(Math.floor(time/60)*60)
		});
	}, 1*1000)
}

function showWheelSlider() {
	updateWheelStatus(2);
	requestify.post(options.protocol + '://' + config.domain + '/api/wheel/slider')
    .then(function(res) {
        res = JSON.parse(res.body);
		updateWheelStatus(3);
		setTimeout(() => {
            newWheelGame();
        }, res.time);
    }, function(res) {
		log.error('Error in function wheelSlider');
    });
}

function newWheelGame() {
	requestify.post(options.protocol + '://' + config.domain + '/api/wheel/newGame')
    .then(function(res) {
        res = JSON.parse(res.body);
    }, function(res) {
		log.error('Error in function wheelNewGame');
    });
}

function updateWheelStatus(status) {
	requestify.post(options.protocol + '://' + config.domain + '/api/wheel/updateStatus', {
        status : status
    })
    .then(function(res) {
        res = JSON.parse(res.body);
    }, function(res) {
		log.error('Error in function wheelNewGame');
    });
}

requestify.post(options.protocol + '://' + config.domain + '/api/wheel/getGame')
.then(function(res) {
	res = JSON.parse(res.body);
	if(res.status == 1) startWheelTimer(res.timer[2]);
	if(res.status == 2) startWheelTimer(res.timer[2]);
	if(res.status == 3) newWheelGame();
}, function(res) {
	log.error('Error in function wheelGetGame');
});

/*Battle*/
function startBattleTimer(time) {
	setBattleStatus(1);
	let timer = setInterval(() => {
		if(time <= 0) {
			clearInterval(timer);
			io.sockets.emit('battle.timer', {
				min: Math.floor(time/60),
				sec: time-(Math.floor(time/60)*60)
			});
			setBattleStatus(2);
			showBattleWinners();
			return;
		}
		time--;
		io.sockets.emit('battle.timer', {
			min: Math.floor(time/60),
			sec: time-(Math.floor(time/60)*60)
		});
	}, 1*1000)
}

function showBattleWinners() {
    requestify.post(options.protocol + '://' + config.domain + '/api/battle/getSlider')
    .then(function(res) {
        res = JSON.parse(res.body);
        io.sockets.emit('battle.slider', res);
		setBattleStatus(3);
		ngTimerBattle();
    }, function(res) {
        log.error('[BATTLE] Error in function getSlider');
		setTimeout(BattleShowWinners, 1000);
    });
}

function ngTimerBattle() {
	var ngtime = 6;
	var battlengtimer = setInterval(function() {
		ngtime--;
		if(ngtime <= 0) {
			clearInterval(battlengtimer);
			newBattleGame();
		}
	}, 1000);
}

function newBattleGame() {
    requestify.post(options.protocol + '://' + config.domain + '/api/battle/newGame')
    .then(function(res) {
        res = JSON.parse(res.body);
        io.sockets.emit('battle.newGame', res);
    }, function(res) {
        log.error('[BATTLE] Error in function newGame');
		setTimeout(newBattleGame, 1000);
    });
}

function setBattleStatus(status) {
    requestify.post(options.protocol + '://' + config.domain + '/api/battle/setStatus', {
		status : status
    })
    .then(function(res) {
        status = JSON.parse(res.body);
    }, function(res) {
        log.error('[BATTLE] Error in function setStatus');
		setTimeout(setBattleStatus, 1000);
    });
}

requestify.post(options.protocol + '://' + config.domain + '/api/battle/getStatus')
.then(function(res) {
	res = JSON.parse(res.body);
	if(res.status == 1) startBattleTimer(res.time);
	if(res.status == 2) startBattleTimer(res.time);
	if(res.status == 3) newBattleGame();
}, function(res) {
	log.error('[BATTLE] Error in function getStatus');
});

function HiloNewGame() {
    requestify.post(options.protocol + '://' + config.domain + '/api/hilo/newGame')
    .then(function(res) {
        res = JSON.parse(res.body);
        io.sockets.emit('hilo.newGame', res);
		HiloStartTimer(res.time);
    }, function(res) {
        log.error('[HILO] Error in function newGame');
		setTimeout(HiloNewGame, 1000);
    });
}

function HiloStartTimer(times) {
	var preFinish = false;
	var hiloTimer,
		time = times*100;
	HiloSetStatus(1);
	clearInterval(hiloTimer);
    hiloTimer = null;
    hiloTimer = setInterval(function() {
		time--;
		if(time <= 0) {
			if(!preFinish) {
				clearInterval(hiloTimer);
				hiloTimer = null;
				preFinish = true;
				HiloSetStatus(2);
				HiloGetFlip();
			}
		}
        io.sockets.emit('hilo.timer', {
            total : times,
            time : 100-(time/100)
        });
    }, 10);
}

function HiloGetFlip() {
    requestify.post(options.protocol + '://' + config.domain + '/api/hilo/getFlip')
    .then(function(res) {
        res = JSON.parse(res.body);
        io.sockets.emit('hilo.getFlip', res);
		HiloSetStatus(3);
		setTimeout(HiloNewGame, 4500);
    }, function(res) {
        log.error('[HILO] Error in function getFlip');
    });
}

// Проверка статусов
requestify.post(options.protocol + '://' + config.domain + '/api/hilo/getStatus')
.then(function(res) {
	res = JSON.parse(res.body);
	if(res.status <= 1) HiloStartTimer(res.time);
	if(res.status == 2) HiloStartTimer(res.time);
	if(res.status == 3) HiloNewGame();
}, function(res) {
	log.error('[HILO] Error in function getStatus');
});

function HiloSetStatus(status) {
    requestify.post(options.protocol + '://' + config.domain + '/api/hilo/setStatus', {
		status : status
    })
    .then(function(res) {
        status = JSON.parse(res.body);
    }, function(res) {
        log.error('[HILO] Error in function setStatus');
		setTimeout(HiloSetStatus, 1000);
    });
}

function unBan() {
    requestify.post(options.protocol + '://' + config.domain + '/api/unBan')
    .then(function(res) {
        var data = JSON.parse(res.body);
        setTimeout(unBan, 60000);
    },function(response){
        log.error('Error in function [unBan]');
        setTimeout(unBan, 1000);
    });
}

function getMerchBalance() {
    requestify.post(options.protocol + '://' + config.domain + '/api/getMerchBalance')
    .then(function(response) {
        var balance = JSON.parse(response.body);
        setTimeout(getMerchBalance, 600000);
    },function(response){
        log.error('Error in function [getMerchBalance]');
        setTimeout(getMerchBalance, 100333330);
    });
}

function getParam() {
    requestify.post(options.protocol + '://' + config.domain + '/api/getParam')
    .then(function(response) {
        var res = JSON.parse(response.body);
		if(res.fake && !fakeStatus) {
			fakeStatus = 1;
			fakeBetJackpot(res.fake);
			fakeBetWheel(res.fake);
			fakeBetDice(res.fake);
			fakeBetBattle(res.fake);
		} else {
			fakeStatus = 0;
			setTimeout(getParam, 5000);
		}
    },function(response){
        log('Error in function [fakeStatus]');
        setTimeout(getParam, 1000);
    });
}

function fakeBetJackpot(status) {
	if(status) {
		requestify.post(options.protocol + '://' + config.domain + '/api/jackpot/addBetFake')
		.then(function(res) {
			res = JSON.parse(res.body);
			if(!res.fake) fakeStatus = 0;
			setTimeout(function() {
				fakeBetJackpot(fakeStatus);
			}, Math.round(getRandomArbitrary(5, 17) * 1000));
		}, function(res) {
			log('[Jackpot] Error when adding a bet!');
			setTimeout(function() {
				fakeBetJackpot(fakeStatus);
			}, Math.round(getRandomArbitrary(5, 17) * 1000));
		});
	} else {
		setTimeout(getParam, 5000);
	}
}

function fakeBetWheel(status) {
	if(status) {
		requestify.post(options.protocol + '://' + config.domain + '/api/wheel/addBetFake')
		.then(function(res) {
			res = JSON.parse(res.body);
			if(!res.fake) fakeStatus = 0;
			setTimeout(function() {
				fakeBetWheel(fakeStatus);
			}, Math.round(getRandomArbitrary(1, 8) * 1000));
		}, function(res) {
			log('[Wheel] Error when adding a bet!');
			setTimeout(function() {
				fakeBetWheel(fakeStatus);
			}, Math.round(getRandomArbitrary(1, 8) * 1000));
		});
	} else {
		setTimeout(getParam, 5000);
	}
}

function fakeBetDice(status) {
	if(status) {
		requestify.post(options.protocol + '://' + config.domain + '/api/dice/addBetFake')
		.then(function(res) {
			res = JSON.parse(res.body);
			if(!res.fake) fakeStatus = 0;
			setTimeout(function() {
				fakeBetDice(fakeStatus);
			}, Math.round(getRandomArbitrary(1, 3) * 1000));
		}, function(res) {
			log('[Dice] Error when adding a bet!');
			setTimeout(function() {
				fakeBetDice(fakeStatus);
			}, Math.round(getRandomArbitrary(1, 3) * 1000));
		});
	} else {
		setTimeout(getParam, 5000);
	}
}

function fakeBetBattle(status) {
	if(status) {
		requestify.post(options.protocol + '://' + config.domain + '/api/battle/addBetFake')
		.then(function(res) {
			res = JSON.parse(res.body);
			if(!res.fake) fakeStatus = 0;
			setTimeout(function() {
				fakeBetBattle(fakeStatus);
			}, Math.round(getRandomArbitrary(1, 3) * 1000));
		}, function(res) {
			log('[Dice] Error when adding a bet!');
			setTimeout(function() {
				fakeBetBattle(fakeStatus);
			}, Math.round(getRandomArbitrary(1, 3) * 1000));
		});
	} else {
		setTimeout(getParam, 5000);
	}
}

function getRandomArbitrary(min, max) {
    return Math.random() * (max - min) + min;
}

unBan();
getMerchBalance();
getParam();
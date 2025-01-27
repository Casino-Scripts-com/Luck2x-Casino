$(document).ready( async () => {
	await autoFillTowers();
	await checkGame();
	autoFillCoeff();

	const $this = this;
	$(document).on('click', '.tile_btn__1b-Eh', function () {
		if (game === null) return;

		const slot = $(this).attr('data-id');

		$.ajax({
			type: 'POST',
			url: '/tower/next',
			data: {
				slot: slot
			},
			success: data => {
				if (data.success) {
					game.setGame(data.game, slot);
				} else {
					$.notify({
						type: 'error',
						message: data.message
					});
				}
			}
		});
	});

	$(document).on('click', '.claim', function () {
		if (game === null) return;

		$.ajax({
			type: 'POST',
			url: '/tower/claim',
			success: data => {
				if (data.success) {
					game.setGame(data.game, 0);
				} else {
					$.notify({
						type: 'error',
						message: data.message
					});
				}
			}
		});
	});

	$(document).on('click', '.btn-change', function () {
		$('.dropdown-item[data-id="balance"]').click();
	});
});

let coeff = {
    1: [1.25, 1.562, 1.953, 2.441, 3.051, 3.814, 4.768, 5.96, 7.45, 9.313],
    2: [1.666, 2.777, 4.629, 7.716, 12.86, 21.433, 35.722, 59.537, 99.229, 165.381],
    3: [2.5, 6.25, 15.625, 39.062, 97.656, 244.14, 610.351, 1525.878, 3814.697, 9536.743],
    4: [5, 25, 125, 625, 3125, 15625, 78125, 390625, 1953125, 9765625]
};

let game = null;

let config = {
	bombs: 1,
	bet: 0.00,
	activeGame: false
};

$(document).on('click', '.selectBomb', function(e) {
	if ($(this).hasClass('isActive') || config.activeGame) return;

	const bomb = $(this).attr('data-bomb');
	const lastBtn = $(`.btn[data-bomb=${config.bombs}]`);

	config.bombs = parseInt(bomb);

	autoFillCoeff();
	autoFillTowers();

	$(this).addClass('isActive');
	lastBtn.removeClass('isActive');
});

$(document).on('click', '.btn-play', async () => {
	if (config.activeGame) return;

	game = null;
	$('.game-tooltip').remove();

	config.bet = parseFloat($('#sum').val());

	$.ajax({
		type: 'POST',
		url: '/tower/newGame',
		data: {
			bombs: config.bombs,
			bet: config.bet,
			balance: localStorage.getItem('balance') || 'balance'
		},
		success: async (data) => {
			if (data.success) {
				await autoFillTowers();
				config.activeGame = true;
				game = new Tower(data.game);
			} else {
				$.notify({
					type: 'error',
					message: data.message
				})
			}
		},
		error: async () => {
			$.notify({
				type: 'error',
				message: 'An error has occurred on the server'
			})
		}
	});
});

const autoFillTowers = async () => {
	let html = '';
	$('.tower_payoutItemActive__1xYqA').removeClass('tower_payoutItemActive__1xYqA');
	for (let i = 0; i < 10; i++) {
		html += '<div class="tile_row__2H-Sa">';

		for (let l = 0; l < 5; l++) {
			html += '<div class="tile_item__eJPTt">'+
									'<button type="button" class="tile_btn__1b-Eh" data-id="'+l+'">'+
										'<span class="tile_appear__3kqK4"></span>'+
										'<span class="tile_bombFrame__2GtMm"></span>'+
										'<span class="tile_main__2babg"></span>'+
									'</button>'+
								'</div>';
		}

		html += '</div>'
	}

	$('#TowerComponent').html(html);
};

const autoFillCoeff = () => {
	const coef = coeff[config.bombs];

	for (let i = 0; i < 10; i++) {
		const e = (coef[i] - coef[i] * 5 / 100).toFixed(2);
		$(`#coeff_${i + 1}`).html(`x${e}`);
	}
};

const checkGame = () => {
	$.ajax({
		type: 'POST',
		url: '/tower/init',
		success: (data) => {
			if (data.game !== null) {
				$(`.btn[data-bomb=${data.game.state.count}]`).click();

				config = {
					bombs: data.game.state.count,
					bet: data.game.bet,
					activeGame: true
				};

				$('#sum').val(config.bet);

				game = new Tower(data.game);
			}
		}
	});
};

class Tower {
	constructor(data) {
		this.game = data;
		this.lastSlot = -1;

		$('.btn-play').addClass('claim');

		this.currentRevealed();
		this.currentStep();
	}

	currentStep() {
		const step = this.game.state.revealed.length;
		const block = $($(`.tile_row__2H-Sa`)[step]);
		if (step === 0) {
			$('.claim').prop('disabled', true);
		} else {
			$('.claim').prop('disabled', false);
		}
		$('.claim').html(`Collect ${this.game.state.claim}`);

		block.addClass('tile_isActive__2d3mO');
	}

	currentRevealed() {
		for (let i = 0; i < this.game.state.revealed.length; i++) {
			const bombs = this.game.state.field[i];
			const block = $($(`.tile_row__2H-Sa`)[i]);
			block.removeClass('tile_isActive__2d3mO');

			let html = '';

			for (let l = 0; l < 5; l++) {
				if (bombs.find(x => x === l) !== undefined) {
					if (bombs.find(x => x === parseInt(this.game.state.revealed[i])) !== undefined) {
						html += '<div class="tile_item__eJPTt tile_hasMine__1W4Zt"><button type="button" class="tile_btn__1b-Eh tile_isMine__3hfGe tile_isClickable__QnuY3"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm tile_isAnimate__gWjgT"></span><span class="tile_main__2babg tile_isRevealed__1vm7Q tile_isMine__3hfGe"></span></button></div>';
					} else {
						html += '<div class="tile_item__eJPTt tile_hasMine__1W4Zt"><button type="button" class="tile_btn__1b-Eh tile_isMine__3hfGe"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isRevealed__1vm7Q tile_isMine__3hfGe"></span></button></div>';
					}
				} else {
					if (parseInt(this.game.state.revealed[i]) === l) {
						html += '<div class="tile_item__eJPTt"><button type="button" class="tile_btn__1b-Eh tile_isRevealed__1vm7Q tile_isClickable__QnuY3"><span class="tile_appear__3kqK4 tile_isAnimate__gWjgT"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isAnimate__gWjgT tile_isRevealed__1vm7Q"></span></button></div>';
					} else {
						html += '<div class="tile_item__eJPTt"><button type="button" class="tile_btn__1b-Eh tile_isRevealed__1vm7Q"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isAnimate__gWjgT tile_isRevealed__1vm7Q"></span></button></div>';
					}
				}
			}

			block.html(html);
		}

		$(`#coeff_${this.game.state.revealed.length}`).addClass('tower_payoutItemActive__1xYqA');
	}

	lastRevealed() {
		let i = 0;
		if (this.game.state.revealed.length > 0) {
			i = this.game.state.revealed.length - 1;
		}
		if (this.game.state.revealed.length > 1) $(`#coeff_${this.game.state.revealed.length - 1}`).removeClass('tower_payoutItemActive__1xYqA');

		const bombs = this.game.state.field[i];
		const block = $($(`.tile_row__2H-Sa`)[i]);
		block.removeClass('tile_isActive__2d3mO');

		let html = '';

		for (let l = 0; l < 5; l++) {
			if (bombs.find(x => x === l) !== undefined) {
					html += '<div class="tile_item__eJPTt tile_hasMine__1W4Zt"><button type="button" class="tile_btn__1b-Eh tile_isMine__3hfGe"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isRevealed__1vm7Q tile_isMine__3hfGe"></span></button></div>';
			} else {
				if (parseInt(this.game.state.revealed[i]) === l) {
					html += '<div class="tile_item__eJPTt"><button type="button" class="tile_btn__1b-Eh tile_isRevealed__1vm7Q tile_isClickable__QnuY3"><span class="tile_appear__3kqK4 tile_isAnimate__gWjgT"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isAnimate__gWjgT tile_isRevealed__1vm7Q"></span></button></div>';
				} else {
					html += '<div class="tile_item__eJPTt"><button type="button" class="tile_btn__1b-Eh tile_isRevealed__1vm7Q"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isAnimate__gWjgT tile_isRevealed__1vm7Q"></span></button></div>';
				}
			}
		}

		block.html(html);
		$(`#coeff_${this.game.state.revealed.length}`).addClass('tower_payoutItemActive__1xYqA');
	}

	nextRevealed(boom) {
		for (let i = this.game.state.revealed.length; i < 10; i++) {
			const bombs = this.game.state.field[i];
			const block = $($(`.tile_row__2H-Sa`)[i]);
			block.removeClass('tile_isActive__2d3mO');

			let lastSlot = this.lastSlot;
			let html = '';

			for (let l = 0; l < 5; l++) {
				if (bombs.find(x => x === parseInt(l)) !== undefined) {
					if (bombs.find(x => x === parseInt(lastSlot)) !== undefined && l === parseInt(lastSlot) && !boom) {
						boom = true;
						html += '<div class="tile_item__eJPTt tile_hasMine__1W4Zt"><button type="button" class="tile_btn__1b-Eh tile_isMine__3hfGe tile_isClickable__QnuY3"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm tile_isAnimate__gWjgT"></span><span class="tile_main__2babg tile_isRevealed__1vm7Q tile_isMine__3hfGe"></span></button></div>';
					} else {
						html += '<div class="tile_item__eJPTt tile_hasMine__1W4Zt"><button type="button" class="tile_btn__1b-Eh tile_isMine__3hfGe"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isRevealed__1vm7Q tile_isMine__3hfGe"></span></button></div>';
					}
				} else {
					html += '<div class="tile_item__eJPTt"><button type="button" class="tile_btn__1b-Eh tile_isRevealed__1vm7Q"><span class="tile_appear__3kqK4"></span><span class="tile_bombFrame__2GtMm"></span><span class="tile_main__2babg tile_isRevealed__1vm7Q"></span></button></div>';
				}
			}

			block.html(html);
		}
	}

	boom() {
		this.nextRevealed(false);
		$('.btn-play').removeClass('claim');
		$('.btn-play').prop('disabled', false);
		$('.btn-play').html('Play');
		config.activeGame = false;
	}

	end() {
		if (this.game.state.revealed.length < 10) {
			this.nextRevealed(true);
		} else {
			this.lastRevealed();
		}
		$('.btn-play').removeClass('claim');
		$('.btn-play').prop('disabled', false);
		$('.btn-play').html('Play');
		config.activeGame = false;

		if (this.game.currency === 'bonus') {
			$('.tower_component__3oM-1').append(`<div class="game-tooltip isTransparent isActive demo won" style="top: 50%;left: 50%;transform: translate(-50%, -50%);">`+
							`<div class="wrap">`+
								`<div class="payout">x${this.game.coeff}</div>`+
								`<div class="badge">`+
									`<div class="text">Demo mode</div>`+
								`</div>`+
								`<div class="status">You won&nbsp;<span class="profit">${(this.game.bet * this.game.coeff).toFixed(2)}</span>`+
								`</div>`+
								`<button type="button" class="btn btn-change">Play for money</button>`+
							`</div>`+
						`</div>`);
		} else {
			$('.tower_component__3oM-1').append(`<div class="game-tooltip isTransparent isActive won" style="top: 50%;left: 50%;transform: translate(-50%, -50%);">`+
							`<div class="wrap">`+
								`<div class="payout">x${this.game.coeff}</div>`+
								`<div class="badge">`+
									`<div class="text">Victory</div>`+
								`</div>`+
								`<div class="status">You won&nbsp;<span class="profit">${(this.game.bet * this.game.coeff).toFixed(2)}</span>`+
								`</div>`+
							`</div>`+
						`</div>`);
		}
	}

	setGame(data, slot) {
		this.lastSlot = slot;
		this.game = data;
		if (this.game.active) {
			this.currentStep();
			this.lastRevealed();
		} else {
			if (this.game.status === 2) {
				this.boom();
			} else {
				this.end();
			}
		}
	}
}
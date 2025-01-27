var chatHide = 0;
$(document).ready(function () {
	$('#btnchat').click(function () {
		if(chatHide == 0) {
			chatHide = 1;
			$('.sidebar-container').slideUp(0);
			$('.right-sidebar').css({'background': 'none'});
			$('.wrapper').addClass('chatHide');
			$('#btnchat').addClass('chatClose')
		} else {
			chatHide = 0;
			$('.sidebar-container').slideDown(0);
			$('.right-sidebar').css({'background': '#101a3f', 'position': 'fixed'});
			$('.wrapper').removeClass('chatHide');
			$('#btnchat').removeClass('chatClose')
		}
	});
});
$('#sumToSend').on('change keydown paste input', function() {
        var sumToSend = $(this).val();
        var total = sumToSend*1.05;
        $('#minusSum').html(total);
    });

	
    $('.ref #reward, .ref #count').on('change keydown paste input', function() {
        var sum = $('.ref #reward').val();
        var count = $('.ref #count').val() ? $('.ref #count').val() : 1;
        var total = (sum*count)*1.10;
        $('#minusSum').html(Math.floor(total));
    });
	
	$('.sendButton').click(function(){
		var target = $('.targetID').val();
		var sum = $('.sum').val();
        $('.sendButton').val('Переводим.....');
        $('.sendButton').attr('disabled', 'true');
		$.ajax({
            url : '/payment/send/create',
            type : 'post',
            data : {
                target : target,
                sum : sum
            },
			success : function(data) {
				$.notify({
                    position : 'top-right',
                    type: data.type,
                    message: data.msg
                });
                $('.sendButton').val('Подтвердить перевод');
                $('.sendButton').removeAttr('disabled');
		        return false;
			},
            error : function(data) {
                console.log(data.responseText);
            }
        });
	});
	
$(document).ready(function() {
	//$('body').snowfall({image :"../img/winter/snow/1.png", minSize: 5, maxSize:8, flakeCount: 30});
	initBalance();
	const container = document.querySelector('.chat-conversation-inner');
	const ps = new PerfectScrollbar('.chat-conversation-inner', {
		useBothWheelAxes: true
	});
	new PerfectScrollbar('.tos-modal-block', {
		useBothWheelAxes: true
	});
	$(window).resize(function() {
		container.scrollTop = container.scrollHeight - container.clientHeight;
		ps.update();
		if($(window).width() <= 1299) {
			$('.left-sidebar .logo img').attr('src', '/img/logo_small.png');
		} else if($(window).width() >= 1300) {
			$('.left-sidebar .logo img').attr('src', '/img/logo.png');
		}
		if($(window).width() > 820) {
			$('body').removeClass('hidden');
			$('.right-sidebar').removeClass('opened');
			$('.right-sidebar .user-profile').removeClass('current');
			$('.right-sidebar .chat').addClass('current');
		}
    }).trigger('resize');
	$(window).scroll(function() {
		if($(window).width() > 820) {
			if($(this).scrollTop() > 0) $('.header, .left-sidebar, .right-sidebar').addClass('sticky');          
			else $('.header, .left-sidebar, .right-sidebar').removeClass('sticky');
		} else {
			$('.header, .left-sidebar, .right-sidebar').removeClass('sticky');
		}
	}).trigger('scroll');
	$(document).tooltip({
		selector: '[data-toggle="tooltip"]'
	});
	$(document).on('click', '.top-nav .toggle .btn', function(e) {
		e.preventDefault();
		var $this = $(this).parent(),
			$content = $this.find('ul');
		if(!$content.hasClass('isOpen')) {
			$(this).addClass('isOpen');
			$content.addClass('isOpen');
			setTimeout(function () {
				$(document).on('click.headerToggle', function (e) {
					if(!$(e.target).closest($content).length) {
						$this.removeClass('isOpen');
						$content.removeClass('isOpen');
						$(document).off('click.headerToggle');
					}
				});
			}, 10);
		}
	});
	$('#auth').click(function() {
		const login = $('#authlog').val();
		const pass = $('#authpass').val();

		if($.trim(login).length === 0 || $.trim(pass).length === 0) return $.notify({type: 'error', message: 'Заполните все поля'});
		
		$.post('/auth', {login: login, password: pass})
		.then((data) => {
			if(data.error) return $.notify({type: 'error', message: data.message});
			if(data.success) return location.href = '/';
		})
	})
	$('#register').click(function() {
		const login = $('#reglog').val();
		const pass = $('#regpass').val();

		if($.trim(login).length === 0 || $.trim(pass).length === 0) return $.notify({type: 'error', message: 'Заполните все поля'});
		
		$.post('/register', {login: login, password: pass})
		.then((data) => {
			if(data.error) return $.notify({type: 'error', message: data.message});
			if(data.success) return location.href = '/';
		})
	})
	$(document).on('click', '.deposit-wrap .dropdown-item', function() {
		var type;
		if($(this).data('id') == 'balance') {
			$('.deposit-wrap .dropdown-toggle .selected').removeClass('bonus');
			$('.deposit-wrap .dropdown-toggle .selected').addClass('balance');
			$('#exchange').remove();
			$('#wallet').remove();
			$('.deposit-block').append('<button type="button" class="btn" id="wallet">Кошелек</button>');
			type = 'balance';
		} else {
			$('.deposit-wrap .dropdown-toggle .selected').addClass('bonus');
			$('.deposit-wrap .dropdown-toggle .selected').removeClass('balance');
			$('#exchange').remove();
			$('#wallet').remove();
			$('.deposit-block').append('<button type="button" class="btn btn-light-gray" id="exchange">Обменять</button>');
			type = 'bonus';
		}
		localStorage.setItem('balance', type);
		var value = $('.balance-item.' + type + ' #'+ type +'_bal').text();
		$('.deposit-block #balance').text(value);
	});
	var popoverTemplate = '<div class="popover smile-popover" role="tooltip"><div class="popover-inner"><div class="popover-body"></div></div><span class="arrow" style="left: 165px;"></span></div>';

    var content = '<div class="smiles-list"><span class="s s-1f60a" data-item="1f60a"></span><span class="s s-1f60b" data-item="1f60b"></span><span class="s s-1f60c" data-item="1f60c"></span><span class="s s-1f60d" data-item="1f60d"></span><span class="s s-1f60e" data-item="1f60e"></span><span class="s s-1f60f" data-item="1f60f"></span><span class="s s-1f61a" data-item="1f61a"></span><span class="s s-1f61b" data-item="1f61b"></span><span class="s s-1f61c" data-item="1f61c"></span><span class="s s-1f61d" data-item="1f61d"></span><span class="s s-1f61f" data-item="1f61f"></span><span class="s s-1f61e" data-item="1f61e"></span><span class="s s-1f62a" data-item="1f62a"></span><span class="s s-1f62b" data-item="1f62b"></span><span class="s s-1f62c" data-item="1f62c"></span><span class="s s-1f62d" data-item="1f62d"></span><span class="s s-1f62e" data-item="1f62e"></span><span class="s s-1f62f" data-item="1f62f"></span><span class="s s-1f92a" data-item="1f92a"></span><span class="s s-1f92b" data-item="1f92b"></span><span class="s s-1f92c" data-item="1f92c"></span><span class="s s-1f92e" data-item="1f92e"></span><span class="s s-1f92d" data-item="1f92d"></span><span class="s s-1f600" data-item="1f600"></span><span class="s s-1f601" data-item="1f601"></span><span class="s s-1f92f" data-item="1f92f"></span><span class="s s-1f603" data-item="1f603"></span><span class="s s-1f602" data-item="1f602"></span><span class="s s-1f604" data-item="1f604"></span><span class="s s-1f605" data-item="1f605"></span><span class="s s-1f606" data-item="1f606"></span><span class="s s-1f607" data-item="1f607"></span><span class="s s-1f608" data-item="1f608"></span><span class="s s-1f609" data-item="1f609"></span><span class="s s-1f610" data-item="1f610"></span><span class="s s-1f611" data-item="1f611"></span><span class="s s-1f612" data-item="1f612"></span><span class="s s-1f613" data-item="1f613"></span><span class="s s-1f614" data-item="1f614"></span><span class="s s-1f615" data-item="1f615"></span><span class="s s-1f618" data-item="1f618"></span><span class="s s-1f620" data-item="1f620"></span><span class="s s-1f622" data-item="1f622"></span><span class="s s-1f621" data-item="1f621"></span><span class="s s-1f623" data-item="1f623"></span><span class="s s-1f624" data-item="1f624"></span><span class="s s-1f625" data-item="1f625"></span><span class="s s-1f626" data-item="1f626"></span><span class="s s-1f628" data-item="1f628"></span><span class="s s-1f629" data-item="1f629"></span><span class="s s-1f630" data-item="1f630"></span><span class="s s-1f631" data-item="1f631"></span><span class="s s-1f627" data-item="1f627"></span><span class="s s-1f632" data-item="1f632"></span><span class="s s-1f633" data-item="1f633"></span><span class="s s-1f636" data-item="1f636"></span><span class="s s-1f643" data-item="1f643"></span><span class="s s-1f642" data-item="1f642"></span><span class="s s-1f641" data-item="1f641"></span><span class="s s-1f644" data-item="1f644"></span><span class="s s-1f910" data-item="1f910"></span><span class="s s-1f911" data-item="1f911"></span><span class="s s-1f914" data-item="1f914"></span><span class="s s-1f913" data-item="1f913"></span><span class="s s-1f915" data-item="1f915"></span><span class="s s-1f923" data-item="1f923"></span><span class="s s-1f925" data-item="1f925"></span><span class="s s-1f929" data-item="1f929"></span><span class="s s-1f928" data-item="1f928"></span><span class="s s-2764" data-item="2764"></span></div>';
	
	$(document).popover({
		container: 'body',
        html : true,
		selector: '[data-toggle="popover"]',
		template : popoverTemplate,
        content: content
	});
	
	$('body').on('click', function (e) {
		$('[data-toggle="popover"]').each(function() {
			if(!$(this).is(e.target) && $(this).has(e.target).length === 0 && $('.popover').has(e.target).length === 0) {
				$(this).popover('hide');
			}
		});
	});
	
	$(document).on('click', '.smiles-list span', function() {
        $('.chat-editable').append('<img class="s s-' + $(this).data('item') + '" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"/>');
		$('[data-toggle="popover"]').popover('hide');
	});
	
	$(document).bind('enterKey', '.chat-editable', function (e) {
        var input = $('.chat-editable');
        var optional = $('#optional').val();
        var msg = input.html();
        if(msg != '') {
			$.ajax({
				url: '/chat',
				type: 'post',
				data: {
					messages: msg,
					optional: optional
				},
				success: function(data) {
					if(data) {
						if(data.status == 'success') {
							input.html('');
						} else {
							input.html('');
						}
						$.notify({
							type: data.status,
							message: data.message
						});
					} else input.html('');
				}
			})
        }
    });
	
	$(document).on('keypress', '.chat-editable', function(e) {
		var keyCode = e.which;
		if(keyCode == 13) {
			$(this).trigger('enterKey'); 
			e.preventDefault();
		}
	});
	
	$(document).on('click', '.chat-controls .sendMessage', function(e) {
		$('.chat-editable').trigger('enterKey'); 
		e.preventDefault();
	});
	
	$(document).on('click', '.tabs-nav .item', function(e) {
        if(!$(this).is('.current')) {
            $('.tabs-nav .item, .right-sidebar .tab').removeClass('current');
            $(this).addClass('current');
            $('.right-sidebar .tab:eq('+$(this).index()+')').addClass('current');
        }   
    });
	
	$(document).on('click', '.top-nav-wrapper .opener', function(e) {
        if(!$(this).is('.opened')) {
            $(this).addClass('opened');
            $('.top-nav').addClass('opened');
        } else {
			$(this).removeClass('opened');
            $('.top-nav').removeClass('opened');
		}
    });
	
	$(document).on('click', '#wallet', function() {
		$('#walletModal').modal('show');
	});
	$(document).on('click', '#settings', function() {
		$('#settingsModal').modal('show');
	});
	$(document).on('click', '#exchange', function() {
		$('#exchangeModal').modal('show');
	});
	
	$(document).on('click', '#otherMenu', function() {
		if(!$('.pull-out.other').is('.opened')) {
            $('.pull-out.other').addClass('opened');
            $('.pull-out.game').removeClass('opened');
            $('.right-sidebar').removeClass('opened');
        } else {
            $('.pull-out.other').removeClass('opened');
		}
	});
	
	$(document).on('click', '#gamesMenu', function() {
		if(!$('.pull-out.game').is('.opened')) {
            $('.pull-out.game').addClass('opened');
            $('.pull-out.other').removeClass('opened');
            $('.right-sidebar').removeClass('opened');
        } else {
            $('.pull-out.game').removeClass('opened');
		}
	});
	
	$(document).on('click', '#chatMenu', function() {
		if(!$('.right-sidebar').is('.opened')) {
            $('body').addClass('hidden');
            $('.right-sidebar').addClass('opened');
            $('.right-sidebar .user-profile').removeClass('current');
            $('.right-sidebar .chat').addClass('current');
            $('.pull-out.other').removeClass('opened');
            $('.pull-out.game').removeClass('opened');
        } else {
            $('body').removeClass('hidden');
            $('.right-sidebar').removeClass('opened');
		}
	});
	
	$(document).on('click', '#profileMenu', function() {
		if(!$('.right-sidebar').is('.opened')) {
            $('body').addClass('hidden');
            $('.right-sidebar').addClass('opened');
            $('.right-sidebar .chat').removeClass('current');
            $('.right-sidebar .user-profile').addClass('current');
            $('.pull-out.other').removeClass('opened');
            $('.pull-out.game').removeClass('opened');
        } else {
            $('body').removeClass('hidden');
            $('.right-sidebar').removeClass('opened');
		}
	});
	
	$(document).on('click', '.pull-out .close-btn, .right-sidebar .close-btn', function() {
		if($('.pull-out, .right-sidebar').is('.opened')) {
            $('body').removeClass('hidden');
            $('.pull-out, .right-sidebar').removeClass('opened');
			$('body').removeClass('hidden');
			$('.right-sidebar').removeClass('opened');
			$('.right-sidebar .user-profile').removeClass('current');
			$('.right-sidebar .chat').addClass('current');
        }
	});
	
	$(document).on('click', '.user-link, .btn-link', function() {
		location.href = '/profile/'+$(this).attr('data-id')
	});
	
	$(document).on('click', '.select-payment .dropdown-menu .dropdown-item', function() {
		$('.tab.active .select-payment .dropdown-menu .dropdown-item').removeClass('active');
		$('.tab.active .select-payment .dropdown-toggle').html($(this).html() + '<div class="opener"><svg class="icon icon-down"><use xlink:href="/img/symbols.svg#icon-down"></use></svg></div>');
		$(this).addClass('active');
		var type = $('.dura .deposit-modal-component .tab.active').data('type');
		var system = $(this).data('system');
		if(type == 'deposite') $('#depositType').val(system)
		else {
			$('#withdrawType').val(system);
			calcSum(system);
		}
	});
	
	$(document).on('click', '.deposit-modal-component .btn-tab', function(e) {
        if(!$(this).is('.isActive')) {
            $('.deposit-modal-component .tab').removeClass('active');
            $('.deposit-modal-component .btn-tab').removeClass('isActive');
            $(this).addClass('isActive');
            $('.deposit-modal-component .tab:eq('+$(this).index()+')').addClass('active');
        }   
    });

	$(document).on('click', '.auth-modal-component .btn-tab', function(e) {
        if(!$(this).is('.isActive')) {
            $('.auth-modal-component .tab').removeClass('active');
            $('.auth-modal-component .btn-tab').removeClass('isActive');
            $(this).addClass('isActive');
            $('.auth-modal-component .tab:eq('+$(this).index()+')').addClass('active');
        }   
    });
	
	$(document).on('click', '.bet-component .btn-action, .bet-component .btn-bet-clear, .btn-act', function() {
		let value = parseFloat($('#sum').val()) || 0,
            all = parseFloat($('#balance').text()),
            thisMethod = $(this).data('action'),
            thisValue = parseFloat($(this).data('value'));

        switch(thisMethod) {
            case 'plus' : 
                value += thisValue;
                break;
            case 'divide' :
                value = parseInt((value/thisValue).toFixed(0));
                break;
            case 'clear' :
                value = 0;
                break;
            case 'last' : 
                value = localStorage.getItem('last');
                break;
            case 'all' : 
                value = all;
                break;
            case 'multiply' :
                value *= thisValue;
                break;
        }

        $('#sum').val(value.toFixed(2)).trigger('input');
    });
	
	$(document).on('change keydown paste input', '#exSum', function() {
		var sum = parseFloat($(this).val()) || 0;
		var total = sum/settings.exchange_curs;
		if(settings.exchange_min > sum) total = 0;
		$('#exTotal').text(Math.floor(total));
	});
	
	$(document).on('click', '.exchangeBonus', function() {
		var sum = parseFloat($('#exSum').val());
		$.ajax({
            url : '/exchange',
            type : 'post',
            data : {
                sum : sum
            },
			success : function(data) {
				if(data.type == 'success') {
					$('#exchangeModal').modal('hide');
					$('#exSum').val('')
					$('#exTotal').val(0)
				}
				$.notify({
                    position : 'top-right',
                    type: data.type,
                    message: data.msg
                });
		        return false;
			},
            error : function(data) {
                console.log(data.responseText);
            }
        });
	});
	$(document).on('submit', '#clan', function(e) {
		$.post('/clans/create', {
			name: $('#clanName').val(),
			avatar: $('#clanAvatar').val(),
			points: $('#clanPoints').val()
		})
		.then(res => {
			if(res.type == 'success') {
				setTimeout(() => {
					location.reload(true)
				}, 2500)
			}
			$.notify({
				position : 'top-right',
				type: res.type,
				message: res.msg
			});
		})
		.fail(err => {
			console.log(err.responseText);
			$.notify({
				type: 'error',
				message: 'Ошибка при отправке данных на сервер!'
			});
		})
		e.preventDefault();
	})
	$(document).on('submit', '#payment', function(e) {
        $.ajax({
            url     : $(this).attr('action'),
            type    : $(this).attr('method'),
            data    : $(this).serialize(),
            success : function(data) {
                if(data.success) {
                    window.location = data.url;
                } else {
					$.notify({
						type: data.type,
						message: data.msg
					});
                }
            },
            error   : function(err) {
                console.log(err.responseText);
				$.notify({
					type: 'error',
					message: 'Ошибка при отправке данных на сервер!'
				});
            }
        })
        e.preventDefault(); 
    });
	
	$('#valwithdraw').on('change keydown paste input', function() {
		calcSum($('#withdrawType').val());
	});
	
    $('#withdraw-checkbox').click(function() {
        $('#withdraw-checkbox').attr('checked', 'checked');
        if($(this).prop('checked') == true){
            $('#submitwithdraw').removeAttr('disabled');
        } else {
            $('#submitwithdraw').attr('disabled', 'false');
            $('#withdraw-checkbox').removeAttr('checked');
        }
    });
	
	$('#register-checkbox').click(function() {
        $('#auth-checkbox').attr('checked', 'checked');
        if($(this).prop('checked') == true){
            $('#register').removeAttr('disabled');
        } else {
            $('#register').attr('disabled', 'false');
            $('#register-checkbox').removeAttr('checked');
        }
    });

	function calcSum(system) {
		if(!$('#withdrawType').val()) return;
        if(system == 'payeer') {
            var perc = parseFloat(settings.payeer_com_percent);
            var com = parseFloat(settings.payeer_com_rub);
            var min = parseFloat(settings.payeer_min);
            var wallet = 'P12345xx';
        } else if(system == 'qiwi') {
            var perc = parseFloat(settings.qiwi_com_percent);
            var com = parseFloat(settings.qiwi_com_rub);
            var min = parseFloat(settings.qiwi_min);
            var wallet = '+7953155XXXX';
        } else if(system == 'yandex') {
            var perc = parseFloat(settings.yandex_com_percent);
            var com = parseFloat(settings.yandex_com_rub);
            var min = parseFloat(settings.yandex_min);
            var wallet = '410012311011xx';
        } else if(system == 'webmoney') {
            var perc = parseFloat(settings.webmoney_com_percent);
            var com = parseFloat(settings.webmoney_com_rub);
            var min = parseFloat(settings.webmoney_min);
            var wallet = 'R12345678xxxx';
        } else if(system == 'visa') {
            var perc = parseFloat(settings.visa_com_percent);
            var com = parseFloat(settings.visa_com_rub);
            var min = parseFloat(settings.visa_min);
            var wallet = '546934567890xxxx';
        }
		$('.com-row span').html((perc != 0 ? perc + '%' : 'Нет')+(com != 0 ? '+' + com + 'р' : ''));
		var sum = parseFloat($('#valwithdraw').val());
        var comission = (sum+com)+(sum/100*perc);
        if(!sum) comission = 0;
        if(comission < 1) comission = 0;
		$('#numwallet').attr('placeholder', wallet);
		$('#totalwithdraw').text(parseFloat(comission).toFixed(2));
		$('#valwithdraw').attr('placeholder', 'Мин. сумма '+ min +' руб.');
    }
	
	$(document).on('click', '#submitwithdraw', function() {
		var system = $('#withdrawType').val();
		var value = $('#valwithdraw').val();
		var wallet = $('#numwallet').val();
		
		$.ajax({
            url : '/withdraw',
            type : 'post',
            data : {
                system : system,
                value : value,
				wallet : wallet
            },
			success : function(data) {
				if(data.success) {
					$('#walletModal').modal('hide');
					$('#valwithdraw').val('');
					$('#numwallet').val('');
					$('#totalwithdraw').text('0');
					$('#submitwithdraw').attr('disabled', 'false');
				}
				$.notify({
                    type: data.type,
                    message: data.msg
                });
		        return false;
			},
            error : function(data) {
                console.log(data.responseText);
            }
        });
	});
	
	$(document).on('click', '.shareToChat', function() {
		$.ajax({
			url: '/chat',
			type: 'post',
			data: {
				messages : '$bal',
				balType: localStorage.getItem('balance')
			},
			success: function(data) {
				if(data) {
					$.notify({
						type: data.status,
						message: data.message
					});
				}
			}
		})
	});
	
	$(document).on('click', '.unbanMe', function() {
		$.ajax({
			url : '/unbanMe',
			type : 'post',
			success : function(data) {
				$.notify({
					position : 'top-right',
					type: data.type,
					message: data.msg
				});
				return false;
			},
			error : function(data) {
				console.log(data.responseText);
			}
		});
	});
	
	$(document).on('click', '.btnToggle button', function() {
		if(!$(this).is('.isActive')) {
            $('.btnToggle button').removeClass('isActive');
            $(this).addClass('isActive');
        } 
	});
	
    $(document).on('click', '.checkHash', function() {
        var hash = $('#gameHash').val();
        $.ajax({
            url : '/fair/check',
            type : 'post',
            data : {
                hash : hash
            },
            success : function(data) {
                if(data.success) {
                    $('#gameRound').text(data.round);
                    $('#gameNumber').text(data.number);
                    $('.fair-table').slideDown();
                } else {
                    $('#gameRound').text('');
                    $('#gameNumber').text('');
                    $('.fair-table').slideUp();
                }
                $.notify({
                    type: data.type,
                    message: data.msg
                });
                return false;
            },
            error : function(data) {
                console.log(data.responseText);
            }
        });
    });
	
    $(document).on('click', '#withdraw-button .btn', function() {
		if($(this).attr('disabled') == true) return;
        $.ajax({
            url : '/affiliate/get',
            type : 'post',
            success : function(data) {
                if(data.success) {
                    $('.affiliate-stats .right .num').text('0.00');
					$('#withdraw-button .btn').attr('disabled', true);
                }
                $.notify({
                    type: data.type,
                    message: data.msg
                });
                return false;
            },
            error : function(data) {
                console.log(data.responseText);
            }
        });
    });
	
    $(document).on('click', '.checkGame', function() {
		var hash = $(this).data('hash');
        $('#gameHash').val(hash);
		$('#fairModal').modal('show');
    });
	
	$(document).on('hidden.bs.modal', '#fairModal', function () {
        $('#gameHash').val('');
        $('#gameRound').text('');
        $('#gameNumber').text('');
		$('.fair-table').slideUp();
	});
	
    $(document).on('click', '.activatePromo', function() {
        var code = $('#promoInput').val();
        $.ajax({
            url : '/promo/activate',
            type : 'post',
            data : {
                code : code
            },
            success : function(data) {
				$('#promoModal').modal('hide');
				$('#promoInput').val('')
                $.notify({
                    type: data.type,
                    message: data.msg
                });
                return false;
            },
            error : function(data) {
                console.log(data.responseText);
            }
        });
    });
	
    $(document).on('click', '.joinGiveaway', function() {
        var id = $(this).data('id');
        $.ajax({
            url : '/giveaway/join',
            type : 'post',
            data : {
                id : id
            },
            success : function(data) {
                $.notify({
                    type: data.type,
                    message: data.msg
                });
                return false;
            },
            error : function(data) {
                console.log(data.responseText);
            }
        });
    });
	let tckfj = "";
	var socket = io.connect(':7777');
	socket
	.on('updateKing', function (data) {
		$('#kingBets').prepend('\
							<tr>\
								<td class="username">\
									<button type="button" class="btn btn-link" data-id="' +data.bet.unique_id+ '">\
										<span class="sanitize-user">\
											<div class="sanitize-avatar"><img src="' +data.bet.avatar+ '" alt=""></div>\
											<span class="sanitize-name" style="' +data.bet.style+ '">' +data.bet.login+ '</span>\
										</span>\
									</button>\
								</td>\
								<td style="text-align: center;">\
									<div class="bet-number">\
										<span class="bet-wrap">\
											<span>' +data.bet.sum+ '</span>\
											<svg class="icon icon-coin balance">\
												<use xlink:href="/img/symbols.svg#icon-coin"></use>\
											</svg>\
										</span>\
									</div>\
								</td>\
							</tr>');
		$('#kingBets').children().slice(10).remove();
		$('.king_bets').html('');
		data.players.forEach(e => {
			$('.king_bets').append('<img src="' +e.avatar+ '">')
		})
		clearTimeout(tckfj)
		tckfj = setTimeout(() => {
			$('.king_avatar').removeClass('newBet')
		}, 250)
		$('.king_bets').prepend('<img class="currentBet" src="' +data.bet.avatar+ '">');
		$('.king_avatar').addClass('newBet').html('<img src="' +data.bet.avatar+ '">');
		$('.king_bank').html(data.bank.toFixed(2)+' <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg>');
	})
	.on('kingTimer', function (data) {
		if(data.type == 'timer') {
			$('.king_timer').html(data.data.timer);
		}
	})
	.on('kingWinner', function(data) {
		$('.king_avatar').removeClass('newBet');
		$('.king_avatar').addClass('winner');
	})
	.on('kingClear', function (data) {
		$('.king_bank').html('0.00 <svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg>');
		$('.king_timer').html('00:10');
		$('.king_avatar img, .king_bets img').fadeOut();
		$('.king_avatar').removeClass('winner');
	})
	.on('online', function (data) {
		$('.chat-online span').text(data); 
	})
	.on('message', function(msg) {
        if(USER_ID == msg.unique_id) {
            $.notify({
                type: msg.type,
                message: msg.msg
            });
        }
    })
	.on('updateBalance', function(data) {
        if(USER_ID == data.unique_id) {
			if(localStorage.getItem('balance') == 'balance') $('.deposit-block #balance').text(data.balance.toFixed(2));
			$('.balance-item.balance .value').text(data.balance.toFixed(2));
		}
    })
	.on('updateBonus', function(data) {
        if(USER_ID == data.unique_id) {
			if(localStorage.getItem('balance') == 'bonus') $('.deposit-block #balance').text(data.bonus.toFixed(2));
			$('.balance-item.bonus .value').text(data.bonus.toFixed(2));
		}
    })
	.on('chat', function (data) {
		if(admin == 1 || moder == 1) {
            var panel = '';
			if(!data.ban) {
				panel += '<div class="delete">';
				panel += '<button type="button" class="btn btn-light" onclick="chatdelet('+ data.time2 +')">';
				panel += '<svg class="icon"><use xlink:href="/img/symbols.svg#icon-close"></use></svg><span>Удалить</span>';
				panel += '</button>';
				if(!data.admin) {
					panel += '<button type="button" class="btn btn-light btnBan" data-name="' + data.username + '" data-id="' + data.unique_id + '">';
					panel += '<svg class="icon">';
					panel += '<use xlink:href="/img/symbols.svg#icon-ban"></use>';
					panel += '</svg><span>Забанить</span>';
				}
				panel += '</button>';
			} else {
				panel += '<div class="delete">';
				panel += '<button type="button" class="btn btn-light" onclick="chatdelet('+ data.time2 +')">';
				panel += '<svg class="icon"><use xlink:href="/img/symbols.svg#icon-close"></use></svg><span>Удалить</span>';
				panel += '</button>';
				if(!data.admin) {
					panel += '<button type="button" class="btn btn-light btnUnBan" data-name="' + data.username + '" data-id="' + data.unique_id + '">';
					panel += '<svg class="icon">';
					panel += '<use xlink:href="/img/symbols.svg#icon-ban"></use>';
					panel += '</svg><span>Разбанить</span>';
					panel += '</button>';
				}
				panel += '</div>';
			}
        } else {
            var panel = '';
        }
		var name = data.username;
		var type = data.admin ? 'isAdmin' : (data.moder ? 'isModerator' : '');
        if(data.admin) name = '<span class="admin-badge isAdmin" data-toggle="tooltip" data-placement="top" title="Администратор"><span class=""><svg class="icon icon-a"><use xlink:href="/img/symbols.svg#icon-a"></use></svg></span></span> Администратор ';
        if(data.moder) name = '<span class="admin-badge isModerator" data-toggle="tooltip" data-placement="top" title="Модератор"><span class=""><svg class="icon icon-m"><use xlink:href="/img/symbols.svg#icon-m"></use></svg></span></span> ' + data.username;
        if(data.youtuber) name = '<span class="admin-badge isYouTuber" data-toggle="tooltip" data-placement="top" title="YouTuber"><span class=""><svg class="icon icon-y"><use xlink:href="/img/symbols.svg#icon-y"></use></svg></span></span> ' + data.username;
		var messages = data.messages;
		$('.chat-conversation-inner').append(
			'<div class="message-block user_' + data.unique_id + '" id="chatm_' + data.time2 + '" >' +
			'<div class="message-avatar ' + type + '"><img src="' + data.avatar + '" alt=""></div>' +
			'<div class="message-content">' +
			'<div>' +
			'<button class="user-link" type="button" data-id="' + data.unique_id + '">' +
			'<span class="sanitize-name">' + data.rank +
			'<span class="sanitize-text" style="'+data.userStyle+'">' + name + '<span>&nbsp;</span></span>' +
			'</span>' +
			'</button>' +
			'<div class="message-text">' + messages + '</div>' +
			'</div>' +
			'</div>' +
			'' + panel + '' +
			'</div>'
		);
        if($('.chat-conversation-inner .message-block').length >= 20) $('.chat-conversation-inner .message-block:nth-child(1)').remove();
		container.scrollTop = container.scrollHeight - container.clientHeight;
		ps.update();
	})
	.on('chatdel', function (data) {
		$('#chatm_' + data.time2).remove();
		container.scrollTop = container.scrollHeight - container.clientHeight;
		ps.update();
	})
	.on('clear', function (data) {
		$('.chat-conversation-inner').html('');
	})
	.on('ban_message', function(data) {
		if(USER_ID == data.unique_id && data.ban) {
			$('.chat-message-input').remove();
			$('.chat').append('<div class="chat-ban-block"><div class="title">Чат заблокирован!</div><button type="button" class="btn btn-light unbanMe"><span>Разблокировать ( -50 <svg class="icon icon-coin balance"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg> )</span></button></div>');
		}
		if(USER_ID == data.unique_id && !data.ban) {
			$('.chat-ban-block').remove();
			$('.chat').append('<div class="chat-message-input"><div class="chat-textarea"><div class="chat-editable" contenteditable="true"></div></div><div class="chat-controls"><button class="item" id="smilesBlock" data-toggle="popover" data-placement="top" data-html="true"><svg class="icon icon-smile"><use xlink:href="/img/symbols.svg#icon-smile"></use></svg></button><button type="submit" class="item sendMessage"><svg class="icon icon-send"><use xlink:href="/img/symbols.svg#icon-send"></use></svg></button></div></div>');
		}
	})
	.on('giveaway', function(res) {
		if(res.type == 'new') {
			if($('.giveNone').length) $('.giveNone').remove();
			var seconds = res.data.time_to,
				hour = (((seconds - seconds % 3600) / 3600) % 60 < 10 ? '0' + ((seconds - seconds % 3600) / 3600) % 60 : ((seconds - seconds % 3600) / 3600) % 60),
				min = (((seconds - seconds % 60) / 60) % 60 < 10 ? '0' + ((seconds - seconds % 60) / 60) % 60 : ((seconds - seconds % 60) / 60) % 60),
				sec = (seconds % 60 < 10 ? '0' + seconds % 60 : seconds % 60),
				time = hour +':'+ min +':'+ sec,
				html = '',
				group_sub = (res.data.group_sub ? '<div class="faucet-sm-text">• Быть подписанным на нашу <a href="'+ settings.vk_url +'" target="_blank">группу VK</a>.</div>' : ''),
				min_dep = (res.data.min_dep ? '<div class="faucet-sm-text">• Пополнить счет на сумму '+ parseFloat(res.data.min_dep).toFixed(2) +'р. за текущий день.</div>' : ''),
				ruleBlock = (res.data.group_sub || res.data.min_dep ? '<div class="give-btn-block nowGive"><div class="faucet-reload"><div class="faucet-cd">Для участия необходимо:</div><div class="text-left">'+ group_sub +''+ min_dep +'</div></div></div>' : '');
				html += '<div class="faucet-modal-give" id="gv_'+ res.data.id +'"><div class="give-btn-block"><div class="faucet-reload"><div class="faucet-cd">Раздача #'+ res.data.id +'</div></div></div><div class="row"><div class="col-6"><div class="bank-text">Сумма:</div><div class="bank-amount">'+ parseFloat(res.data.sum).toFixed(2) +' <svg class="icon icon-coin '+ res.data.type +'"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></div></div><div class="col-6"><div class="date-text">До начала:</div><div class="date-of">'+ time +'</div></div></div>'+ ruleBlock +'<div class="give-btn-block nowGive"><button type="button" class="btn btn-green joinGiveaway" data-id="'+ res.data.id +'"><span>Учавствовать</span></button><div class="faucet-sm-text">Участников: <span class="total_users">0</span></div></div><div class="give-btn-block"><div class="faucet-reload"><div class="faucet-cd">Победитель:</div><div class="winnerGive">Нет</div></div></div></div>'
			$('.gv-list').prepend(html);
			if($('.faucet-modal-give.doneGive').length >= 4) $('.faucet-modal-give.doneGive:nth-child(4)').remove();
		}
		if(res.type == 'newUser') $('#gv_' + res.id + ' .total_users').html(res.count);
		if(res.type == 'timer') {
			if(res.status == 1) $('#gv_' + res.id + ' .date-of').html('Проведена');
			else $('#gv_' + res.id + ' .date-of').html(res.hour+':'+res.min+':'+res.sec);
		}
		if(res.type == 'winner') {
			$('#gv_' + res.id).addClass('doneGive');
			$('#gv_' + res.id + ' .date-of').html('Проведена');
			$('#gv_' + res.id + ' .nowGive').remove();
			if(res.winner) $('#gv_' + res.id + ' .winnerGive').html('<button type="button" class="btn btn-link" data-id="'+ res.winner.unique_id +'"><span class="sanitize-user"><div class="sanitize-avatar"><img src="'+ res.winner.avatar +'" alt=""></div><span class="sanitize-name">'+ res.winner.username +'</span></span></button>');
			if($('.faucet-modal-give.doneGive').length >= 4) $('.faucet-modal-give.doneGive:nth-child(4)').remove();
		}
		if(res.type == 'delete') {
			$('#gv_' + res.id).remove();
			if($('.faucet-modal-give').length == 0) $('.gv-list').html('<div class="faucet-modal-give giveNone"><div class="give-btn-block"><div class="faucet-reload"><div class="faucet-cd">Раздач нет</div></div></div></div>');
		}
	});
	
	if(USER_ID == null) $('#confirmAgeModal').modal('show');
});

function initBalance() {
	if(!localStorage.getItem('balance')) localStorage.setItem('balance', 'balance');
	if(localStorage.getItem('balance') == 'balance') {
		$('.deposit-wrap .dropdown-toggle .selected').removeClass('bonus');
		$('.deposit-wrap .dropdown-toggle .selected').addClass('balance');
		$('#exchange').remove();
		$('#wallet').remove();
		$('.deposit-block').append('<button type="button" class="btn" id="wallet">Кошелек</button>');
		type = 'balance';
	} else {
		$('.deposit-wrap .dropdown-toggle .selected').addClass('bonus');
		$('.deposit-wrap .dropdown-toggle .selected').removeClass('balance');
		$('#exchange').remove();
		$('#wallet').remove();
		$('.deposit-block').append('<button type="button" class="btn btn-light-gray" id="exchange">Обменять</button>');
		type = 'bonus';
	}
	var value = $('.balance-item.' + type + ' #'+ type +'_bal').text();
	$('.deposit-block #balance').text(value);
}


function copyToClipboard(element) {
    var $temp = $('<input>'),
		clear;
	$('.copy-tooltip').removeClass('visible');
	clearInterval(clear);
    $('body').append($temp);
    $temp.val($(element).val()).select();
    document.execCommand('copy');
    $temp.remove();
    $('.copy-tooltip').addClass('visible');
	clear = setInterval(function() {
		clearInterval(clear);
		$('.copy-tooltip').removeClass('visible');
	}, 1000)
}
$(function() {
    const accordionHeader = $('.accordion-header');
    const accordionContent = $('.accordion-content');
    const accordionCloseIcon = $('.accordion-header__switch');

    $(accordionHeader).click(function () {
        $(accordionContent).slideToggle();
        $(accordionCloseIcon).toggleClass('accordion-header__switch-close');
    })
});
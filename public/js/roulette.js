$(document).ready(() => {
    window.socket = io.connect(':8443');
    window.double = {};

    socket.on('roulette', (res) => {
        if(res.type == 'timer') $('#rez-numbr').text((res.time > 9) ? res.time : '0'+res.time);
        if(res.type == 'slider')
        {
            $('.double-timer').hide();
            $('#reletteact').css({
                'transition' : 'transform '+res.slider.time+'ms ease',
                'transform' : 'rotate('+res.slider.rotate+'deg)'
            });
            setTimeout(() => {
                if(res.slider.color == 'red') {
					$('.double-rel').show().css({background: '#dd4137'}).text(res.slider.num);
                } else if(res.slider.color == 'green') {
					$('.double-rel').show().css({background: '#56c05a'}).text(res.slider.num);
                } else {
					$('.double-rel').show().css({background: '#32383b'}).text(res.slider.num);
                }
				if($('#soundController').val() == 'on') audio('/sounds/double-end.wav', 0.3);
            }, res.slider.time);
        }
        if(res.type == 'newGame') 
        {
			$('#hash').text(res.hash);
            $('.double-last').prepend('<a class="double-last-i '+res.history.color+'">'+res.history.num+'</a>')
            $('.rates-top .bet').text(0);
            $('#roundId').text(res.id);
            $('.bets').slideUp(200, () => {
                $('.bets').html('');
                $('.bets').show();
            });
            $('#reletteact').css({
                'transition' : 'transform 0s linear',
                'transform' : 'rotate('+res.slider.rotate+'deg)'
            });
			$('.double-rel').hide();
			$('.double-timer').show();
            $('#rez-numbr').text(res.slider.time);
			$('.tooltip').tooltipster({
				side: 'bottom',
				theme: 'tooltipster-borderless'
			});
        }
        if(res.type == 'bets') return double.makeBets(res.bets, res.prices);
    });

    double.makeBets = function(bets, prices)
    {
        var colors = [];
        for(var i in bets)
        {
            let bet = bets[i];
            if(typeof colors[bet.type] == 'undefined') colors[bet.type] = '';
			colors[bet.type] += '<div class="rates-i" data-userid="'+bet.user_id+'"><div class="rates-ava"><img src="'+bet.avatar+'"></div><div class="hidden"><div class="rates-login"><b class="ell">'+bet.username+'</b></div><div class="rates-rub">'+bet.value+'</div></div></div>'
        }

        for(var color in colors) 
        {
            $('.rates-content_'+ color).html(colors[color]);
            $('#bank_' + color).text((typeof prices[color] == 'undefined') ? '0' : prices[color]);
        }
    }

    double.getMyBet = function(type, callback) {
        $.ajax({
            url : '/roulette/getBet',
            type : 'post',
            data : {
                type : type
            },
            success : (res) => {
                callback(res);
            },
            error : (err) => {
                console.log(err.responseText);
                callback(0);
            }  
        });
    }

    double.addBet = function() {
        let value = parseInt($('#sum').val());
        if(isNaN(value)) return $.notify({
            position : 'top-right',
            type: 'error',
            message: 'Incorrect bet amount entered'
        });

        $.ajax({
            url : '/roulette/addBet',
            type : 'post',
            data : {
                bet : value,
                type : $(this).attr('data-bet-type')
            },
            success : (res) => {
                $.notify({
                    position : 'top-right',
                    type: (res.success) ? 'success' : 'error',
                    message: res.msg
                });
            },
            error : (err) => {
                $.notify({
                    position : 'top-right',
                    type: 'error',
                    message: 'Error when sending data to the server'
                });
            }
        });
    }

    $('.betButton').click(double.addBet);

});
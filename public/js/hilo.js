$(document).ready(function() {
	$(document).on('click', '.btn-play', function() {
		$.ajax({
			url: '/hilo/newBet',
			type: 'post',
			data: {
				balance: localStorage.getItem('balance') || 'balance',
				type: $('.btnToggle .btn-bet.isActive').data('type'),
				sum: $('#sum').val()
			},
			success: function(data) {
				$.notify({
					type: data.type,
					message: data.msg
				});
			}
		})
	});
	var socket = io.connect(':8443');

	socket.on('hilo.newBet', function(data) {
		var html = '';
        
        data.bets.forEach(function (bet) {			
			html += '<tr><td class="username"><button type="button" class="btn btn-link" data-id="'+ bet.unique_id +'"><span class="sanitize-user"><div class="sanitize-avatar"><img src="'+ bet.avatar +'" alt=""></div><span class="sanitize-name" style="'+ bet.style +'">'+ bet.username +'</span></span></button></td><td><div class="bet-number"><span class="bet-wrap"><span>'+ bet.sum +'</span><svg class="icon icon-coin '+ bet.balance +'"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span></div></td><td>'+ bet.type +'</td><td>'+ bet.multipler +'x</td><td><div class="bet-number"><span class="bet-wrap win"><span>'+ bet.win +'</span><svg class="icon icon-coin '+ bet.balance +'"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span></div></td></tr>';
        });
		
		$('#bets').html(html);
    });
	socket.on('hilo.timer', function(data) {
		var time = data.time*(304.844/data.total);
		$('#timer').css({
			'stroke-dashoffset' : time
		})
    });
	socket.on('hilo.newGame', function(data) {
		$('.betButton').attr('disabled', false);
		$('.betButton').removeClass('item_darken');
		$('#hash').html(data.game.hash);
		$('#gameId').html(data.game.id);
		$('.hilo-flipper').removeAttr('style');
		$('.hilo-flipper').css({
			'transform' : 'rotateY(180deg) scale(1)'
		});
		$('.hilo-flipper').removeClass('flip');
		$('.hilo-card-region .hilo-deck-card').removeAttr('style');
		$('.hilo-history .hilo-history-card').removeClass('isAnimate');
		$('#bets').html('');
    });
	socket.on('hilo.getFlip', function(data) {
		$('.betButton').attr('disabled', true);
		$('.betButton').addClass('item_darken');
		$('.hilo-flipper').removeClass('flip');
		$('#timer').css({
			'stroke-dashoffset' : 304.844
		});
		var stroke = '#ffffff';
		var stroke_back = 'rgba(255, 255, 255, 0.4)';
		if(data.hilo.section == 'red') {
			var stroke = '#fb0f42';
			var stroke_back = 'rgba(251, 15, 66, 0.4)';
		}
		if(data.hilo.section == 'black') {
			var stroke = '#000000';
			var stroke_back = 'rgba(0, 0, 0, 0.4)';
		}
		if(data.history) {
			setTimeout(function() {
				$('.hilo-card-region .hilo-deck-card').addClass('rightDirection');
			}, 1000);
			setTimeout(function() {
            	$('.hilo-history .hilo-history-card').addClass('isAnimate');
				if(data.history.card_sign == 'hi') var type = '<img src="/img/hilo-card-arrow.png" class="hilo-history-feed-sign hilo-history-feed__comparison-sign_hi">';
				else if(data.history.card_sign == 'lo') var type = '<img src="/img/hilo-card-arrow.png" class="hilo-history-feed-sign hilo-history-feed__comparison-sign_lo">';
				else if(data.history.card_sign == 'eq') var type = '<img src="/img/hilo-card-eq.png" class="hilo-history-feed-sign hilo-history-feed__comparison-sign_eq">';
				else var type = '';
				var html = '';
					html += '<div class="hilo-history-card hilo-card hilo-card_sm hilo-card_'+ data.history.card_section +' isAnimate checkGame" data-hash="'+ data.history.hash +'">';
					html += '<div class="hilo-card-num">'+ data.history.card_name +'</div>';
					html += '<div class="hilo-history-feed">'+ type +'</div>';
					html += '</div>';
				$('.hilo-history').prepend(html);
				setTimeout(() => {
					$('.card-front').removeClass('hilo-card_red');
					$('.card-front').removeClass('hilo-card_black');
					$('.card-front').removeClass('hilo-card_joker');
					$('.card-front').addClass('hilo-card_'+data.hilo.section);
					$('.card-front .hilo-sign').html(data.hilo.name);
					$('#timer_back').attr({ stroke: stroke_back});
					$('#timer').attr({ stroke: stroke});
				}, 260);
			}, 2100);
		}
		setTimeout(function() {
			$('.hilo-card-region .hilo-deck-card').removeClass('rightDirection');
			$('.card-front').addClass('hilo-card_'+data.hilo.section);
			$('.card-front .hilo-sign').html(data.hilo.name);
			$('#timer_back').attr({ stroke: stroke_back});
			$('#timer').attr({ stroke: stroke});
			$('.hilo-flipper').addClass('flip');
			$('.factor_hi').html(data.hilo.hi+'x');
			$('.factor_lo').html(data.hilo.lo+'x');
			$('.probability_hi').html(data.hilo.hi_perc+'%');
			$('.probability_lo').html(data.hilo.lo_perc+'%');
			$('.hilo-statistics-colors-ratio .ratio__red').html(data.stats.red_perc+'%');
			$('.hilo-statistics-colors-ratio .ratio__red').css({width: data.stats.red_perc+'%'});
			$('.hilo-statistics-colors-ratio .ratio__black').html(data.stats.black_perc+'%');
			$('.hilo-statistics-colors-ratio .ratio__black').css({width: data.stats.black_perc+'%'});
			$('.card_stat_2 .hilo-statistics__card-label span').html(data.stats.cards.two.count);
			$('.card_stat_3 .hilo-statistics__card-label span').html(data.stats.cards.three.count);
			$('.card_stat_4 .hilo-statistics__card-label span').html(data.stats.cards.four.count);
			$('.card_stat_5 .hilo-statistics__card-label span').html(data.stats.cards.five.count);
			$('.card_stat_6 .hilo-statistics__card-label span').html(data.stats.cards.six.count);
			$('.card_stat_7 .hilo-statistics__card-label span').html(data.stats.cards.seven.count);
			$('.card_stat_8 .hilo-statistics__card-label span').html(data.stats.cards.eight.count);
			$('.card_stat_9 .hilo-statistics__card-label span').html(data.stats.cards.nine.count);
			$('.card_stat_J .hilo-statistics__card-label span').html(data.stats.cards.J.count);
			$('.card_stat_Q .hilo-statistics__card-label span').html(data.stats.cards.Q.count);
			$('.card_stat_K .hilo-statistics__card-label span').html(data.stats.cards.K.count);
			$('.card_stat_A .hilo-statistics__card-label span').html(data.stats.cards.A.count);
			$('.card_stat_JOKER .hilo-statistics__card-label span').html(data.stats.cards.JOKER.count);
			$('.card_stat_2 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.two.perc+'%'});
			$('.card_stat_3 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.three.perc+'%'});
			$('.card_stat_4 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.four.perc+'%'});
			$('.card_stat_5 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.five.perc+'%'});
			$('.card_stat_6 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.six.perc+'%'});
			$('.card_stat_7 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.seven.perc+'%'});
			$('.card_stat_8 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.eight.perc+'%'});
			$('.card_stat_9 .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.nine.perc+'%'});
			$('.card_stat_J .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.J.perc+'%'});
			$('.card_stat_Q .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.Q.perc+'%'});
			$('.card_stat_K .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.K.perc+'%'});
			$('.card_stat_A .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.A.perc+'%'});
			$('.card_stat_JOKER .hilo-statistics__card-frequency-progress').css({height: data.stats.cards.JOKER.perc+'%'});
		}, 2400);
    });
});
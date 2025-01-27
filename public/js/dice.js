$(document).ready(function() {
	var timerId;
	var socket = io.connect(':8443');
	
	$('.btn-play').click(function(e) {
		if($('.btn-play').attr('disabled') == 'true') return;
		e.preventDefault();
		clearTimeout(timerId);
		$('.btn-play').prop('disabled', true);
		$.ajax({
			url: "/dice/play",
			type: 'post',
			data: {
				type: $(this).data('type'),
				balance: localStorage.getItem('balance') || 'balance',
				sum: $('#sum').val(),
				perc: $('#chance').val()
			},
			success: function(data) {
				if(data.status == 'success') {
					$('.dice-roll .dice__cube').addClass('visible');
					$('.dice-roll').css({
						transform: 'translate('+ data.chislo +'%, 0px)'
					});
					$('.game-dice .result').addClass('visible');
					var currentNumber = $('.game-dice .result').text();
					$({numberValue: currentNumber}).animate({numberValue: data.chislo}, {
						duration: 300,
						easing: 'linear',
						step: function (now) {
							$('.game-dice .result').text(now.toFixed(0)); 
						}
					});
					$('.dice-roll .dice__cube').removeClass('positive');
						$('.game-dice .result').removeClass('positive');
					$('.dice-roll .dice__cube').removeClass('negative');
					$('.game-dice .result').removeClass('negative');
					setTimeout(function() {
						if(data.win == 1) {
							$('.dice-roll .dice__cube').addClass('positive')
							$('.game-dice .result').addClass('positive')
						} else {
							$('.dice-roll .dice__cube').addClass('negative');
							$('.game-dice .result').addClass('negative');
						}
					}, 200);
					timerId = setTimeout(function() {
						$('.dice-roll .dice__cube').removeClass('visible')
					}, 4000)
					$('.hash .text').text(data.hash);
				} else {
					$.notify({
						type: data.type,
						message: data.msg
					});
				}
				$('.btn-play').prop('disabled', false)
			}
		})
	});
	
	socket.on('dice', function (data) {
		if(data.win == 0) {
			var status = 'lose';
			var win_sum = data.win_sum;
		} else {
			var status = 'win';
			var win_sum = '+'+data.win_sum;
		}
		
		var html = '';
		html += '<tr><td class="username"><button type="button" class="btn btn-link" data-id="'+ data.unique_id +'"><span class="sanitize-user"><div class="sanitize-avatar"><img src="'+ data.avatar +'" alt=""></div><span class="sanitize-name" style="'+ data.style +'">'+ data.username +'</span></span></button></td><td><div class="bet-number"><span class="bet-wrap"><span>'+ parseFloat(data.sum).toFixed(2) +'</span><svg class="icon icon-coin '+ data.balType +'"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span></div></td><td>'+ data.num +'</td><td>'+ data.range +'</td><td>'+ parseFloat(data.perc).toFixed(2) +'%</td><td><div class="bet-number"><span class="bet-wrap"><span class="'+ status +'">'+ parseFloat(win_sum).toFixed(2) +'</span><svg class="icon icon-coin"><use xlink:href="/img/symbols.svg#icon-coin"></use></svg></span></div></td><td><button class="btn btn-primary checkGame" data-hash="'+ data.hash +'">Check</button></td></tr>';

		$('.table-stats-wrap tbody').prepend(html);
		if($('.table-stats-wrap tbody tr').length >= 20) $('.table-stats-wrap tbody tr:nth-child(21)').remove();
	});
	$('#sum, .range').on('change keydown paste input', function() {
		calc();
	});
	$(document).on('click', '.bet-component .btn-perc', function() {
		let value = parseFloat($('#chance').val()) || 0,
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
            case 'min' : 
                value = 1;
                break;
            case 'max' : 
                value = 95;
                break;
            case 'multiply' :
                value *= thisValue;
                break;
        }

        $('#chance').val(value.toFixed(2)).trigger('input');
		calc();
    });
	$('#chance').on('input change', function() {
		var value = $(this).val();
		if(value > 95) {
			value = 95;
		}
		if(value < 1) {
			value = 1;
		}
		$(this).val(parseFloat(value).toFixed(2));
		$('#chance_val').text(parseFloat(value).toFixed(2));
		calc();
	});
});
function calc() {
    $('#win').html(((100 / $('#chance').val()) * $('#sum').val()).toFixed(2));
	$('#min_tick').html('0 - ' + Math.floor(($('#chance').val() / 100) * 999999));
	$('#max_tick').html(999999 - Math.floor(($('#chance').val() / 100) * 999999) + ' - 999999');
}
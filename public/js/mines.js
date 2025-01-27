var socket = io.connect(':8443');

socket.on('mines', function (data) {
	if(data.win_sum < 1) {
		var status = 'lose';
	} else {
		var status = 'win';
	}
	
	var html = '';
	html += '<tr>\
	<td class="username">\
	   <button type="button" class="btn btn-link" data-id="'+ data.unique_id +'">\
		  <span class="sanitize-user">\
			 <div class="sanitize-avatar"><img src="'+ data.avatar +'" alt=""></div>\
			 <span class="sanitize-name" style="'+ data.style +'">'+ data.username +'</span>\
		  </span>\
	   </button>\
	</td>\
	<td>\
	   <div class="bet-number">\
		  <span class="bet-wrap">\
			 <span>'+ data.sum +'</span>\
			 <svg class="icon icon-coin balance">\
				<use xlink:href="/img/symbols.svg#icon-coin"></use>\
			 </svg>\
		  </span>\
	   </div>\
	</td>\
	<td>'+ data.bombs +'</td>\
	<td>'+ data.coef +'x</td>\
	<td>\
	   <div class="bet-number">\
		  <span class="bet-wrap">\
			 <span class="'+ status +'">'+ data.win_sum +'</span>\
			 <svg class="icon icon-coin">\
				<use xlink:href="/img/symbols.svg#icon-coin"></use>\
			 </svg>\
		  </span>\
	   </div>\
	</td>\
 </tr>';

	$('.table-stats-wrap tbody').prepend(html);
	if($('.table-stats-wrap tbody tr').length >= 20) $('.table-stats-wrap tbody tr:nth-child(21)').remove();
});

function getCoffNew(count, steps, mines) {
	var coeff = 1;
	for(var i = 0; i < (mines - count) && steps > i; i++) {
		coeff *= ((mines - i) / (mines - count - i));
	}
	return coeff;
}
function renderCoefs(val, multi = 1) {
	$('.progress__left > .progress__number').html(Number(25-val));
	$('.progress__right > .progress__number').html(Number(val));
	$('.hits__area .carousel-inner').html('')
	let step = 0;
	for(var i = 1; i <= Math.ceil((25-val) / 4); i++) {
		let x = "";
		let ceils = (25-val >= 4) ? 4 : 25 - val;
		for(var s = 1; s <= ceils; s++) {
			let coef = getCoffNew(val, step+1, 25);
			if(step < 25-val) {
			x+= `
				<div class="hits__item">
				<div class="hits__coef">x${ (coef.toFixed(2) * multi).toFixed(2).replace('.00', '') }</div>
				<div class="hits__step">Move ${ Number(step + 1) }</div>
				</div>
				`;
			step++;
			}
		}
		$('.hits__area .carousel-inner').append(`<div class="items-4 carousel-item ${ (i == 1) ? 'active' : '' }">${x}</div>`);
	}
}
$(document).on('click', '.btn-action[data-select]', function(e) {
	$('.btn-action[data-select]').removeClass('isActive');
	$(this).addClass('isActive');
	renderCoefs($(this).attr('data-select'))
})

$(document).on('click', '#startMines', function(e) {
	$.post('/mines/create', {
		bomb: $('.btn-action.isActive').attr('data-select'),
		bet: $('#sum').val()
	})
	.then(e => {
		if(e.error) return $.notify({ type: 'error', message: e.msg });
		$('.btn-action[data-select]').attr('disabled', true);
		renderCoefs($('.btn-action.isActive').attr('data-select'), 1);
		for(i = 0; i <= 25; i++) {
			$('.mines__btn:nth-of-type('+i+')').html('').removeClass('active use').css({'opacity': '1'}).attr('disabled', false);
		}
		$('.hits__item').removeClass('active')
		$('.game-tooltip').remove()
		$('#startMines').hide();
		$('#finishMines').show().html('Collect <span class="mines__win">'+ Number($('#sum').val()).toFixed(2) +'</span>')
		$('.carousel').carousel(0);
	})
	.fail(() => {
		$.notify({
		 	type: 'error',
		 	message: 'Server error' 
		 });
	})
});
$(document).on('click', '#finishMines', function(e) {
	$.post('/mines/claim', {

	})
	.then(e => {
		if(e.error) return $.notify({ type: 'error', message: e.msg });
		$.notify({ type: 'success', message: e.msg });
        e.bombs.forEach(i => {
           $('.mines__btn:nth-of-type('+i+')').html('<div class="progress__img" style="opacity: 0.5"><img src="/static/media/bomb.png" alt="" draggable="false"></div>').addClass('use').attr('disabled', true);
        })
		$('.game-area-content').append(`<div class="game-tooltip isTransparent isActive won" style="top: 50%;left: 50%;transform: translate(-50%, -50%);">`+
										`<div class="wrap">`+
											`<div class="payout">x${e.coef.toFixed(2)}</div>`+
											`<div class="badge">`+
												`<div class="text">Victory</div>`+
											`</div>`+
											`<div class="status">You won&nbsp;<span class="profit">${Number(e.win).toFixed(2)}</span>`+
											`</div>`+
										`</div>`+
									`</div>`);
		renderCristall()
    $('#startMines').show()
		return $('#finishMines').hide();
	})
	.fail(() => {
		$.notify({
			type: 'error',
			message: 'Server error' 
		});
	})
})
$(document).on('click', '.mines__btn', function(e) {
	for(i = 0; i <= 25; i++) {
		$('.mines__btn:nth-of-type('+i+')').attr('disabled', true);
	}
	$.post('/mines/open', {
		open: $(this).attr('data-number')
	})
	.then(e => {
		if(e.error) {
			if(e.noend || !e.bombs) {
				for(i = 0; i <= 25; i++) {
					$('.mines__btn:nth-of-type('+i+')').attr('disabled', false);
				}
				return $.notify({ type: 'error', message: e.msg });
			}
	        e.bombs.forEach(i => {
	           $('.mines__btn:nth-of-type('+i+')').html('<div class="progress__img"><img src="/static/media/bomb.png" alt="" draggable="false"></div>').addClass('use').css({'opacity': '0.5'}).attr('disabled', true);
	        })
	        renderCristall()
	        $('.mines__btn:nth-of-type('+$(this).attr('data-number')+')').prepend('<span class="mines_appear"></span>').addClass('active').css({'opacity': '1'})
            $('#startMines').show()
			return $('#finishMines').hide();
		}
		$(this).addClass('active').html('<span class="mines_appear"></span><div class="progress__img"><img src="/static/media/gem.svg" alt="" draggable="false"></div>').addClass('use').attr('disabled', true)
		$('.hits__item').removeClass('active')
		$('.hits__item:eq('+ Number(e.step - 1) +')').addClass('active');
		$('.carousel').carousel(Math.ceil(e.step/4)-1);
		$('.mines__win').html(Number(e.withoutMulti).toFixed(2))
		for(i = 0; i <= 25; i++) {
			$('.mines__btn:nth-of-type('+i+')').attr('disabled', false);
		}
		if(e.multiplayer > 1) {
			let x = "";
			e.multix.forEach(s => {
				x+='<div class="item"><div class="item-bet" style="color: #a6caf0;">x'+ s +'</div></div>';
			})
			for(i = 0; i <= 25; i++) {
				$('.mines__btn:nth-of-type('+i+')').attr('disabled', true);
			}
			$('#finishMines').attr('disabled', true);
			$('.hits__area').hide();
			$('.mines__multi').fadeIn();
			$('.game-history').css({'transition': '0s', 'transform': 'translate3d(0px, 0px, 0px)'})
			setTimeout(() => {
				$('.game-history').html(x).css({'transition': '5s', 'transform': 'translate3d(-855px, 0px, 0px)'})	
				$('.game-history .item:nth-child(24)').html('<div class="item-bet" style="color: #a6caf0;">x'+ e.multiplayer +'</div>');
			}, 50);
			setTimeout(() => {
				for(i = 0; i <= 25; i++) {
					$('.mines__btn:nth-of-type('+i+')').attr('disabled', false);
				}
				$('#finishMines').attr('disabled', false);
				$('.mines__multi').hide();
				$('.hits__area').fadeIn();
				renderCoefs($('.btn-action.isActive').attr('data-select'), e.multiplayer);
				$('.mines__win').html(Number(e.coef).toFixed(2))
				$('.hits__item:eq('+ Number(e.step - 1) +')').addClass('active');
				$('.carousel').carousel(Math.ceil(e.step/4)-1);
			}, 7500);
		} else {
			$('.mines__win').html(Number(e.coef).toFixed(2))
		}
	})
	.fail(() => {
		for(i = 0; i <= 25; i++) {
			$('.mines__btn:nth-of-type('+i+')').attr('disabled', false);
		}
		$.notify({
		 	type: 'error',
		 	message: 'Server error' 
		 });
	})
})

function renderCristall() {
  $('.btn-action[data-select]').attr('disabled', false);
  for(i=0;i<=25;i++) {
    let mine_now = $('.mines__btn:nth-of-type('+i+')');
    if(mine_now.hasClass('use')) {
      // nothing to do
    } else {
      mine_now.html('</span><div class="progress__img"><img src="/static/media/gem.svg" alt="" draggable="false"></div>').css({'opacity': '0.5'}).addClass('use').attr('disabled', true)
    }
  }
}
function renderMines() {
  $.post('/mines/get', {

  }).then(e => {
      if(e.status == 1) {
        $('#startMines').hide()
		$('#finishMines').show().html('Collect <span class="mines__win">'+ e.coef.toFixed(2) +'</span>');
		renderCoefs(e.bombs, e.multiplayer)
		$('.hits__item:eq('+ Number(e.step - 1) +')').addClass('active');
		$('.carousel').carousel(Math.ceil(e.step/4)-1);
		$('.btn-action[data-select]').removeClass('isActive').attr('disabled', true);
		$('.btn-action[data-select='+ e.bombs +']').addClass('isActive');
        for(i=0;i<=25;i++) {
          $('.mines__btn:nth-of-type('+i+')').attr('disabled', false);
        }
        setTimeout(() => {
          e.click.forEach(i => {
           $('.mines__btn:nth-of-type('+i+')').addClass('active').html('<span class="mines_appear"></span><div class="progress__img"><img src="/static/media/gem.svg" alt="" draggable="false"></div>').addClass('use').attr('disabled', true)
          })
        }, 150);
      }
  })
}
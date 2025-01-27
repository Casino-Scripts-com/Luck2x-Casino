function kingBet() {
	$.post('/king/bet', {
		bet: $('#sum').val()
	})
	.then(e => {
		if(e.error) return $.notify({ type: 'error', message: e.msg });
		$.notify({
		 	type: 'success',
		 	message: 'The bet is accepted!' 
		 });
	})
	.fail(() => {
		$.notify({
		 	type: 'error',
		 	message: 'Server error' 
		 });
	})
}
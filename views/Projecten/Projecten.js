$(document).ready(function(){
	console.log('test');
	$('input').on('click', function () {
		if($(this).attr() === 'password'){
			$(this).attr('type', 'text'); 
		}else{
			$(this).attr('type', 'password'); 
		}
	});
});
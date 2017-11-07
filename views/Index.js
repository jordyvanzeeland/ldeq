$(document).ready(function(){

	/** Live search function  */

	$('.search').on('keyup', function(){
		var Search = $(this).val();
		if(Search != ''){
			$('.SearchResults').html('');
			$.ajax({
				url: '/ldeq/views/LiveSearch.php',
				method: 'POST',
				data: {action: 'LiveSearch', Search: Search},
				success:function(data){
					console.log(data);
				}
			})
		}else{
			
		}
	});
});
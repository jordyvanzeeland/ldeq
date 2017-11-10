$(document).ready(function(){

	/** Live search function  */

	$('.search').on('keyup', function(){
		var Search = $(this).val();
		if(Search != ''){
			$('.SearchResults').html('');
			$.ajax({
				url: '/ldeq/views/LiveSearch.php',
				method: 'POST',
				data: {action: Search, Search: Search},
				success:function(results){

					$('.SearchResults').html('<table width="100%"><thead><tr><th>Projectnaam</th><th>ProjectUrl</th><th>Project category</th></tr></thead><tbody></tbody></table>')

					var data = JSON.parse(results);

					for(var i=0; i<data.length; i++){

						if(data[i].ProjectCat == 1){
							var Category = 'Lacle Design';
						}else{
							var Category = 'Equalizer C.P.D.';
						}
						$('.SearchResults table tbody').append('<tr><td>' + data[i].ProjectName + '</td><td>' + data[i].ProjectUrl + '</td><td>' + Category + '</td></tr>');
					}

					
				}
			})
		}else{

		}
	});

	$('.ProjectCategory').on('change', function(){

		$('.SearchResults').html('');
		$Filter = $(this).val();

		$.ajax({
				url: '/ldeq/views/Filter.php',
				method: 'POST',
				data: {
					Category: $Filter
				},
				success:function(results){

					$('.SearchResults').html('<table width="100%"><thead><tr><th>Projectnaam</th><th>ProjectUrl</th><th>Project category</th></tr></thead><tbody></tbody></table>')

					var data = JSON.parse(results);

					for(var i=0; i<data.length; i++){
						if(data[i].ProjectCat == 1){
							var Category = 'Lacle Design';
						}else{
							var Category = 'Equalizer C.P.D.';
						}
						$('.SearchResults table tbody').append('<tr><td>' + data[i].ProjectName + '</td><td>' + data[i].ProjectUrl + '</td><td>' + Category + '</td></tr>');
					}

					
				}
			})
	});

});
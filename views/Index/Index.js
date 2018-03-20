$(document).ready(function(){
	$('.search').on('keyup', function(){
		var Search = $(this).val();
		var Page = window.location.pathname;
		if(Search != ''){
			$('.SearchResults').html('');
			$.ajax({
				url: '/ldeq/views/LiveSearch.php',
				method: 'POST',
				data: {action: Search, Search: Search, page: Page},
				success:function(results){

					$('.SearchResults').html('<table style="float:left;margin-top:30px;" width="100%"><thead><tr><th>Projectnaam</th><th>ProjectUrl</th><th>Bekijk project</th></tr></thead><tbody></tbody></table>')

					var data = JSON.parse(results);

					for(var i=0; i<data.length; i++){
						$('.SearchResults table tbody').append('<tr><td>' + data[i].ProjectName + '</td><td>' + data[i].ProjectUrl + '</td><td><a href="/ldeq/project/details/' + data[i].id + '"><div class="btn" style="background-color:#d0ac53;color:#ffffff;font-size:14px;"><i class="fa fa-eye" aria-hidden="true"></i> Bekijk project</div></td></td></tr>');
					}

					
				}
			})
		}else{

		}
	});
});
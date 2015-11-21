$(document).ready(function(){
	$('.search').bind('keyup', function(e){
		if (e.keyCode === 13){
			var query = $(this).val();
			window.location = "search.php?query=" + query;
		}
	});

});
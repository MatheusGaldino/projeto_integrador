$(document).ready(function(){
	$('.subSearch select').on('change', function() {
	  $("#searchForm").submit();
	});
});
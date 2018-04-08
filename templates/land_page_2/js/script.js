$(document).ready(function(){
	$('a[href="'+location.href+'"').closest('li').addClass('active');
	$('#esg_search').on('submit', function(){
		var a = $('input[name="keyword"]').val();
		if(a === ""){
			alert("please fill the search form first");
			return false;
		}
	});
});
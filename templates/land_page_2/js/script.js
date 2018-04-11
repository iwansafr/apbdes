$(document).ready(function(){
	$('a[href="'+location.href+'"').closest('li').addClass('active');
	$('#esg_search').on('submit', function(){
		var a = $('input[name="keyword"]').val();
		if(a === ""){
			alert("please fill the search form first");
			return false;
		}
	});
	// $(document).bind("contextmenu",function(e){
	// 	alert('Sorry, This Functionality Has Been Disabled!');
 //   	return false;
 // 	});
	$(document).keydown(function(event) {
		var pressedKey = String.fromCharCode(event.keyCode).toLowerCase();
		if(event.ctrlKey && pressedKey == "u") {
			alert('Sorry, This Functionality Has Been Disabled!');
			return false;
		}
	});
});
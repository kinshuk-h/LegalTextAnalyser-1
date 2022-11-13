$(document).ready(function(){
	$(".read").click(function(){
		$(this).prev().toggle();
		$(this).siblings('.dots').toggle();
		if($(this).text()=='Read Less'){
			$(this).text('Read More');
		}
		else{
			$(this).text('Read Less');
		}
	});
});
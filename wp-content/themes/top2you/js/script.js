$(document).ready(function(){
	$('.navbar a').click(function(){
		$('html, body').animate({
		  scrollTop: $($(this).attr('href')).offset().top
		}, 1000);
	});
	$('.card .card-body').each(function(){
		var minHeight = 0;
		if($(this).height() > minHeight){
			minHeight = $(this).height();
		}
	});
	$('.card .card-body').css({'min-height':minHeight});
});
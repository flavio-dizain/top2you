$(document).ready(function(){
	$('.container-slider').css({'height':$(window).height()});

	$('.navbar a').click(function(){
		$('html, body').animate({
		  scrollTop: $($(this).attr('href')).offset().top
		}, 1000);
	});
	// $('.card .card-body').each(function(){
	// 	var minHeight = 0;
	// 	if($(this).height() > minHeight){
	// 		minHeight = $(this).height();
	// 	}
	// });
	// $('.card .card-body').css({'min-height':minHeight});

	$('.slick-slider-for').slick({
		slidesToShow: 1,
		slidesToScroll: 1,
		arrows: false,
		fade: true,
		asNavFor: '.slick-slider-nav'
	});
	$('.slick-slider-nav').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		asNavFor: '.slick-slider-for',
		centerMode: true,
		focusOnSelect: true,
		prevArrow: $('.slick-slider-prev'),
		nextArrow: $('.slick-slider-next'),
		responsive: [
	    {
	      breakpoint: 1300,
	      settings: {
	        slidesToShow: 4,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 1070,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    },
	    {
	      breakpoint: 768,
	      settings: {
	        slidesToShow: 3,
	        slidesToScroll: 1
	      }
	    }
	  ]
	});
	
});
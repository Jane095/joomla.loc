jQuery(document).ready(function($){
	var touch = $('#touch-menu');
	var menu = $('.navigation');

	$(touch).on('click', function(e) {
		e.preventDefault();
		menu.slideToggle();
	});
	$(window).resize(function(){
		var wid = $(window).width();
		if(wid > 1023 && menu.is(':hidden')) {
			menu.removeAttr('style');
		}
	});

	$(".services h2 a").click(function(event){
		event.preventDefault();
		$(".servicebox").toggleClass("open");
	});
	$(".articles h2 a").click(function(event){
		event.preventDefault();
		$(".articlebox").toggleClass("open");
	});
	$(".news h2 a").click(function(event){
		event.preventDefault();
		$(".newsbox").toggleClass("open");
	});

	$(".post-modul").fancybox({
		'titlePosition'		: 'inside',
		'transitionIn'		: 'none',
		'transitionOut'		: 'none'
	});

	$('#slider-wrap .slider').slick({
		slidesToShow: 1,
		arrows: true,
		fade: true,
		nextArrow: '.slide-next',
		prevArrow: '.slide-prew'
		
	});
	$('.guest-book .slider').slick({
		slidesToShow: 1,
		arrows: true,
		fade: true,
		nextArrow: '.nextquote',
		prevArrow: '.prewquote'
		
	});

	$('.scroll').click(function () {
		var delta_scroll_anchor = 0;
		var elementClick = $(this).attr("href")
		var destination = ($(elementClick).offset().top)-delta_scroll_anchor;
		jQuery("html:not(:animated),body:not(:animated)").animate({scrollTop: destination}, 800);
		return false;
	});

	$(".fancybox-thumb").fancybox({
		prevEffect	: 'none',
		nextEffect	: 'none',
		helpers	: {
			title	: {
				type: 'outside'
			},
			thumbs	: {
				width	: 50,
				height	: 50
			}
		}
	});

});


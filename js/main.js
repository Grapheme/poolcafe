var st = st || {};




st.init = function() {
	st.wh = $(window).height();
	
	$('section.slider').height(st.wh);
	
	st.news_wh = $('#news').height();
	st.rest_wh = $('#restaurant-info').height();
	st.pool_wh = $('#pool-info').height();	
	
	$('#news').attr('data-2000', 'top: 0px;');
	$('#news').attr('data-4800', 'top: -' + st.news_wh + 'px;');
	
	$('#restaurant-info').attr('data-6400', 'top: 0px;');
	$('#restaurant-info').attr('data-8000', 'top: -' + st.rest_wh + 'px;');
	
	$('#pool-info').attr('data-9600', 'top: 0px;');
	$('#pool-info').attr('data-10800', 'top: -' + st.pool_wh + 'px;');
};

$(function(){


	st.init();

	var wh = $(window).height();	

	
	/*
	var newsHeight = $('#news').height();
	var restHeight = $('#restaurant-info').height();
	var poolHeight = $('#pool-info').height();
	console.log(restHeight);
	
	$('#news').attr('data-2000', 'top: 0px;');
	$('#news').attr('data-4800', 'top: -' + newsHeight + 'px;');
	
	$('#restaurant-info').attr('data-6400', 'top: 0px;');
	$('#restaurant-info').attr('data-8000', 'top: -' + restHeight + 'px;');
	
	$('#pool-info').attr('data-9600', 'top: 0px;');
	$('#pool-info').attr('data-10800', 'top: -' + poolHeight + 'px;');
	
	console.log($('#restaurant-info').attr('data-6400'));
	console.log($('#restaurant-info').attr('data-8000'));
	/*$('#restaurant-info').attr('data-8000', '-120%;');
	console.log($('#restaurant-info').attr('data-8000'));
	/*$('#restaurant-info').attr({
		'data-6400' : 'top:0px;',
		'data-8000' : '-' + (rastheight) + 'px;'
	});*/
	
	
	$('#map-canvas').height(wh - 140);
	initialize();
		
	$('.__fotorama').fotorama({
		nav: 'dots', 
		transition: 'fade',
		autoplay: 'false',
		margin: 0,
		minPadding: 0,
		loop: true,
		cropToFit: true,
		width: '100%',
		height: st.wh,
		arrowNext: '<div class="arrows right_arrow"></div>',
		arrowPrev: '<div class="arrows left_arrow"></div>'
	});


	$('ul.navigationLinksList li a').click(function(e){
		e.preventDefault();
		
		var scrollTop = $(this).attr('data-scroll');
		$('html, body').animate({ 'scrollTop': scrollTop }, 1500);
		
		$('ul.navigationLinksList li a').removeClass('current-section');
		$(this).addClass('current-section');
	});
	
	var s = skrollr.init({ });
});

$(window).resize( function() {	
	st.init();
	
	$(function() {
		
    $('.__fotorama').fotorama({height: st.wh});
    });
	
	var s = skrollr.init({ });
});



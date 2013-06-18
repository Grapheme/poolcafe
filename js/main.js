var st = st || {};


st.init = function() {
	st.wh = $(window).height();
	
	$('section.slider').height(st.wh);
	
	st.news_wh = $('#news').height();
	st.rest_wh = $('#restaurant-info').height();
	st.pool_wh = $('#pool-info').height();		
	
	$('#news').attr({
		'data-2000' : 'top: 0px;',
		'data-5200' : 'top: -' + st.news_wh + 'px;'
	});
	
	$('#restaurant-info').attr({
		'data-6400' : 'top: 0px;',
		'data-9600' : 'top: -' + st.rest_wh + 'px;'
	});
	
	$('#pool-info').attr({
		'data-11000' : 'top: 0px;',
		'data-13000' : 'top: -' + st.pool_wh + 'px;'
	});
				
	$('nav.nav-dark').attr({
		'data-13000' : 'top:-100%;',
		'data-11000' : 'z-index:10002; top:0%;',
		'data-9610' : 'height: 100%; z-index:10001;',
		'data-9600' : 'height: 0%;',
		'data-6400' : 'z-index:10002;',
		'data-5210' : 'height:' + st.rest_wh + 'px; z-index:10001;',
		'data-5200' : 'height:0%;',
		'data-2000' : 'height:' + st.news_wh + 'px; z-index:10002;',
		'data-0' : 'height:0%; z-index:10001;'
	});
	
	$('nav.nav-light').attr({
		'data-13000' : 'top:-100%;',
		'data-11010' : 'height:100%; top:0%;',
		'data-11000' : 'height:0%; z-index:10001;',
		'data-9600' : 'z-index:10002;',
		'data-6410' : 'height:100%;',
		'data-6400' : 'height:0%; z-index:10001;',
		'data-5200' : 'z-index:10002;',
		'data-2010' : 'height:100%;',
		'data-2000' : 'height:0%; z-index:10001;',
		'data-0' : 'height:100%; z-index:10002;'
	});

};


$(function(){


	st.init();

	var wh = $(window).height();	
	
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
	var s = skrollr.init({ });
	$(function() {
		
    $('.__fotorama').fotorama({height: st.wh});
    });
	
	var s = skrollr.init({ });
});



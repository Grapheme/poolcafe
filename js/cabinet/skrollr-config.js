var st = st || {};
st.init = function() {
	st.wh = $(window).height();
	$('section.slider').height(st.wh);
	$('#map-canvas').height(st.wh - 140);
	st.news_wh = $('#news').height();
	st.rest_wh = $('#restaurant-info').height();
	st.pool_wh = $('#pool-info').height();
	$('#news').attr({
		'data-2600' : 'top: 0px;',
		'data-5800' : 'top: -' + (+st.news_wh + +10) + 'px;'
	});
	$('#restaurant-info').attr({
		'data-8200' : 'top: 0px;',
		'data-11400' : 'top: -' + (+st.rest_wh + +10) + 'px;'
	});
	$('#pool-info').attr({
		'data-14000' : 'top: 0px;',
		'data-16200' : 'top: -' + (+st.pool_wh + +10) + 'px;'
	});
	$('nav.nav-dark').attr({
		'data-16600' : 'top:-100%;',
		'data-14500' : 'z-index:10002; top:0%;',
		'data-11410' : 'height: 100%; z-index:10001;',
		'data-11400' : 'height: 0%;',
		'data-8200' : 'z-index:10002;',
		'data-5810' : 'height:' + st.rest_wh + 'px; z-index:10001;',
		'data-5802' : 'height:0%;',
		'data-2600' : 'height:' + st.news_wh + 'px; z-index:10002;',
		'data-2000' : 'height:' + st.news_wh + 'px; z-index:10002;',
		'data-0' : 'height:0%; z-index:10001;'
	});
	$('nav.nav-light').attr({
		'data-13400' : 'height:0%; z-index:10001;', 
		'data-12000' : 'z-index: 10002',
		'data-8200' : 'z-index: 10000',
		'data-7610' : 'height:100%;',
		'data-7600' : 'height:0%; z-index:10001;',
		'data-6400' : 'z-index:10001;',
		'data-2010' : 'height:100%;',
		'data-2000' : 'height:0%; z-index:10001;',
		'data-0' : 'height:100%; z-index:10002;'
	});
};

$(function(){
	$('ul.navigationLinksList li a').click(function(e){
		e.preventDefault();
		var scrollTop = $(this).attr('data-scroll');
		$('html, body').animate({ 'scrollTop': scrollTop }, 1500);
		$('ul.navigationLinksList li a').removeClass('current-section');
		$(this).addClass('current-section');
	});
	st.init();
	st.skroll = skrollr.init({ });
	initialize();
	
	$(window).resize( function() {
		st.init();
		st.skroll = skrollr.init({ });
		initialize();
	});
});
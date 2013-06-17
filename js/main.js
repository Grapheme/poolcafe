$(function(){

	var wh = $(window).height();
	
	$('section').height(wh);
	$('section.slider').height(wh);
	
	$('#map-canvas').height(wh - 140);
	//initialize();
		
	$('.__fotorama').fotorama({
		nav: 'dots', 
		transition: 'fade',
		autoplay: 'false',
		margin: 0,
		minPadding: 0,
		loop: true,
		cropToFit: true,
		width: '100%',
		height: wh,
		arrowNext: '<div class="arrows right_arrow"></div>',
		arrowPrev: '<div class="arrows left_arrow"></div>'
	});

});


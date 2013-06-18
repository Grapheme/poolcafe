jQuery("document").ready(function($) {
	var cntLight = $('[data-menu="light"]');
	var cntDark = $('[data-menu="dark"]');
	var cntFooter = $('[data-menu="footer"]');
	cntDark.each(function() {
		$(window).on('scroll', {
			value : $(this),
			nav : $(".nav-dark")
		}, clipping);
		$(window).on('load', {
			value : $(this),
			nav : $(".nav-dark")
		}, clipping);
		$(window).on('resize', {
			value : $(this),
			nav : $(".nav-dark")
		}, clipping);
	});	
	 /* =============
	 Black-color menu
	    ==============*/	
	cntLight.each(function() {
		$(window).on('scroll', {
			value : $(this),
			nav : $(".nav-light")
		}, clipping);
		$(window).on('load', {
			value : $(this),
			nav : $(".nav-light")
		}, clipping);
		$(window).on('resize', {
			value : $(this),
			nav : $(".nav-light")
		}, clipping);
	});	
	/* =============
	 White-color menu
	    ==============*/	
	cntFooter.each(function() {
		$(window).on('scroll', {
			value : $(this),
			nav : $(".nav-light,.nav-dark")
		}, clipping);
		$(window).on('load', {
			value : $(this),
			nav : $(".nav-light,.nav-dark")
		}, clipping);
		$(window).on('resize', {
			value : $(this),
			nav : $(".nav-light,.nav-dark")
		}, clipping);
	});	
	/* ==============
	 * Footer
	 * =============*/	 	
	function clipping(event) {
		//window.console.clear();
		
		var elt = event.data.value;
		//console.info('elt', elt);
		
		var navdark = event.data.nav;
		//console.info('navdark', navdark);
		
		var nsOffsetBot = navdark.offset().top + navdark.outerHeight(true) - 20;
		//window.console.info('nsOffsetBot', nsOffsetBot);
		
		var mainoffset = $(elt).offset().top;
		//window.console.info('mainoffset', mainoffset);
		
		var mainheight = $(elt).outerHeight(true);
		//window.console.info('mainheight', mainheight);
		
		if (nsOffsetBot >= mainoffset && ($(elt).attr('data-menu') != 'footer')) {
			window.console.info('******************** ПИЗДЕЦ **************************');
			topClip = mainoffset - $(window).scrollTop() - (navdark.offset().top - $(window).scrollTop());
			botClip = topClip + mainheight;
			navdark.css('clip', 'rect(' + topClip + 'px,auto,' + botClip + 'px,0)');
		}
		
		/*
		if (nsOffsetBot >= $(elt).offset().top && ($(elt).attr('data-menu') == 'footer')) {
			var deltaBottom = $(elt).offset().top - nsOffsetBot + 30;
			navdark.css('top', deltaBottom);
			if ($(elt).prev().attr('data-menu') == 'light')
				$(".nav-light").css('clip', 'rect(auto, auto, 370px, auto)');
			else
				$(".nav-dark").css('clip', 'rect(auto, auto, 370px, auto)');
		} else {
			navdark.css('top', '60px');
		}
		*/
	}

});

/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
$(function(){
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
});
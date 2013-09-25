/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

$(function(){
	$(".single-select-group").change(function(){
		var url = mt.currentURL.replace(/\?(.+)?/,'');
		if($(this).emptyValue() == false){
			url = url+'?group='+$(this).val();
		}
		mt.redirect(url);
	});
	$(".single-select-parent-category").change(function(){
		var url = mt.currentURL.replace(/\?(.+)?/,'');
		if($(this).emptyValue() == false){
			url = url+'?category='+$(this).val();
		}
		mt.redirect(url);
	});
	
});
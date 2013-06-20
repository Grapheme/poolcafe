/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
$(function(){
	var buttons = ['bold', 'italic', '|', 'unorderedlist', 'orderedlist', '|', 'image', 'video', 'file', '|'];
	$("textarea.redactor").redactor({
		focus: true,
		buttons: buttons,
		autoresize: false,
		minHeight: true,
		imageUpload: mt.baseURL+'/redactor/upload'
	});
});
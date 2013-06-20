/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

(function($){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	$("form.form-signin .btn-loading").click(function(){
		var _this = this;
		var _form = $(_this).parents('form');
		$(_this).addClass('loading');
		var options = mainOptions;
		options.success = function(response,status,xhr,jqForm){
			if(response.status){
				mt.redirect(response.redirect);
			}else{
				mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
				$("div.div-form-operation").after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
		setTimeout(function(){$(_form).ajaxSubmit(options);},500);
		return false;
	});
})(window.jQuery);
/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

(function($){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	/*---------------------------- courses ---------------------------------------- */
	$("form.form-signup-admin .btn-submit").click(function(event){
		event.stopPropagation();
		var _form = $("form.form-signup-admin");
		$(this).addClass('loading');
		var options = mainOptions;
		options.success = function(response,status,xhr,jqForm){
			mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
			if(response.status){
				$(_form).resetForm();
				$("div.div-form-operation").after('<div class="msg-alert">'+response.responseText+'</div>');
			}else{
				$("div.div-form-operation").after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
		$(_form).ajaxSubmit(options);
		return false;
	})
	$("form.form-manage-news .btn-submit").click(function(){
		var _form = $("form.form-manage-news");
		$(this).addClass('loading');
		var ckdata = CKEDITOR.instances.content.getData();
		$(_form).find("textarea.redactor").html(ckdata);
		var options = mainOptions;
		options.target = null;
		options.success = function(response,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
			if(response.status){
				$("div.div-form-operation").after('<div class="msg-alert">'+response.responseText+'</div>');
				setTimeout(function(){mt.redirect(response.redirect);},3000);
			}else{
				$("div.div-form-operation").after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
		setTimeout(function(){$(_form).ajaxSubmit(options);},500);
		return false;
	});
	$("form.form-manage-events .btn-submit").click(function(){
		var _form = $("form.form-manage-events");
		$(this).addClass('loading');
		var ckdata = CKEDITOR.instances.content.getData();
		$(_form).find("textarea.redactor").html(ckdata);
		var options = mainOptions;
		options.target = null;
		options.success = function(response,statusText,xhr,jqForm){
			mt.ajaxSuccessSubmit(response,status,xhr,jqForm);
			if(response.status){
				$("div.div-form-operation").after('<div class="msg-alert">'+response.responseText+'</div>');
				setTimeout(function(){mt.redirect(response.redirect);},3000);
			}else{
				$("div.div-form-operation").after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
		setTimeout(function(){$(_form).ajaxSubmit(options);},500);
		return false;
	});

})(window.jQuery);
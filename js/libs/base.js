/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
var mt = mt || {};

//CONFIGURATION
mt.baseURL = window.location.protocol+'//'+window.location.hostname+'/';
mt.currentURL = window.location.href;
mt.languageSegment = 1;
//mt.currentLanguage = mt.getLanguageURL(); // для мультиязычных сайтов если используется в гостевом интерфейсе
mt.currentLanguage = 'ru'; //Установка языка для панели администрирования так как там не используется сегмент указывающий на язык
mt.toltipPlacement = 'right'; // Возможные значения top | bottom | left | right | auto
mt.toltipTrigger = 'manual'; // Возможные значения click | hover | focus | manual
//END CONFIGURATION
mt.getBaseURL = function(url){
	return mt.baseURL+url;
}
mt.getLanguageURL = function(){
	var segments = window.location.pathname.split('/');
	if(segments[mt.languageSegment]){
		return segments[mt.languageSegment];
	}else{
		return 'en';
	}
};
mt.isValidEmailAddress = function(emailAddress){
	var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	if(emailAddress == ''){
		return false;
	}else{
		return pattern.test(emailAddress);
	}
};
mt.isValidPhone = function(phoneNumber){
	var pattern = new RegExp(/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/i);
	if(phoneNumber == ''){
		return false;
	}else{
		return pattern.test(phoneNumber);
	}
};
mt.textLineFilter = function(string){return string.replace(/[&,=]/,' ');}
mt.setJsonRequest = function(request,functionName){$.each(request,function(index,value){$("#"+index)[functionName](value);});}
mt.formSerialize = function(objects){
	var data = '';
	$(objects).each(function(i,element){
		var value = mt.textLineFilter($(element).val());
		$(element).val(value);var name = $(element).attr('name');
		if(data === ''){data = name+"="+value;}else{data = data+"&"+name+"="+value;}});
	return data;
};
mt.matchesParameters = function(parameter1,parameter2){
	var param1 = new String(parameter1);
	var param2 = new String(parameter2);
	if(param1.toString() == param2.toString()){return true;}
	return false;
};
mt.exist_email = function(emailInput){
	var user_email = $(emailInput).val();
	$(emailInput).hideToolTip();
	if(user_email != ''){
		if(!mt.isValidEmailAddress(user_email)){$(emailInput).showToolTip(Localize[mt.currentLanguage]['valid_email']);}
		else{
			$.post(mt.baseURL+"valid/exist-email",{'parametr':user_email},
				function(data){if(!data.status){$(emailInput).showToolTip(Localize[mt.currentLanguage]['exist_email']);}},"json");
		}
	}
};
mt.redirect = function(path){window.location=path;}
mt.deleteResource = function(_this){
	if(confirm(Localize[mt.currentLanguage]['confirm']) == false){
		return false;
	}
	var action = $(_this).parents('ul.resources-items').attr('data-action');
	var resourceID = $(_this).attr('data-resource-id').trim();
	$.ajax({
		url: action,data: {'resourceID':resourceID},type: 'POST',dataType: 'json',
		beforeSend: function(){},
		success: function(data,textStatus,xhr){
			if(data.status){
				$(_this).parents('li').remove();
			}else{
				$(_this).html('&times;');
			}
		},
		error: function(xhr,textStatus,errorThrown){
			$(_this).html('&times;');
		}
	});
}
mt.minLength = function(string,Len){if(string != ''){if(string.length < Len){return false}}return true}
mt.FieldsIsNotNumeric = function(formObject){
	var result = {};var num = 0;
	$(formObject).nextAll("input.digital").each(function(i,element){if(!$.isNumeric($(element).val())){result[num] = $(element).attr('id');num++;}});
	$(formObject).nextAll("input.numeric-float").each(function(i,element){if(!$.isNumeric($(element).val())){result[num] = $(element).attr('id');num++;}});
	if($.isEmptyObject(result)){return false;}else{return result;}
}
mt.noValidEmails = function(elements){
	var user_email = ''; var errors = false;
	$(elements).each(function(i,element){
		user_email = $(element).val().trim();
		if(user_email != '' && !mt.isValidEmailAddress(user_email)){
			$(element).setValidationErrorStatus(Localize[mt.currentLanguage]['valid_email']);
			errors = true;
		}
	});
	return errors;
}
mt.validation = function(jqForm){
	var errors = false;
	$(jqForm).defaultValidationErrorStatus();
	$(jqForm).find(".valid-required").each(function(i,element){
		if($(this).emptyValue()){
			$(this).setValidationErrorStatus(Localize[mt.currentLanguage]['empty_field']);
			errors = true;
		}
	});
	if($(jqForm).find(".valid-email").length > 0){
		if(mt.noValidEmails($(jqForm).find("input.valid-email"))){errors = true;}
	}
	if($(jqForm).find(".valid-phone-number").length == 1){
		var phoneInput = $(jqForm).find("input.valid-phone-number")
		if(!mt.isValidPhone($(phoneInput).val().trim())){
			if($(phoneInput).emptyValue() == false){$(phoneInput).setValidationErrorStatus(Localize[mt.currentLanguage]['valid_phone']);}
			errors = true;
		}
	}
	if($(jqForm).find("input[type='password']").length >= 2){
		var newPassword = $(jqForm).find("input.input-new-password").val();
		var confirmPassword = $(jqForm).find("input.input-confirm-password").val();
		if(!mt.matchesParameters(newPassword,confirmPassword)){
			$("input.input-confirm-password").setValidationErrorStatus(Localize[mt.currentLanguage]['match_pass']);
			errors = true;
		}
		if(!mt.minLength(newPassword,6)){
			$("input.input-new-password").setValidationErrorStatus(Localize[mt.currentLanguage]['pass_length']);
			errors = true;
		}
	}
	if(errors){return false;}else{return true;}
}
mt.setExclamationTabPane = function(tabPane){
	var exam = $("a[href='#"+$(tabPane).attr('id')+"']").find("i");
	if($(exam).hasClass('icon-exclamation-sign') === false){$(exam).addClass('icon-exclamation-sign');}
}
mt.tabValidation = function(jForm){
	var errors = false;
	$("p.valid-messages").addClass('hidden');
	$("i.icon-exclamation-sign").removeClass('icon-exclamation-sign');
	$(jForm).find('div.tab-pane').each(function(i,element){
		$(element).find(".valid-required").each(function(j,e){
			if($(e).val().trim() == ''){
				mt.setExclamationTabPane(element);
				$(e).nextAll('p.valid-messages').removeClass('hidden');
				errors = true;
			}
		});
	});
	if(errors == true){return false;}else{return true;}
}
mt.ajaxBeforeSubmit = function(formData,jqForm,options){
	
	if($("div.msg-alert").exists() == true){
		$("div.msg-alert").remove();
	}
	if($("button.btn-temporary-loading").exists() == true){
		$("button.btn-temporary-loading").remove();
	}
	if(mt.validation(jqForm) == false){
		$("button.btn-loading").removeClass('loading');
		return false;
	}else{
		return true;
	}
}
mt.ajaxSuccessSubmit = function(responseText,statusText,xhr,jqForm){
	$("button.btn-loading").removeClass('loading');
}
$.fn.exists = function(){
	if($(this).length > 0){
		return true;
	}else{
		return false;
	}
}
$.fn.emptyValue = function(){if($(this).val().trim() == ''){return true;}else{return false;}}
$.fn.ForceNumericOnly = function(){
	return this.each(function(){
		$(this).keydown(function(e){
			var key = e.charCode || e.keyCode || 0;
			return(key == 8 || key == 9 || key == 46 || (key >= 37 && key <= 40) || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
		});
	});
};
$.fn.setValidationErrorStatus = function(text){
	$(this).attr('role','tooltip').showToolTip(text);
}
$.fn.defaultValidationErrorStatus = function(){
	$(this).find(":input[role='tooltip']").hideToolTip();
	$(this).find("div.msg-alert").remove();
	$(this).find("input.created-validate-element").remove();
}
$.fn.showToolTip = function(ToolTipText){
	if(ToolTipText == ''){
		ToolTipText = 'Поле не заполнено';
	}
	var config = {placement:mt.toltipPlacement,trigger:mt.toltipTrigger,title:ToolTipText}
	var style = "background: none repeat scroll 0 0 transparent;display: block;height: 2px;opacity: 0;position: absolute;right: 0;top: 32px;width: 2px;";
	return this.each(
		function(){
			if($(this).is(':hidden')){
				$(this).after('<input class="created-validate-element" role="tooltip" type="text" style="'+style+'" />');
				$(this).siblings("input.created-validate-element").tooltip(config).tooltip('show');
			}else{
				$(this).tooltip(config).tooltip('show');
			}
		});
}
$.fn.hideToolTip = function(){
	return this.each(function(i,element){
		if($(element).is(':hidden')){
			$(element).siblings("input.created-validate-element").removeAttr('role').tooltip('destroy').remove();
		}
		if($(element).is("[role='tooltip']") == true){
			$(element).removeAttr('role').tooltip('destroy');
		}
	});
}
$.fn.formSubmitInServer = function(){
	var _form = this;
	var options = {
		target: null,
		dataType:'json',
		type:'post',
		beforeSubmit: mt.ajaxBeforeSubmit,
		success: function(response,status,xhr,jqForm){
			mt.ajaxSuccessSubmit();
			if(response.status == true){
				if(response.mailText != undefined && response.mailText != ''){
					$(jqForm).replaceWith('<div class="msg-alert">'+response.mailText+'</div>');
					if($(".bid-section").length > 0){
						$(".bid-section").fadeOut(300);
					}
				}
				if(response.responseText != ''){
					$("div.div-form-operation").after('<div class="msg-alert">'+response.responseText+'</div>');
				}
				if(response.redirect != false){
					mt.redirect(response.redirect);
				}
			}else{
				$("div.div-form-operation").after('<div class="msg-alert error">'+response.responseText+'</div>');
			}
		}
	}
	setTimeout(function(){$(_form).ajaxSubmit(options);},500);
}
$.fn.ForceBlurEmptyValue = function(){
	return this.each(function(i,element){
		$(element).blur(function(){
			if($(element).emptyValue()){
				$(this).setValidationErrorStatus('Поле не заполнено');
			}
		});
	});
}
$(function(){
	$(".no-clickable").click(function(event){event.preventDefault();event.stopPropagation();});
	$(":input.unique-email").blur(function(){mt.exist_email(this);});
	$("input.valid-numeric").ForceNumericOnly();
	$("input[type='text']").blur(function(){var value = $(this).val().trim();$(this).val(value);});
	$("input.valid-required").ForceBlurEmptyValue();
	$(":input").keydown(function(){$(this).hideToolTip();})
	$(":input").change(function(){$(this).hideToolTip();})
});
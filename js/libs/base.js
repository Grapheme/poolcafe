/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */
 
var mt = mt || {};
mt.baseURL = window.location.protocol+'//'+window.location.hostname+'/';
mt.currentURL = window.location.href;
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
mt.matches_parameters = function(parameter1,parameter2){
	var param1 = new String(parameter1);
	var param2 = new String(parameter2);
	if(param1.toString() == param2.toString()){return true;}
	return false;
};
mt.exist_email = function(emailInput){
	var user_email = $(emailInput).val();
	$(emailInput).hideToolTip();
	if(user_email != ''){
		if(!mt.isValidEmailAddress(user_email)){$(emailInput).showToolTip('Неверный Email');}
		else{
			$.post(mt.baseURL+"valid/exist-email",{'parametr':user_email},
				function(data){if(!data.status){$(emailInput).showToolTip('Email уже существует');}},"json");
		}
	}
};
mt.redirect = function(path){window.location=path;}
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
		if(!mt.isValidEmailAddress(user_email)){
			$(element).setValidationErrorStatus('Неверный Email');
			errors = true;
		}
	});
	return errors;
}
mt.validation = function(jqForm){
	var errors = false;
	$(jqForm).defaultValidationErrorStatus();
	$(jqForm).find(".valid-required").each(function(i,element){
		if($(element).emptyValue()){
			$(element).setValidationErrorStatus('Поле не заполнено');
			errors = true;
		}
	});
	if($(jqForm).find(".valid-email").length > 0){
		if(mt.noValidEmails($(jqForm).find("input.valid-email"))){errors = true;}
	}
	if($(jqForm).find(".valid-phone-number").length == 1){
		var phoneInput = $(jqForm).find("input.valid-phone-number")
		if(!mt.isValidPhone($(phoneInput).val().trim())){
			if($(phoneInput).emptyValue() == false){$(phoneInput).setValidationErrorStatus('Неверный номер телефона');}
			errors = true;
		}
	}
	if($(jqForm).find("input[type='password']").length == 2){
		var user_password = $("#input-password").val();
		var user_confirm_password = $("#input-confirm-password").val();
		if(user_password != ''){
			if(!mt.matches_parameters(user_password,user_confirm_password)){
				$("#input-confirm-password").setValidationErrorStatus('Пароли не совпадают');
				errors = true;
			}
			if(!mt.minLength(user_password,6)){
				$("#input-password").setValidationErrorStatus('Не меньше 6 символов');
				errors = true;
			}
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
mt.lessonValidation = function(tabPane){
	var errors = false;
	$(tabPane).find("p.valid-messages").addClass('hidden');
	$(tabPane).find("span.span-lesson-number").removeClass('badge badge-important');
	$("a[href='#"+$(tabPane).attr('id')+"']").find("i.icon-exclamation-sign").removeClass('icon-exclamation-sign');
	if($("div.new-lesson-unit").length == 0){
		mt.setExclamationTabPane(tabPane);
		$("#addLessonProjectBtn").siblings('p.valid-messages').html('Отсутствуют уроки').removeClass('hidden');
		errors = true;
	}else{
		$(tabPane).find(".valid-required").each(function(j,e){
			if($(e).val().trim() == ''){
				$("div.accordion-heading").find()
				mt.setExclamationTabPane(tabPane);
				$(e).parents('div.new-lesson-unit').find("span.span-lesson-number").addClass('badge badge-important');
				$(e).siblings('p.valid-messages').removeClass('hidden');
				errors = true;
			}
		});
	}
	if(errors == true){return false;}else{return true;}
}
mt.ajaxBeforeSubmit = function(formData,jqForm,options){
	if($("div.msg-alert").exists() == true){
		$("div.msg-alert").remove();
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
mt.deleteResource = function(_this){
	if(confirm('Вы уверены, что хотите удалить?') == false){
		return false;
	}
	var action = $(_this).parents('ul').attr('data-action');
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
		error: function(xhr,textStatus,errorThrown){$(_this).html('&times;');}
	});
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
}
$.fn.showToolTip = function(ToolTipText){
	if(ToolTipText == ''){
		ToolTipText = 'Поле не заполнено';
	}
	var config = {placement:'right',trigger:'hover',title:ToolTipText}
	return this.each(
		function(){
			$(this).tooltip(config).tooltip('show');
		});
}
$.fn.hideToolTip = function(){
	return this.each(
		function(){
			if($(this).is("[role='tooltip']") == true){
				$(this).removeAttr('role').tooltip('destroy');
			}
	});
}
$(function(){
	$(".no-clickable").click(function(event){event.preventDefault();});
	$(":input.unique-email").blur(function(){mt.exist_email(this);});
	$("input.valid-numeric").ForceNumericOnly();
	$("input[type='text']").blur(function(){var value = $(this).val().trim();$(this).val(value);});
	$(":input").keydown(function(){$(this).hideToolTip();})
	$(":input").change(function(){$(this).hideToolTip();})
});
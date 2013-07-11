/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

(function($){
	var mainOptions = {target: null,beforeSubmit: mt.ajaxBeforeSubmit,success: mt.ajaxSuccessSubmit,dataType:'json',type:'post'};
	/*-------------------------------------------------------------------- */
	$(".confirm-user").click(function(event){
		if(!confirmUser()){
			event.stopPropagation();
			event.preventDefault();
		}
	})
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
		var redactorData = $("textarea.redactor").redactor('get');
		$(_form).find("textarea.redactor").html(redactorData);
		setTimeout(function(){$(_form).ajaxSubmit(uploadImage.singlePhotoOption);},500);
		return false;
	});
	$("form.form-manage-events .btn-submit").click(function(){
		var _form = $("form.form-manage-events");
		$(this).addClass('loading');
		var redactorData = $("textarea.redactor").redactor('get');
		$(_form).find("textarea.redactor").html(redactorData);
		setTimeout(function(){$(_form).ajaxSubmit(uploadImage.singlePhotoOption);},500);
		return false;
	});
	$("button.edit-group-menu").click(function(){wrapTitle(this);});
	$("button.edit-category-menu").click(function(){wrapTitle(this);});
	$("button.save-category-menu").click(function(){
		if($(this).siblings('input.input-title').emptyValue() == false){
			createTitle(this);
		}else{
			$(this).siblings('input.input-title').focus();
		}
	});
	$("button.remove-category-menu").click(function(){
		if(confirmUser()){
			deleteTitle(this);
		}
	})
	$("span.view-subcategory").click(function(){
		showSubCategory(this);
	});
	$("select.select-group").change(function(){
		var url = mt.currentURL.replace(/group=(\d+)/,'group='+$(this).val());
		mt.redirect(url);
	});
	$("select.select-parents-categories").change(function(){
		var url = mt.currentURL.replace(/(&category=(\d+)|&subcategory=(\d+))/g,'');
		if($(this).emptyValue() == false){
			url = url+'&category='+$(this).val();
		}
		mt.redirect(url);
	});
	$("select.select-subcategories").change(function(){
		var url = mt.currentURL.replace(/&subcategory=(\d+)/,'');
		if($(this).emptyValue() == false){
			url = url+'&subcategory='+$(this).val();
		}
		mt.redirect(url);
	});
	$("form.form-manage-menu .btn-submit").click(function(){
		var _form = $("form.form-manage-menu");
		$(this).addClass('loading');
		setTimeout(function(){$(_form).ajaxSubmit(uploadImage.singlePhotoOption);},500);
		return false;
	});
	$("button.remove-product-menu").click(function(){
		if(confirmUser()){
			var _this = this;
			var itemID = $(this).attr('data-item');
			var action = $(this).parents('table').attr('data-action');
			$.ajax({
				url: action,type: 'POST',dataType: 'json',data:{'id':itemID},
				beforeSend: function(){
					$("div.result-request").html('');
				},
				success: function(response,textStatus,xhr){
					if(response.status){
						$(_this).parents('tr').remove();
					}else{
						$("div.result-request").html(response.responseText);
					}
				},
				error: function(xhr,textStatus,errorThrown){}
			});
		}
	});
	$("button.btn-content-submit").click(function(){
		var _this = this;
		var itemID = $(this).attr('data-id');
		var text = $('textarea[data-id="'+itemID+'"]').val().trim();
		$.ajax({
			url: mt.baseURL+'save-page-content',type: 'POST',dataType: 'json',data:{'id':itemID,'text':text},
			beforeSend: function(){
				$(_this).addClass('loading');
			},
			success: function(response,textStatus,xhr){
				$(_this).removeClass('loading');
				if(response.status){
					$(_this).html('Сохранено').addClass('btn-success');
				}
			},
			error: function(xhr,textStatus,errorThrown){
				$(_this).removeClass('loading');
			}
		});
	});
	$("select.select-resources-part").change(function(){
		var part = $(this).val();
		var action = $("div.div-form-action").attr('data-action');
		action = getClearURL(action)+'?id='+part;
		$("div.div-form-action").attr('data-action',action);
	})
	function showSubCategory(element){
		$(element).siblings('ul.ul-children').toggleClass('hidden');
	}
	function wrapTitle(element){
		var title = $(element).siblings('span.title').text().trim();
		$(element).siblings('button.remove-category-menu').addClass('hidden');
		$(element).addClass('hidden').siblings('span.title').addClass('hidden')
			.after('<input type="text" class="input-title" name="category" placeholder="Текст группы" value="" />'+
					'<button class="btn btn-link save-menu btn-loading" data-parent="0"><i class="icon-ok-sign"></i></button>');
		$(element).siblings('input.input-title').val(title);
		$(element).siblings('button.save-menu').on('click',function(){
			if($(this).siblings('input.input-title').emptyValue() == false){
				saveTitle(element);
			}else{
				$(this).siblings('input.input-title').focus();
			}
		});
	}
	function unwrapTitle(element){
		var title = $(element).siblings('input.input-title').val().trim();
		$(element).siblings('input.input-title').remove();
		$(element).siblings('button.save-menu').off('click').remove();
		$(element).removeClass('hidden').siblings('span.title').removeClass('hidden').html(title);
		$(element).siblings('button.remove-category-menu').removeClass('hidden');
	}
	function saveTitle(element){
		var title = $(element).siblings('input.input-title').val().trim();
		var itemID = $(element).parents('li').attr('data-item');
		var action = $(element).parents('ul.ul-parent').attr('data-action')+'?mode=update';
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'id':itemID,'title':title},
			beforeSend: function(){
				$("div.result-request").html('');
			},
			success: function(data,textStatus,xhr){
				if(data.status){
					unwrapTitle(element);
				}else{
					$("div.result-request").html(data.responseText);
				}
				return data.status;
			},
			error: function(xhr,textStatus,errorThrown){}
		});
	}
	function createTitle(element){
		var title = $(element).siblings('input.input-title').val().trim();
		var action = $(element).parents('ul.ul-parent').attr('data-action')+'?mode=insert';
		var parentID = $(element).parents('ul').attr('data-parent');
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'title':title,'parent':parentID},
			beforeSend: function(){
				$("div.result-request").html('');
			},
			success: function(response,textStatus,xhr){
				if(response.status){
					$(element).siblings('input.input-title').val('');
					if(parentID == 0){
						$("ul.ul-parent li:last").before(response.responseText);
						$("ul.ul-parent").find("button.edit-category-menu:last").on('click',function(){wrapTitle(this);});
						$("ul.ul-parent").find("button.remove-category-menu:last").on('click',function(){
							if(confirmUser()){deleteTitle(this);}
						});
						$("span.view-subcategory:last").on('click',function(){showSubCategory(this);});
						$("ul.ul-children:last").find('button.save-category-menu:last').on('click',function(){
							if($(this).siblings('input.input-title').emptyValue() == false){
								createTitle(this);
							}else{
								$(this).siblings('input.input-title').focus();
							}
						});
					}else{
						$("ul.ul-children[data-parent="+parentID+"] li:last").before(response.responseText);
						$("ul.ul-children:last").find('button.edit-category-menu:last').on('click',function(){wrapTitle(this);});
						$("ul.ul-children:last").find('button.remove-category-menu:last').on('click',function(){deleteTitle(this);});
					}
				}else{
					$("div.result-request").html(response.responseText);
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		});
	}
	function deleteTitle(element){
		var itemID = $(element).parents('li').attr('data-item');
		var action = $(element).parents('ul.ul-parent').attr('data-action')+'?mode=remove';
		$.ajax({
			url: action,type: 'POST',dataType: 'json',data:{'id':itemID},
			beforeSend: function(){
				$("div.result-request").html('');
			},
			success: function(response,textStatus,xhr){
				if(response.status){
					$(element).parents('li[data-item='+itemID+']').remove();
				}else{
					$("div.result-request").html(response.responseText);
				}
			},
			error: function(xhr,textStatus,errorThrown){}
		});
	}
	function confirmUser(){
		return confirm('Вы действительно хотите удалить');
	}
	
	function getClearURL(action){
		return action.replace(/\?id=(\d*)/,'');
	}
})(window.jQuery);
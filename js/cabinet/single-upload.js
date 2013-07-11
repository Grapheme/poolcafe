/* Author: Grapheme Group
 * http://grapheme.ru/
 */

(function($){
	function updateSingleImage(_this,url,usrInput){
		if($(usrInput).emptyValue()){return false;}
		var bar = $("div.bar");
		var status = $("#upload-photo-status");
		bar.parents('div.progress').removeClass('progress-success progress-danger active').addClass('progress-info active');
		$(_this).parents("form").ajaxSubmit({
			url: mt.baseURL+url,
			dataType: 'json',
			type: 'post',
			beforeSubmit: function(){
				status.empty();
				var percentVal = '0%';
				bar.width(percentVal);
				bar.html(percentVal);
				$(_this).addClass('disabled').tooltip('hide').attr('disabled','disabled');
				$("#div-upload-photo").removeClass('hidden');
			},
			uploadProgress: function(event,position,total,percentComplete){
				var percentVal = percentComplete + '%';
				bar.width(percentVal);
				bar.html(percentVal);
				status.html('Загрузка...');
			},
			success: function(data){
				var percentVal = '100%';
				bar.width(percentVal);
				bar.html(percentVal);
				status.html(data.responseText);
				$(usrInput).clearFields();
				$(_this).removeClass('disabled').tooltip('hide').removeAttr('disabled').addClass('hidden');
				if(data.status){
					bar.parents('div.progress').removeClass('progress-info active').addClass('progress-success');
					$("img.destination-photo").attr('src',data.responsePhotoSrc);
				}else{
					bar.parents('div.progress').removeClass('progress-info active').addClass('progress-danger');
				}
			}
		});
	}
	$("#upload-page-photo").click(function(event){
		event.preventDefault();
		updateSingleImage(this,"page-resources/upload/single-resource?id="+$(this).attr('data-part'),$("#input-page-photo"));
	});
	$("input.input-select-photo").change(function(){
		$("button.btn-upload").removeClass('hidden');
		$("button.btn-upload").tooltip('show');
		$("div.bar-file-upload").addClass('hidden');
	});
})(window.jQuery);
/*  Author: Grapheme Group
 *  http://grapheme.ru/
 */

var uploadDataObject = uploadDataObject || {};
uploadDataObject.interval = {};
uploadDataObject.TotalSize = 0;
uploadDataObject.CurrentSize = {};
uploadDataObject.FilesSize = {};
uploadDataObject.maxFileSize = 5000000;
uploadDataObject.DropZoneDefaultState = function(){
	$("div.div-zone-upload-file").addClass('hidden');
	$("a.a-zone-upload-resources").removeClass('hidden');
}
var dropZone = document.getElementById("dropZone");
var tests = {filereader: typeof FileReader != 'undefined',dnd: 'draggable' in document.createElement('span'),formdata: !!window.FormData,progress: "upload" in new XMLHttpRequest};
var support = {filereader: document.getElementById('filereader'),formdata: document.getElementById('formdata'),progress: document.getElementById('progress')};
var acceptedTypes = {'image/png': true,'image/jpeg': true,'image/gif': true};
var progress = document.getElementById('uploadprogress');
var fileupload = document.getElementById('upload');

"filereader formdata progress".split(' ').forEach(function(api){
	if(tests[api] === false){
		support[api].className = 'fail';
	}else{
		support[api].className = 'hidden';
	}
});

function ReadFiles(files){
	var formData = tests.formdata ? new FormData() : null;
	if(tests.formdata){
		for(var i=0;i<files.length;i++){
			fileIndex = files[i].name.replace(/([ ])/,'_');
			uploadDataObject.CurrentSize[fileIndex] = 0;
			uploadDataObject.FilesSize[fileIndex] = files[i].size;
		}
		for(var i=0;i<files.length;i++){
			if(files[i].size <= uploadDataObject.maxFileSize && acceptedTypes[files[i].type] === true){
				if(tests.formdata) formData.append('file',files[i]);
				UploadFile(formData,files[i]);
			}
		}
	}
}
function UploadFile(formData,file){
	var action = $(dropZone).parents("div.div-form-action").attr('data-action');
	var xhr = new XMLHttpRequest();
	xhr.open('POST',action);
	xhr.fileInfo = file;
	if(tests.progress){
		xhr.upload.onprogress = function(event){
			if(event.lengthComputable){
				var fileIndex = xhr.fileInfo.name.replace(/([ ])/,'_');
				uploadDataObject.CurrentSize[fileIndex] = event.loaded;
				if(uploadDataObject.CurrentSize[fileIndex] > uploadDataObject.FilesSize[fileIndex]){
					uploadDataObject.CurrentSize[fileIndex] = uploadDataObject.FilesSize[fileIndex];
				}
			}
		};
	}
	xhr.onload = function(event){
		if(event.target.readyState == 4){
			if(event.target.status == 200){
				var response = $.parseJSON(event.target.responseText);
				if(response.status == true){
					var part = $("select.select-resources-part").val();
					$('<li class="span2"></li>').appendTo("ul.resources-items-id"+part).html(response.responsePhotoSrc);
					$("ul.resources-items-id"+part).find("a.delete-resource-item:last").off('click').on("click",function(event){
						event.preventDefault();
						mt.deleteResource(this);
					});
					var fileIndex = xhr.fileInfo.name.replace(/([ ])/,'_');
					uploadDataObject.CurrentSize[fileIndex] = xhr.fileInfo.size;
					progress.value = progress.innerHTML = 100;
				}
			}else{
				progress.className = "hidden";
				progress.innerHTML = 0;
				dropZone.innerHTML = 'Произошла ошибка!';
				dropZone.className ='failUpload';
			}
		}
	};
	xhr.setRequestHeader('X-FILE-NAME',xhr.fileInfo.name);
	xhr.send(formData);
}
function getTotalSize(files){
	var total = 0;
	for(var i=0,f;f=files[i];i++){
		if(f.size <= uploadDataObject.maxFileSize && acceptedTypes[f.type] === true){
			total += f.size;
		}
	}
	return total;
}
function uploadProgress(){
	var loaded = 0;
	$.each(uploadDataObject.CurrentSize,function(i,val){
		loaded += val;
	});
	if(loaded == uploadDataObject.TotalSize){
		clearInterval(uploadDataObject.interval);
		setTimeout(function(){
			progress.className = "hidden";
			progress.innerHTML = 0;
			dropZone.className = '';
			dropZone.innerHTML = 'Для загрузки, перетащите файл сюда';
		},1000);
	}else{
		var percent = parseInt((loaded/uploadDataObject.TotalSize)*100|0);
		progress.value = progress.innerHTML = percent;
	}
}
if(tests.dnd){
	dropZone.ondragover = function(){this.className = 'hover'; return false;};
	dropZone.ondragleave = function (){this.className = ''; return false;};
	dropZone.ondrop = function(event){
		event.stopPropagation();
		event.preventDefault();
		this.className = 'hidden';
		progress.className = "";
		progress.innerHTML = 0;
		uploadDataObject.interval = setInterval(uploadProgress,100);
		var files = event.target.files || event.dataTransfer.files;
		uploadDataObject.TotalSize = getTotalSize(files);
		uploadDataObject.CurrentSize = {};
		ReadFiles(files);
	}
}else{
	fileupload.className = 'hidden';
	fileupload.querySelector('input').onchange = function(){
		ReadFiles(this.files);
	};
}
$(function(){
	$("a.a-zone-upload-resources").click(function(){
		$(this).addClass('hidden');
		$("div.div-zone-upload-file").removeClass('hidden');
	})
	$("a.delete-resource-item").click(function(){
		mt.deleteResource(this);
	});
});
<a href="" class="btn no-clickable a-zone-upload-resources">Загрузить файлы</a>
<div class="hidden div-zone-upload-file">
	<p class="upload-resource-status"></p>
	<div data-action="<?=$action;?>" class="div-form-action">
		<div id="dropZone">
			<p class="dropZoneText">Для загрузки, перетащите файл сюда.</p>
		</div>
		<p id="upload" class="hidden"><label>Drag &amp; drop not supported, but you can still upload via this input field:<br><input type="file"></label></p>
	</div>
	<p id="filereader">File API &amp; FileReader API not supported</p>
	<p id="formdata">XHR2's FormData is not supported</p>
	<p id="progress">XHR2's upload progress isn't supported</p>
	<p><progress class="hidden" id="uploadprogress" min="0" max="100" value="0">0</progress></p>
</div>
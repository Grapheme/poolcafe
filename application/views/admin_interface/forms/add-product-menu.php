<h2>Добавление товара в меню</h2>
<?=form_open(ADMIN_START_PAGE.'/menu/insert'.getUrlLink(),array('class'=>'form-manage-menu')); ?>
	<div class="control-group">
		<input type="text" name="title" class="span3 valid-required" value="" placeholder="Название" />
		<input type="text" name="property" class="span3 valid-required" value="" placeholder="Вес, объем, размер" />
		<input type="text" name="price" class="span2 valid-required" value="" placeholder="Цена" />
	</div>
	<div class="controls">
		<input type="file" class="" autocomplete="off" name="photo" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
	</div>
	<div class="control-group">
		<textarea rows="2" class="span9" placeholder="Описание" name="description"></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-img-submit no-clickable btn-loading">Создать товар</button>
	</div>
<?= form_close(); ?>

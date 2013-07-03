<h2>Добавление новости</h2>
<?=form_open(ADMIN_START_PAGE.'/news/insert',array('class'=>'form-manage-news')); ?>
	<div class="control-group">
		<input type="text" name="title" class="span7 valid-required" value="" placeholder="Название" />
		<input type="text" class="input-small datepicker" name="date" autocomplete="off" placeholder="Введите дату" readonly="readonly" value="<?=date("d.m.Y");?>">
	</div>
	<div class="controls">
		<input type="file" class="valid-required" autocomplete="off" name="photo" size="52">
		<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
		<div id="div-upload-photo" class="bar-file-upload hidden">
			<div class="progress progress-info progress-striped active">
				<div class="bar" style="width: 0%"></div>
			</div>
		</div>
	</div>
	<div class="control-group">
		<textarea rows="3" class="span9 valid-required" placeholder="Анонс новости" name="anonce"></textarea>
	</div>
	<div class="control-group">
		<input type="text" class="span7 valid-required" name="photo_report" autocomplete="off" placeholder="Подробный фотоотчет" value="">
	</div>
	<div class="control-group clearfix">
		<textarea rows="10" class="valid-required redactor" placeholder="Текс новости" name="content"></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Создать новость</button>
	</div>
<?= form_close(); ?>

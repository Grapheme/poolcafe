<h2>Редактирование новости</h2>
<?=form_open(ADMIN_START_PAGE.'/news/update/'.$news['id'],array('class'=>'form-manage-news')); ?>
	<div class="control-group">
		<input type="text" name="title" class="span7 valid-required" value="<?=$news['title'];?>" placeholder="Название" />
		<input type="text" class="input-small datepicker" name="date" autocomplete="off" placeholder="Введите дату" readonly="readonly" value="<?=$news['date_publish'];?>">
	</div>
	<div class="controls">
		<img class="destination-photo img-polaroid" src="<?=site_url('loadimage/news/'.$news['id']);?>" />
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
		<textarea rows="3" class="span9 valid-required" placeholder="Анонс новости" name="anonce"><?=$news['anonce'];?></textarea>
	</div>
	<div class="control-group">
		<textarea rows="10" class="span9 valid-required redactor" placeholder="Текс новости" name="content"><?=$news['content'];?></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить новость</button>
	</div>
<?= form_close(); ?>
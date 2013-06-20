<h2>Редактирование события</h2>
<?=form_open(ADMIN_START_PAGE.'/events/update/'.$event['id'],array('class'=>'form-manage-events')); ?>
	<div class="control-group">
		<label for="category" class="control-label">Категория: </label>
		<select class="" name="category">
			<option value="0" <?=($event['category'] == 0)?'selected="selected"':'';?>>Концерт</option>
			<option value="1" <?=($event['category'] == 1)?'selected="selected"':'';?>>Выставка</option>
			<option value="2" <?=($event['category'] == 2)?'selected="selected"':'';?>>Другое</option>
		</select>
	</div>
	<div class="control-group">
		<input type="text" name="title" class="span7 valid-required" value="<?=$event['title'];?>" placeholder="Название" />
		<label for="photo" class="control-label">Дата и время проведения: </label>
		<div class="control-group">
			<input type="text" class="span2 datepicker" name="date" value="<?=swap_dot_date($event['date_publish']);?>">
			<input type="text" class="span3" name="time" placeholder="Введите время начала" value="">
		</div>
	</div>
	<div class="controls">
		<img class="destination-photo img-polaroid" src="<?=site_url('loadimage/events/'.$event['id']);?>" />
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
		<input type="text" name="tags" class="span7" value="<?=$event['tags'];?>" placeholder="Теги" />
	</div>
	<div class="control-group">
		<input type="text" name="age" class="span2 valid-required" value="<?=$event['age'];?>" placeholder="Возраст" />
		<input type="text" name="price" class="span2" value="<?=$event['price'];?>" placeholder="Цена" />
	</div>
	<div class="control-group">
		<textarea rows="3" class="span9 valid-required" placeholder="Анонс собыьтия" name="anonce"><?=$event['anonce'];?></textarea>
	</div>
	<div class="control-group clearfix">
		<textarea rows="10" class="valid-required redactor" placeholder="Текс события" name="content"><?=$event['content'];?></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить событие</button>
	</div>
<?= form_close(); ?>

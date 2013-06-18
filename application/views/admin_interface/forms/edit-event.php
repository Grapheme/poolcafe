<h2>Редактирование события</h2>
<?=form_open(ADMIN_START_PAGE.'/events/update/'.$event['id'],array('class'=>'form-manage-events')); ?>
	<div class="control-group">
		<label for="category" class="control-label">Категория: </label>
		<select class="" name="category">
			<option value="1" <?=($event['category'] == 1)?'selected="selected"':'';?>>Концерт</option>
			<option value="2" <?=($event['category'] == 2)?'selected="selected"':'';?>>Выставка</option>
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
	<div class="control-group">
		<textarea rows="10" class="span9 valid-required redactor" placeholder="Текс события" name="content"><?=$event['content'];?></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить событие</button>
	</div>
<?= form_close(); ?>

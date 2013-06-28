<h2>Добавление события</h2>
<?=form_open(ADMIN_START_PAGE.'/events/insert',array('class'=>'form-manage-events')); ?>
	<div class="control-group">
		<label for="category" class="control-label">Категория: </label>
		<select class="" name="category">
			<option value="1">Концерт</option>
			<option value="2">Выставка</option>
		</select>
	</div>
	<div class="control-group">
		<input type="text" name="title" class="span7 valid-required" value="" placeholder="Название" />
		<label for="photo" class="control-label">Дата и время проведения: </label>
		<div class="control-group">
			<input type="text" class="span2 datepicker" name="date" value="<?=date("d.m.Y")?>">
			<input type="text" class="span3" name="time" placeholder="Введите время начала" value="">
		</div>
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
		<input type="text" name="tags" class="span7" value="" placeholder="Теги" />
	</div>
	<div class="control-group">
		<input type="text" name="age" class="span2 valid-required" value="+18" placeholder="Возраст" />
		<input type="text" name="price" class="span2" value="" placeholder="Цена" />
	</div>
	<div class="control-group">
		<textarea rows="3" class="span9 valid-required" placeholder="Анонс события" name="anonce"></textarea>
	</div>
	<div class="control-group clearfix">
		<textarea rows="10" class="valid-required redactor" placeholder="Текс события" name="content"></textarea>
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Создать событие</button>
	</div>
<?= form_close(); ?>

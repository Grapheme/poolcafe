<?=form_open(ADMIN_START_PAGE.'/category/menu/insert'.getUrlLink(),array('class'=>'form-manage-category-menu')); ?>
	<div class="control-group">
		<label>Название</label>
		<input type="text" name="title" class="span3 valid-required" value="" placeholder="Название" />
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="" placeholder="№" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Добавить</button>
	</div>
<?= form_close(); ?>
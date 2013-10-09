<?=form_open(ADMIN_START_PAGE.'/category/group/update'.getUrlLink(),array('class'=>'form-manage-category-group')); ?>
	<div class="control-group">
		<label>Название</label>
		<input type="text" name="title" class="span3 valid-required" value="<?=$group['title'];?>" placeholder="Название" />
		<label>Порядковый номер</label>
		<input type="text" name="number" class="span1 valid-numeric" value="<?=$group['number'];?>" placeholder="№" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?= form_close(); ?>
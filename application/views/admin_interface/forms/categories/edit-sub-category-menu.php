<?=form_open(ADMIN_START_PAGE.'/category/menu/update'.getUrlLink(),array('class'=>'form-manage-category-menu')); ?>
	<div class="control-group">
		<label>Категории меню</label>
		<select autocomplete="off" class="span4" name="parent">
		<?php for($i=0;$i<count($categories);$i++):?>
			<option value="<?=$categories[$i]['id'];?>" <?=($category['parent'] == $categories[$i]['id'])?'selected="selected"':'';?>><?=$categories[$i]['title'];?></option>
		<?php endfor;?>
		</select>
		<label>Название</label>
		<input type="text" name="title" class="span3 valid-required" value="<?=$category['title'];?>" placeholder="Название" />
		<label>Порядковый номер</label>
		<input type="text" name="sort" class="span1 valid-numeric" value="<?=$category['sort'];?>" placeholder="№" />
	</div>
	<div class="div-form-operation">
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить</button>
	</div>
<?= form_close(); ?>
<?=form_open(ADMIN_START_PAGE.'/category/menu/update'.getUrlLink(),array('class'=>'form-manage-category-menu')); ?>
	<div class="control-group">
		<label>Группа меню</label>
		<select autocomplete="off" name="group">
		<?php for($i=0;$i<count($group);$i++):?>
			<option value="<?=$group[$i]['id'];?>" <?=($category['group'] == $group[$i]['id'])?'selected="selected"':'';?>><?=$group[$i]['title'];?></option>
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
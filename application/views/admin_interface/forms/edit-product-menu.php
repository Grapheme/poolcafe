<h2>Редактирование товара в меню</h2>
<?=form_open(ADMIN_START_PAGE.'/menu/update'.getUrlLink(),array('class'=>'form-manage-menu')); ?>
	<div class="control-group">
		<input type="text" name="title" class="span3 valid-required" value="<?=$menu['title'];?>" placeholder="Название" />
		<input type="text" name="property" class="span3 valid-required" value="<?=$menu['property'];?>" placeholder="Вес, объем, размер" />
		<input type="text" name="price" class="span2 valid-required" value="<?=$menu['price'];?>" placeholder="Цена" />
	</div>
	<div class="controls">
		<img class="destination-photo img-polaroid" src="<?=site_url('loadimage/menu/'.$menu['id']);?>" />
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
		<textarea rows="2" class="span9" placeholder="Описание" name="description"><?=$menu['description'];?></textarea>
	</div>
	<div class="div-form-operation">
	<?php if($this->input->get('category') !== FALSE && $this->input->get('product') !== FALSE):?>
		<button type="submit" value="" name="submit" class="btn btn-submit no-clickable btn-loading">Сохранить товар</button>
	<?php else:?>
		<span class="label label-important">Выбирите категорию</span>
	<?php endif;?>
	</div>
<?= form_close(); ?>

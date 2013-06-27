<div class="inline">
	<select autocomplete="off" class="select-group" name="group">
	<?php for($i=0;$i<count($group);$i++):?>
		<option value="<?=$group[$i]['id'];?>" <?=($this->input->get('group') == $group[$i]['id'])?'selected="selected"':'';?>><?=$group[$i]['title'];?></option>
	<?php endfor;?>
	</select>
	<select autocomplete="off" class="select-parents-categories" name="parents">
		<option value="">Выберите категорию</option>
	<?php foreach($categories as $key => $value):?>
		<?php if($value['parent'] == 0):?>
		<option value="<?=$key;?>" <?=($this->input->get('category') == $key)?'selected="selected"':'';?>><?=$value['title'];?></option>
		<?php endif;?>
	<?php endforeach;?>
	</select>
<?php if($this->input->get('category') !== FALSE && isset($categories[$this->input->get('category')]['children'])):?>
	<select autocomplete="off" class="select-subcategories" name="parents">
		<option value="">Без подкатегории</option>
	<?php for($i=0;$i<count($categories[$this->input->get('category')]['children']);$i++):?>
		<?php if($categories[$this->input->get('category')]['children'][$i]['parent'] == $this->input->get('category')):?>
		<option value="<?=$categories[$this->input->get('category')]['children'][$i]['id'];?>" <?=($this->input->get('subcategory') == $categories[$this->input->get('category')]['children'][$i]['id'])?'selected="selected"':'';?>><?=$categories[$this->input->get('category')]['children'][$i]['title'];?></option>
		<?php endif;?>
	<?php endfor;?>
	</select>
<?php endif;?>
</div>
<div class="inline">
	<select autocomplete="off" class="single-select-group" name="group">
	<option value="">Группа не указана</option>
	<?php for($i=0;$i<count($group);$i++):?>
		<option value="<?=$group[$i]['id'];?>" <?=($this->input->get('group') == $group[$i]['id'])?'selected="selected"':'';?>><?=$group[$i]['title'];?></option>
	<?php endfor;?>
	</select>
</div>
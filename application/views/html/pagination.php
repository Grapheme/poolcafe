<?php if($pages > 1):
	$first = FALSE; $last = FALSE;
	if($page == 1):
		$first = TRUE;
		$from = 0;
	endif;
	if($page == $pages):
		$last = TRUE;
	endif;
	$start = 1; $stop = $pages;
	if($page >= 4):
		$start = $page - 3;
	endif;
	if($pages > ($page+3)):
		$stop = $page+3;
	endif;?>
<div class="pagination">
	<ul>
		<li class="<?=($first)?'inactive':'active';?>" data-page="1">В начало</li>
		<li class="<?=($first)?'inactive':'active';?>" data-page="<?=(($page-1)==0)?1:$page-1;?>">Пред.</li>
	<?php for($i=$start;$i<=$stop;$i++):?>
		<li class="<?=($i==$page)?'curpage':'active';?>" data-page="<?=$i?>"><?=$i?></li>
	<?php endfor;?>
		<li class="<?=($last)?'inactive':'active';?>" data-page="<?=$page+1;?>">След.</li>
		<li class="<?=($last)?'inactive':'active';?>" data-page="<?=$pages;?>">В конец</li>
	</ul>
</div>
<?php endif; ?>
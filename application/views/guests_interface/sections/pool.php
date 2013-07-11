<section id="pool" class="slider" data-12000="top:0%;" data-13400="top:-100%;" style="z-index:9994;" data-menu="light" data-offset="3867.5625">
	<header>
		<h2>
			<span><?=$contents[11]['content'];?></span>
		</h2>
	</header>
	<div class="__fotorama">
	<?php for($i=0;$i<count($resources3);$i++):?>
		<img src="<?=base_url($resources3[$i]['resource']);?>" alt="St.Tropez" />
	<?php endfor;?>
	</div>
</section>
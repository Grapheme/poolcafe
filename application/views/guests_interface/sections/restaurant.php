<section id="restaurant" class="slider" data-6400="top:0%;" data-7600="top:-100%;" style="z-index:9996;" data-menu="light"  data-offset="6648.78125">
	<header>
		<h2>
			<span><?=$contents[1]['content'];?></span>
		</h2>
	</header>
	<div class="__fotorama">
	<?php for($i=0;$i<count($resources2);$i++):?>
		<img src="<?=base_url($resources2[$i]['resource']);?>" alt="St.Tropez" />
	<?php endfor;?>
	</div>
</section>
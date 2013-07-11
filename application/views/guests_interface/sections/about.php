<section id="about" class="slider" data-0="top:0%;" data-2000="top:-100%;" style="z-index:9998;" data-menu="light" >
	<header>
		<h2>
			<span><?=$contents[0]['content'];?></span>
		</h2>
	</header>
	<div class="__fotorama">
	<?php for($i=0;$i<count($resources1);$i++):?>
		<img src="<?=base_url($resources1[$i]['resource']);?>" alt="St.Tropez" />
	<?php endfor;?>
	</div>
</section>
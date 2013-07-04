<?php if($this->uri->segment(1) == 'aquarium'):?>
<div class="menu-nav">
<?php else:?>
<div class="menu-navigation">
<?php endif;?>
	<ul class="menu-nav-list">
		<li class="menu-nav-list-item item1">
			<a <?=($this->uri->segment(1) == 'menu')?'class="current-link"':'';?> href="<?=site_url('menu');?>"> <div></div> <span><?=$nav_menu[0]['title']?></span> </a>
		</li>
		<li class="menu-nav-list-item item2">
			<a <?=($this->uri->segment(1) == 'wine-card')?'class="current-link"':'';?> href="<?=site_url('wine-card');?>"> <div></div> <span><?=$nav_menu[1]['title']?></span> </a>
		</li>
		<li class="menu-nav-list-item item4">
			<a <?=($this->uri->segment(1) == 'aquarium')?'class="current-link"':'';?> href="<?=site_url('aquarium');?>"> <div></div> <span><?=$nav_menu[2]['title']?></span> </a>
		</li>
	</ul>
</div>
<div class="clear"></div>
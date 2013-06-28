<?php if($this->uri->segment(1) == 'aquarium'):?>
<div class="menu-nav">
<?php else:?>
<div class="menu-navigation">
<?php endif;?>
	<ul class="menu-nav-list">
		<li class="menu-nav-list-item item1">
			<a <?=($this->uri->segment(1) == 'menu')?'class="current-link"':'';?> href="<?=site_url('menu');?>"> <div></div> <span>Меню</span> </a>
		</li>
		<li class="menu-nav-list-item item2">
			<a <?=($this->uri->segment(1) == 'wine-card')?'class="current-link"':'';?> href="<?=site_url('wine-card');?>"> <div></div> <span>Винная карта</span> </a>
		</li>
		<li class="menu-nav-list-item item4">
			<a <?=($this->uri->segment(1) == 'aquarium')?'class="current-link"':'';?> href="<?=site_url('aquarium');?>"> <div></div> <span>Аквариум</span> </a>
		</li>
	</ul>
</div>
<div class="clear"></div>
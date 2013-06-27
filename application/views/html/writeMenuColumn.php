<?php for($parents=$start;$parents<$stop;$parents++):?>
	<div class="category-table">
	<?php $writeMenu = FALSE;?>
	<?php if(isset($menu[$parents]['products'])):?>
		<?php $writeMenu = TRUE;?>
	<?php elseif(isset($menu[$parents]['children'])):?>
		<?php for($children=0;$children<count($menu[$parents]['children']);$children++):?>
			<?php if(isset($menu[$parents]['children'][$children]['products'])):?>
				<?php $writeMenu = TRUE;?>
			<?php endif;?>
		<?php endfor;?>
	<?php endif;?>
	<?php if($writeMenu):?>
		<h3 class="category-header"><?=$menu[$parents]['title'];?></h3>
		<div class="category-elem">
	<?php if(isset($menu[$parents]['products'])):?>
		<?php for($m=0;$m<count($menu[$parents]['products']);$m++):?>
			<ul class="category-elem-body">
				<li class="category-elem-item">
					<div class="category-elem-name">
						<?=$menu[$parents]['products'][$m]['title'];?>
					</div>
					<div class="category-elem-weight">
						<?=getMenuProperty($menu[$parents]['products'][$m]['property']);?>
					</div>
					<div class="category-elem-price">
						<?=$menu[$parents]['products'][$m]['price'];?>р
					</div>
					<div class="clear"></div>
				</li>
			</ul>
		<?php endfor;?>
	<?php endif;?>
	<?php if(isset($menu[$parents]['children'])):?>
		<?php for($children=0;$children<count($menu[$parents]['children']);$children++):?>
			<?php if(isset($menu[$parents]['children'][$children]['products'])):?>
			<div class="category-elem-header">
				<h4><?=$menu[$parents]['children'][$children]['title'];?></h4>
			</div>
			<?php for($m=0;$m<count($menu[$parents]['children'][$children]['products']);$m++):?>
			<ul class="category-elem-body">
				<li class="category-elem-item">
					<div class="category-elem-name">
						<?=$menu[$parents]['children'][$children]['products'][$m]['title'];?>
					</div>
					<div class="category-elem-weight">
						<?=getMenuProperty($menu[$parents]['children'][$children]['products'][$m]['property']);?>
					</div>
					<div class="category-elem-price">
						<?=$menu[$parents]['children'][$children]['products'][$m]['price'];?>р
					</div>
					<div class="clear"></div>
				</li>
			</ul>
			<?php endfor;?>
			<?php endif;?>
		<?php endfor;?>
	<?php endif;?>
		</div>
	<?php endif;?>
	</div>
<?php endfor;?>
<section id="restaurant-info" style="z-index:9995;" data-menu="dark" data-offset="2803.78125">
	<div class="container clearfix">
		<h2><span>Ресторан</span></h2>
		<ul class="rest-list">
			<li class="rest-item">
				<div class="rest-content clearfix">
					<figure>
						<img class="avatar" src="<?=base_url('img/menu/3.jpg');?>" alt="Свежие морепродукты" />
					</figure>
					<div class="rest-text">
						<h3><?=$contents[2]['content'];?></h3>
						<p>
							<?=$contents[3]['content'];?>
						</p>
						<div class="tags">
							<?=$contents[4]['content'];?>
						</div>
					</div>
				</div>
			</li>
			<li class="rest-item">
				<div class="rest-content clearfix">
					<figure>
						<img class="avatar" src="<?=base_url('img/menu/4.jpg');?>" alt="Францзуское вино" />
					</figure>
					<div class="rest-text">
						<h3><?=$contents[5]['content'];?></h3>
						<p>
							<?=$contents[6]['content'];?>
						</p>
						<div class="tags">
							<?=$contents[7]['content'];?>
						</div>
					</div>
				</div>
			</li>
			<li class="rest-item">
				<div class="rest-content clearfix">
					<figure>
						<img class="avatar" src="<?=base_url('img/menu/1.jpg');?>" alt="Блюда на гриле" />
					</figure>
					<div class="rest-text">
						<h3><?=$contents[8]['content'];?></h3>
						<p>
							<?=$contents[9]['content'];?>
						</p>
						<div class="tags">
							<?=$contents[10]['content'];?>
						</div>
					</div>
				</div>
			</li>
		</ul> <!-- /rest-list -->
		<div class="menu-list">
			<div class="menu-item">
				<a href="<?=site_url('menu');?>">
					<img src="<?=base_url('img/menu/category-1.png');?>" alt="Меню" />
					<span>Меню</span>
				</a>
			</div>
			<div class="menu-item">
				<a href="<?=site_url('wine-card');?>">
					<img src="<?=base_url('img/menu/category-2.png');?>" alt="Винная карта" />
					<span>Ресторан&amp;Бар</span>
				</a>
			</div>
			<div class="menu-item">
				<a href="<?=site_url('aquarium');?>">
					<img src="<?=base_url('img/menu/category-3.png');?>" alt="Аквариум" />
					<span>Аквариум</span>
				</a>
			</div>
		</div>
	</div>
</section>
<section id="pool-info" style="z-index:9993;" data-menu="dark" data-offset="4822.5625">
	<div class="container clearfix">
		<h2><span>Бассейн</span></h2>
		<div class="rest-list">
			<div class="rest-item">
				<div class="rest-content clearfix">
					<figure class="card">
						<div class="card__front">
							<img class="avatar" src="<?=base_url('img/pool/category-1.jpg');?>" alt="Открытый основной бассейн" />
						</div>
						<div class="card__back">
							<div class="back__circle">
								<?=$contents[15]['content'];?>
							</div>
						</div>
					</figure>
					<div class="rest-text">
						<h3><?=$contents[12]['content'];?></h3>
						<p>
							<?=$contents[13]['content'];?>
						</p>
						<div class="tags">
							<?=$contents[14]['content'];?>
						</div>
					</div>
				</div>
			</div>
			<div class="rest-item">
				<div class="rest-content clearfix">
					<figure class="card">
						<div class="card__front">
							<img class="avatar" src="<?=base_url('img/pool/category-2.jpg');?>" alt="Детский бассейн" />
						</div>
						<div class="card__back">
							<div class="back__circle">
								<?=$contents[19]['content'];?>
							</div>
						</div>
					</figure>
					<div class="rest-text">
						<h3><?=$contents[16]['content'];?></h3>
						<p>
							<?=$contents[17]['content'];?>
						</p>
						<div class="tags">
							<?=$contents[18]['content'];?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="menu-list">
			<div class="menu-item">
				<a href="<?=site_url('pool-rules');?>">
					<img src="<?=base_url('img/pool/category-4.png');?>" alt="Условия посещения басейна" />
					<span>Условия посещения<br/>басейна</span>
				</a>
			</div>
			<div class="menu-item">
				<a href="<?=site_url('kids');?>">
					<img src="<?=base_url('img/pool/category-3.png');?>" alt="Детям" />
					<span>Детям</span>
				</a>
			</div>
		</div> 
		<div class="clear"> </div>
		<div class="pool-temperature clearfix">
			<div class="column air">
				<?=$contents[20]['content'];?>
			</div>
			<div class="column water">
				<?=$contents[21]['content'];?>
			</div>
		</div>
	</div>
</section>
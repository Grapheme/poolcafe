<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js aquarium-html"> <!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>
</head>
<body class="aquarium-body">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="logo-back-to-main">
		<a href="<?=site_url('')?>"><img src="<?=base_url('img/color_logo.png');?>"></a>
	</div>
	<article class="wrapper">
		<div class="menu-header">
			<h2><span>Аквариум</span></h2>
		</div>
		<div class="aquarium_bg">
			<section class="aquarium">
				<div class="octopus-1 div-octopus">
					<img class="parallax-layer" src="<?=base_url('img/octopus1.png');?>">
				</div>
				<div class="aquarium-body">
					<?php $this->load->view("guests_interface/includes/nav-menu");?>
					<div class="aquarium-content">
						<div class="aquarium-content">
							<h3 class="aquarium-content-header"> В <span class="bold">аквариуме</span> с морской водой всегда <span class="bold">свежие морепродукты</span></h3>
							<div class="snacks">
								<h3 class="category-header">Аквариум</h3>
								<div class="category-elem">
									<ul class="category-elem-body">
									<?php for($i=0;$i<count($menu);$i++):?>
										<li class="category-elem-item">
											<div class="category-elem-name">
												<?=$menu[$i]['title'];?>
											</div>
											<div class="category-elem-weight">
												<?=getMenuProperty($menu[$i]['property']);?>
											</div>
											<div class="category-elem-price">
												<?=$menu[$i]['price'];?> р
											</div>
											<div class="clear"></div>
										</li>
									<?php endfor;?>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="octopus-2 div-octopus">
					<img src="<?=base_url('img/octopus2.png');?>" style="z-index: -100;" class="parallax-layer">
				</div>
			</section>
		</div>
	</article>
	<?php $this->load->view("guests_interface/includes/scripts");?>
	<script src="<?=base_url('js/vendor/jquery.parallax.js');?>"></script>
	<script src="<?=base_url('js/cabinet/parallax-config.js');?>"></script>
	<?php $this->load->view("guests_interface/includes/typekit-fonts");?>
</body>
</html>
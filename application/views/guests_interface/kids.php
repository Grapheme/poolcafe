<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js kids-html"> <!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>
</head>
<body class="kids-body">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="logo-back-to-main">
		<a href="<?=site_url('')?>"><img src="<?=base_url('img/color_logo.png');?>"></a>
	</div>
	<article class="wrapper">
		<div class="menu-header">
			<h2><span class="kids-header-span">Детям</span></h2>
		</div>
		<div class="aquarium_bg">
			<section class="aquarium">
				<div class="octopus-1 div-octopus">
					<img class="parallax-layer" src="<?=base_url('img/ball.png');?>">
				</div>
				<div class="aquarium-body">
					<div class="aquarium-content">
						<h3 class="kids-content-header"><?=$contents[25]['content'];?></h3>
						<?=$contents[26]['content'];?>
					</div>
				</div>
				<div class="octopus-2 div-octopus">
					<img style="z-index: -100;" class="parallax-layer" src="<?=base_url('img/circle.png');?>">
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
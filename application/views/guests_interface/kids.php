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
					<?php $this->load->view("guests_interface/includes/nav-menu");?>
					<div class="aquarium-content">
						<h3 class="kids-content-header"> В St.Tropez созданы все условия <span class="bold">для отдыха с маленькими детьми</span></h3>
						<p>
							Отдельный подогреваемый бассейн с горкой и большая детская площадка смогут надолго увлечь вашего ребенка.
							в выходные дни у нас работают профессиональные аниматоры, которые в течение всего дня смогут позаботиться о ваших малышах.
						</p>
						<h4 class="parents-information">Информация для родителей</h4>
						<ul class="parents-information-list">
							<li>&nbsp;Дети младше 5 лет - вход бесплатный.</li>
							<li>&nbsp;Детский бассейн обогревается, что позволяет постоянно поддерживать комфортную температуру в бассейне.</li>
							<li>&nbsp;На детской площадке есть игровая зона, где малыши смогут покататься на качелях, попрыгать на батуте и проявить свои творческие способности.</li>
						</ul>
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
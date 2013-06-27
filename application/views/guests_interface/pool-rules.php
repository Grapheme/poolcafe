<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js pool-rules-html"> <!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>
</head>
<body class="pool-rules-body">
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="logo-back-to-main">
		<a href="<?=site_url('')?>"><img src="<?=base_url('img/color_logo.png');?>"></a>
	</div>
	<article class="wrapper">
		<div class="menu-header">
			<h2><span class="kids-header-span">Бассейн</span></h2>
		</div>
		<div class="aquarium_bg">
			<section class="aquarium">
				<div class="octopus-1 div-octopus">
					<img class="parallax-layer" src="<?=base_url('img/tapok1.png');?>">
				</div>
				<div class="aquarium-body">
					<div class="aquarium-content">
						<h3 class="kids-content-header"> Правила посещения <span class="bold">бассейна</span> St.Tropez</span></h3>
						<p>
							Окруженный шезлонгами, пальмами и пляжными зонтиками — бассейн с нежной лазурной водой приковывает внимание всех посетителей. Вокруг бассейна на лежаках можно погреться на солнышке, а немного дальше, в тени, можно устроиться в беседке. Бассейн работает 7 дней в неделю.
						</p>
						<h4 class="parents-information">Правила и стоимость посещения:</h4>
						<ul class="parents-information-list">
							<li>&nbsp;Каждому посетителю бассейна предоставляется в пользование полотенце, комфортная раздевалка и лежак рядом с бассейном.</li>
							<li>&nbsp;В будние дни с 05.00 до 12.00 стоимость посещения 500 рублей без депозита. С 12.00 и до закрытия — 1 000 рублей, 500 рублей — депозит в ресторане.</li>
							<li>&nbsp;В выходные с 05.00 до 12.00 стоимость посещения 500 рублей и 500 депозит в ресторане. С 12.00 и до закрытия бассейна — 1 000 рублей, 1 000 рублей — депозит.</li>
							<li>&nbsp;Дети до 5 лет — бесплатно.</li>
						</ul>
					</div>
				</div>
				<div class="octopus-2 div-octopus">
					<img style="z-index: -100;" class="parallax-layer" src="<?=base_url('img/tapok2.png');?>">
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
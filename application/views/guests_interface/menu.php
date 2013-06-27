<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js menu-html"> <!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>
</head>
<body class="menu-body-back">
 <!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="logo-back-to-main">
		<a href="<?=site_url('')?>"><img src="<?=base_url('img/color_logo.png');?>"></a>
	</div>
	<article class="wrapper">
		<div class="menu-header">
			<h2><span>Меню</span></h2>
		</div>
		<div class="menu-body-bg">
			<section class="menu">
				<div class="menu-body">
					<div class="menu-content">
						<?php $this->load->view("guests_interface/includes/nav-menu");?>
						<?php
							$columnCount1 = round(count($menu)/2);
							$columnCount2 = count($menu);
						?>
						<div class="menu-content-column1">
							<?php $this->load->view("html/writeMenuColumn",array('start'=>0,'stop'=>$columnCount1));?>
						</div>
						<!--<div class="menu-content-column2">
							<?php $this->load->view("html/writeMenuColumn",array('start'=>$columnCount1,'stop'=>$columnCount2));?>
						</div>-->
						<div class="clear"></div>
					</div>
				</div>
			</section>
		</div>
	</article>
	<?php $this->load->view("guests_interface/includes/scripts");?>
	<?php $this->load->view("guests_interface/includes/typekit-fonts");?>
</body>
</html>
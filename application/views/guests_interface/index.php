<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>

<link rel="stylesheet" href="<?=base_url('css/fotorama.css');?>" />
</head>
<body>
 <!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div class="nav-containter">
		<div class="mask_container">
			<?php $this->load->view("guests_interface/includes/nav-dark");?>
			<?php $this->load->view("guests_interface/includes/nav-light");?>
		</div>
	</div>
	<article id="skrollr-body">
		<?php $this->load->view("guests_interface/sections/about");?>
		<?php $this->load->view("guests_interface/sections/news");?>
		<?php $this->load->view("guests_interface/sections/restaurant");?>
		<?php $this->load->view("guests_interface/sections/restaurant-info");?>
		<?php $this->load->view("guests_interface/sections/pool");?>
		<?php $this->load->view("guests_interface/sections/pool-info");?>
		<?php $this->load->view("guests_interface/sections/contacts");?>
		<?php $this->load->view("guests_interface/includes/footer");?>
	</article>
	<?php $this->load->view("guests_interface/includes/scripts");?>
	
<script type="text/javascript" src="<?=site_url('js/vendor/skrollr.min.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/vendor/fotorama.js');?>"></script>
	<?php $this->load->view("guests_interface/includes/google-maps");?>
	<?php $this->load->view("guests_interface/includes/typekit-fonts");?>
	<?php $this->load->view("guests_interface/includes/yandex-metrika");?>
	
</body>
</html>
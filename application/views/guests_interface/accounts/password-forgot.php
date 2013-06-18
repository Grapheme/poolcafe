<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>

<link rel="stylesheet" href="<?=base_url('css/bootstrap.css');?>" />
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<div id="wrapper">
		<?php $this->load->view("guests_interface/includes/header");?>
	<?php if($this->loginstatus == TRUE && $this->account['group'] == USER_GROUP_VALUE):?>
		<?php $this->load->view("users_interface/includes/sidebar");?>
	<?php endif;?>
		<article class="main-content">
			<section class="container_16">
				<div class="grid_13">
					<div class="div-forgot-password">
						<?php $this->load->view('guests_interface/forms/forgot');?>
					</div>
				</div>
				<div class="grid_3">
				<?php if($this->loginstatus == FALSE):?>
					<?php $this->load->view('guests_interface/includes/sign-in-up-sn');?>
				<?php endif;?>
				</div>
			</section>
		</article>
		<?php $this->load->view("guests_interface/modal/sign-in");?>
	</div>
	<?php $this->load->view("guests_interface/includes/footer");?>
	<?php $this->load->view("guests_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
</body>
</html>
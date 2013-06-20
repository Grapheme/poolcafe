<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>

<link rel="stylesheet" href="<?=site_url('css/datapicker/jquery-ui-datapicker.css');?>" />
</head>
<body>
<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->
	<?php $this->load->view("admin_interface/includes/navbar");?>
	<div class="container">
		<div class="row">
			<div class="span3">
				<?php $this->load->view("admin_interface/includes/sidebar");?>
			</div>
			<div class="span9">
				<ul class="breadcrumb">
					<li><a href="<?=site_url(ADMIN_START_PAGE);?>">Панель управления</a> <span class="divider">/</span></li>
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/news');?>">События</a> <span class="divider">/</span></li>
					<li class="active">Добавление события</li>
				</ul>
				<div class="clear"></div>
				<?=$this->load->view('admin_interface/forms/insert-event')?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=site_url('ckeditor/ckeditor.js');?>"></script>
<script type="text/javascript" src="<?=site_url('ckeditor/adapters/jquery.js');?>" ></script>
<script type="text/javascript" src="<?=site_url('ckfinder/ckfinder.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/redactor-config.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/datepicker/jquery.ui.datepicker-ru.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/datepicker.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/upload.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
</body>
</html>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
<?php if($this->input->get('mode') == 'slideshow'):?>
<link rel="stylesheet" href="<?=base_url('css/uploadzone.css');?>" />
<?php endif;?>
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
					<li class="active">Изображения</li>
				</ul>
				<ul class="nav nav-tabs">
					<li <?=($this->input->get('mode') == 'slideshow')?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=slideshow')?>">Слайды</a></li>
					<li <?=($this->input->get('mode') == 'single')?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=single&id=4')?>">Одиночные</a></li>
				</ul>
			<?php if($this->input->get('mode') == 'slideshow'):?>
				<p class="text-info">Выберите место загрузки:</p>
				<select autocomplete="off" class="select-resources-part" name="resources-part">
					<option value="1">Главная</option>
					<option value="2">Ресторан</option>
					<option value="3">Бассейн</option>
				</select><br/>
				<?=$this->load->view('html/zone-upload-file',array('action'=>site_url('page-resources/upload/resource?id=1')));?>
				<p>&nbsp;</p>
				<div class="clearfix">
					<h4>Главная</h4>
					<ul class="resources-items-id1" data-action="<?=site_url('page-resources/remove/resource?id=1');?>">
					<?php for($i=0;$i<count($resources1);$i++):?>
						<li class="span2">
							<img class="img-rounded" src="<?=site_url($resources1[$i]['resource'])?>" alt="">
							<a href="" data-resource-id="<?=$resources1[$i]['id']?>" class="no-clickable delete-resource-item">&times;</a>
						</li>
					<?php endfor;?>
					</ul>
				</div>
				<div class="clearfix">
					<h4>Ресторан</h4>
					<ul class="resources-items-id2" data-action="<?=site_url('page-resources/remove/resource?id=2');?>">
					<?php for($i=0;$i<count($resources2);$i++):?>
						<li class="span2">
							<img class="img-rounded" src="<?=site_url($resources2[$i]['resource'])?>" alt="">
							<a href="" data-resource-id="<?=$resources2[$i]['id']?>" class="no-clickable delete-resource-item">&times;</a>
						</li>
					<?php endfor;?>
					</ul>
				</div>
				<div class="clearfix">
					<h4>Бассейн</h4>
					<ul class="resources-items-id3" data-action="<?=site_url('page-resources/remove/resource?id=3');?>">
					<?php for($i=0;$i<count($resources3);$i++):?>
						<li class="span2">
							<img class="img-rounded" src="<?=site_url($resources3[$i]['resource'])?>" alt="">
							<a href="" data-resource-id="<?=$resources3[$i]['id']?>" class="no-clickable delete-resource-item">&times;</a>
						</li>
					<?php endfor;?>
					</ul>
				</div>
			<?php endif;?>
			<?php if($this->input->get('mode') == 'single'):?>
				<ul class="nav nav-pills">
					<li <?=($this->input->get('id') == 4)?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=single&id=4')?>">Меню</a></li>
					<li <?=($this->input->get('id') == 5)?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=single&id=5')?>">Ресторан</a></li>
					<li <?=($this->input->get('id') == 6)?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=single&id=6')?>">Аквариум</a></li>
					<li <?=($this->input->get('id') == 7)?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=single&id=7')?>">Основной басейн</a></li>
					<li <?=($this->input->get('id') == 8)?'class="active"':'';?>><a href="<?=site_url(ADMIN_START_PAGE.'/resources?mode=single&id=8')?>">Детский басейн</a></li>
				</ul>
				<div class="clearfix">
					<img class="span2 destination-photo img-polaroid" src="<?=site_url($resources[0]['resource']);?>" />
				</div>
				<form action="<?=site_url(uri_string())?>" method="POST">
					<div class="controls">
						<input type="file" class="input-select-photo" autocomplete="off" id="input-page-photo" name="file" size="36">
						<button id="upload-page-photo" data-part="<?=$this->input->get('id');?>" class="btn btn-small btn-info btn-upload hidden"><i class="icon-upload icon-white"></i> Загрузить</button>
						<p class="help-block">Поддерживаются форматы: JPG,PNG,GIF</p>
						<div class="clear"></div>
						<div id="div-upload-photo" class="bar-file-upload hidden">
							<div class="span6 progress progress-info progress-striped active">
								<div class="bar" style="width: 54%"></div>
							</div>
							<span id="upload-photo-status">Загрузка</span>
						</div>
					</div>
				</form>
			<?php endif;?>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
<?php if($this->input->get('mode') == 'slideshow'):?>
<script type="text/javascript" src="<?=site_url('js/libs/dropzone.js');?>"></script>
<?php endif;?>
<?php if($this->input->get('mode') == 'single'):?>
<script type="text/javascript" src="<?=site_url('js/cabinet/single-upload.js');?>"></script>
<?php endif;?>
<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
</body>
</html>
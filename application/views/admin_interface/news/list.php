<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
<?php $this->load->view("admin_interface/includes/head");?>
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
					<li class="active">Новости</li>
				</ul>
				<a href="<?=site_url(ADMIN_START_PAGE.'/news/add')?>" class="btn">Добавить новость</a>
				<div class="clear"></div>
			<?php if(!empty($news)):?>
				<?php for($i=0;$i<count($news);$i++):?>
					<div class="media hover-item-block">
						<div class="media-body list-item-block" data-src="<?=$news[$i]['id'];?>">
							<h3 class="media-heading"><?=$news[$i]['title'];?></h3>
							<p class="palette-paragraph"><?=swap_dot_date_without_time($news[$i]['date_publish']);?></p>
							<div class="media">
								<p><?=$news[$i]['anonce'];?></p>
							</div>
							<a href="<?=site_url(ADMIN_START_PAGE.'/news/edit/'.$news[$i]['id']);?>">Редактировать</a>
							<a class="confirm-user" href="<?=site_url(ADMIN_START_PAGE.'/news/delete/'.$news[$i]['id']);?>">Удалить</a>
						</div>
						<div class="clear"></div>
					</div>
				<?php endfor;?>
				<?=$pagination;?>
			<?php else:?>
				<div class="msg-alert">Список пуст</div>
			<?php endif;?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
</body>
</html>
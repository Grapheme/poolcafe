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
					<li class="active">Меню<span class="divider">/</span></li>
					<li class="active">Категории</li>
				</ul>
				<div class="clear"></div>
				<div class="result-request"></div>
			<?php if(!empty($group)):?>
				<h2>Группы меню</h2>
				<ul class="ul-parent" data-action="<?=site_url(ADMIN_START_PAGE.'/save-group')?>">
				<?php for($i=0;$i<count($group);$i++):?>
					<li data-item="<?=$group[$i]['id'];?>">
						<span class="title"><?=$group[$i]['title'];?></span>
						<button class="btn btn-link edit-group-menu"><i class="icon-edit"></i></button>
					</li>
				<?php endfor;?>
				</ul>
			<?php else:?>
				<div class="msg-alert">Список групп меню пуст</div>
			<?php endif;?>
				<div class="clear"></div>
				<h2>Категории меню</h2>
				<ul class="ul-parent" data-parent="0" data-action="<?=site_url(ADMIN_START_PAGE.'/manage-category')?>">
				<?php for($i=0;$i<count($categories);$i++):?>
					<li data-item="<?=$categories[$i]['id'];?>">
						<span class="title view-subcategory text-info"><?=$categories[$i]['title'];?></span>
						<button class="btn btn-link edit-category-menu"><i class="icon-edit"></i></button>
						<button class="btn btn-link remove-category-menu"><i class="icon-remove"></i></button>
						<ul class="ul-children hidden" data-parent="<?=$categories[$i]['id'];?>">
					<?php if(isset($categories[$i]['children'])):?>
						<?php for($j=0;$j<count($categories[$i]['children']);$j++):?>
							<li data-item="<?=$categories[$i]['children'][$j]['id'];?>">
								<span class="title"><?=$categories[$i]['children'][$j]['title'];?></span>
								<button class="btn btn-link edit-category-menu" ><i class="icon-edit"></i></button>
								<button class="btn btn-link remove-category-menu"><i class="icon-remove"></i></button>
							</li>
						<?php endfor;?>
					<?php endif;?>
							<li class="li-parent">
								<input type="text" class="input-title" name="category" placeholder="Добавить подкатегорию">
								<button class="btn btn-link save-category-menu"><i class="icon-plus-sign"></i></button>
							</li>
						</ul>
					</li>
				<?php endfor;?>
					<li class="li-parent">
						<input type="text" class="input-title" name="category" placeholder="Добавить категорию">
						<button class="btn btn-link save-category-menu"><i class="icon-plus-sign"></i></button>
					</li>
				</ul>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
</body>
</html>
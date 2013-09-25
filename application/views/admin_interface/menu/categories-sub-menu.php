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
					<li><a href="<?=site_url(ADMIN_START_PAGE.'/categories/menu');?>">Категории меню</a><span class="divider">/</span></li>
					<li class="active">Подкатегории меню</li>
				</ul>
				<div class="clear"></div>
				<?php $this->load->view('html/select-categories-menu');?>
			<?php if($this->input->get('category') !== FALSE):?>
				<a href="<?=site_url(ADMIN_START_PAGE.'/categories/sub-menu/add'.getUrlLink())?>" class="btn">Добавить подкатегорию</a>
			<?php endif;?>
				<h2>Категории меню</h2>
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/category/remove');?>">
					<thead>
						<tr>
							<th class="span6">Название</th>
							<th class="span2"></th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($sub_categories);$i++):?>
						<tr>
							<td><?=$sub_categories[$i]['title'];?></td>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/categories/sub-menu/edit?id='.$sub_categories[$i]['id'].'&category='.$sub_categories[$i]['parent'])?>" class="btn btn-link" ><i class="icon-edit"></i></a>
								<button data-item="<?=$sub_categories[$i]['id'];?>" class="btn btn-link remove-item"><i class="icon-remove"></i></button>
							</td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

	<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
	<script type="text/javascript" src="<?=site_url('js/cabinet/selects.js');?>"></script>
</body>
</html>
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
					<li class="active">Категории (Группы)</li>
				</ul>
				<div class="clear"></div>
				<div class="result-request"></div>
			<?php if(!empty($group)):?>
				<h2>Группы меню</h2>
				
				<table class="table table-bordered table-striped table-hover table-condensed" data-action="<?=site_url(ADMIN_START_PAGE.'/save-group')?>">
					<thead>
						<tr>
							<th class="span1"></th>
							<th class="span6">Название</th>
							<th class="span1">№ п.п.</th>
						</tr>
					</thead>
					<tbody>
					<?php for($i=0;$i<count($group);$i++):?>
						<tr>
							<td>
								<a href="<?=site_url(ADMIN_START_PAGE.'/categories/group/edit?id='.$group[$i]['id'])?>" class="btn btn-link" ><i class="icon-edit"></i></a>
							</td>
							<td class="menu-title">
								<a href="<?=site_url(ADMIN_START_PAGE.'/categories/menu?group='.$group[$i]['id'])?>"><?=$group[$i]['title'];?></a>
							</td>
							<td class="menu-title"><?=$group[$i]['number'];?></td>
						</tr>
					<?php endfor;?>
					</tbody>
				</table>
			<?php else:?>
				<div class="msg-alert">Список групп меню пуст</div>
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
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
					<li class="active">Редактирование страницы</li>
				</ul>
				<hr/>
				<h4>Главная</h4>
				<textarea class="span7" data-id="1" rows="2" name="content[]"><?=$contents[0]['content'];?></textarea>
				<button data-id="1" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<hr/>
				<h4>Ресторан</h4>
			<?php for($i=1;$i<=10;$i++):?>
				<textarea class="span7" data-id="<?=$i+1;?>" rows="2" name="content[]"><?=$contents[$i]['content'];?></textarea>
				<button data-id="<?=$i+1;?>" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
			<?php endfor;?>
				<hr/>
				<h4>Басейн</h4>
			<?php for($i=11;$i<=21;$i++):?>
				<textarea class="span7" data-id="<?=$i+1;?>" rows="2" name="content[]"><?=$contents[$i]['content'];?></textarea>
				<button data-id="<?=$i+1;?>" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
			<?php endfor;?>
				<hr/>
				<h4>Контакты</h4>
				<textarea class="span7" data-id="23" rows="2" name="content[]"><?=$contents[22]['content'];?></textarea>
				<button data-id="23" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<hr/>
				<h4>Правила посещения бассейна</h4>
				<textarea class="span7" data-id="24" rows="2" name="content[]"><?=$contents[23]['content'];?></textarea>
				<button data-id="24" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<textarea class="span7" data-id="25" rows="2" name="content[]"><?=$contents[24]['content'];?></textarea>
				<button data-id="25" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<hr/>
				<h4>Детям</h4>
				<textarea class="span7" data-id="26" rows="2" name="content[]"><?=$contents[25]['content'];?></textarea>
				<button data-id="26" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<textarea class="span7" data-id="27" rows="2" name="content[]"><?=$contents[26]['content'];?></textarea>
				<button data-id="27" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<hr/>
				<h4>Аквариум</h4>
				<textarea class="span7" data-id="28" rows="2" name="content[]"><?=$contents[27]['content'];?></textarea>
				<button data-id="28" class="btn btn-content-submit no-clickable btn-loading" name="submit[]" value="" type="submit">Сохранить</button>
				<hr/>
			</div>
		</div>
	</div>
	
	<?php $this->load->view("admin_interface/includes/footer");?>
	<?php $this->load->view("admin_interface/includes/scripts");?>

<script type="text/javascript" src="<?=site_url('js/libs/bootstrap.js');?>"></script>
<script type="text/javascript" src="<?=site_url('js/cabinet/admin.js');?>"></script>
</body>
</html>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js news-html"><!--<![endif]-->
<head>
<?php $this->load->view("guests_interface/includes/head");?>

<link rel="stylesheet" href="<?=base_url('css/pagination.css');?>" />
</head>
<body class="news-body">
	<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->
	<div class="logo-back-to-main">
		<a href="<?=site_url('')?>"><img src="<?=base_url('img/white_logo.png');?>"></a>
	</div>
	<article class="news-wrapper">
		<div class="news-header">
			<h2><span>Новости</span></h2>
		</div>
		<div class="news-bg">
			<section class="news">
				<div class="sep_new-date">
					<?=monthDateSpan($news['date_publish'],'month-name');?>
					<div class="back-forward-links">
						<ul class="back-forward-links-list">
							<li class="back-forward-links-list-item back">
							<?php if($linkback['exist'] === TRUE):?>
								<a href="<?=$linkback['link'];?>"><img src="<?=base_url('img/linkback.png');?>"></a>
							<?php endif;?>
							</li>
							<li class="back-forward-links-list-item mainmenu">
								<a href="<?=site_url('news')?>"><img src="<?=base_url('img/mainmenu.png');?>"></a>
							</li>
							<li class="back-forward-links-list-item forward">
							<?php if($linkforward['exist'] === TRUE):?>
								<a href="<?=$linkforward['link'];?>"><img src="<?=base_url('img/linkforward.png');?>"></a>
							<?php endif;?>
							</li>
						</ul>
					</div>
				</div>
				<div class="sep_new-header">
					<h1 class="news-item-header"><?=$news['title'];?></h1>
				</div>
				<div class="sep_new-pict">
					<img src="<?=site_url('loadimage/news/'.$news['id']);?>" />
				</div>
				<div class="sep_new-content">
					<?=$news['content'];?>
				</div>
			</section>
			<div class="clear"></div>
		</div>
	</article>
	<div class="clear"></div>
	<?php $this->load->view("guests_interface/includes/scripts");?>
	<?php $this->load->view("guests_interface/includes/typekit-fonts");?>
	<?php $this->load->view("guests_interface/includes/yandex-metrika");?>
</body>
</html>
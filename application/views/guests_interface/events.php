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
			<h2><span>События</span></h2>
		</div>
		<div class="news-bg">
			<section class="news">
				<ul class="newspage-list">
				<?php for($i=0;$i<count($events);$i++):?>
					<li class="news-list-item">
						<div  class="news-item-body">
							<div class="news-item-leftside">
								<div class="news-item-date">
									<?=monthDateSpan($events[$i]['date_publish'],'month-name');?>
								</div>
								<div class="news-item-pict">
									<img src="<?=site_url('loadimage/events/'.$events[$i]['id']);?>" />
								</div>
							</div>
							<div class="news-item-rightside">
								<div class="news-item-header">
									<a class="news-item-header-link" href="<?=site_url('events/'.$events[$i]['translit'].'?event='.$events[$i]['id']);?>"><?=$events[$i]['title'];?></a>
								</div>
								<?=$events[$i]['category_title'];?>
								<div class="news-item-content">
									<?=$events[$i]['anonce'];?>
								</div>
								<div class="tags">
									<?=$events[$i]['tags'];?>
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</li>
				<?php endfor;?>
				</ul>
				<?=$pagination;?>
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
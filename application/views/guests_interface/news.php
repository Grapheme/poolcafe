<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--><html class="no-js news-html"><!--<![endif]-->
<head>
	<?php $this->load->view("guests_interface/includes/head");?>
	
</head>
<body class="news-body">
	<!--[if lt IE 7]>
	<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
	<![endif]-->
	<article class="news-wrapper">
		<div class="news-header">
			<h2><span>Новости</span></h2>
		</div>
		<div class="news-bg">
			<section class="news">
				<ul class="news-list">
				<?php for($i=0;$i<count($news);$i++):?>
					<li class="news-list-item">
						<div  class="news-item-body">
							<div class="news-item-leftside">
								<div class="news-item-date">
									15 <span class="month-name">июня</span> 2013
								</div>
								<div class="news-item-pict">
									<img src="img/news1.png" />
								</div>
							</div>
							<div class="news-item-rightside">
								<div class="news-item-header">
									<a class="news-item-header-link" href="#">Dj Vladimir Parfenov</a>
								</div>
								<div class="news-item-content">
									Треки Владимира Парфенова звучат на радио DFM, ХитFM, Русское радио, Монте Карло, Максимум и др. станциях России,
									также треки в ротации на знаменитом во всем мире Global Ibiza Radio.
									Каждую субботу лета с 16.00 до 20.00Треки Владимира Парфенова звучат на радио DFM, ХитFM, Русское радио, Монте Карло, Максимум и др. станциях России,
									также треки в ротации на знаменитом во всем мире Global Ibiza Radio.
									Каждую субботу лета с 16.00 до 20.00
								</div>
							</div>
							<div class="clear"></div>
						</div>
					</li>
				<?php endfor;?>
				</ul>
			</section>
		</div>
	</article>
<?php $this->load->view("guests_interface/includes/scripts");?>
<?php $this->load->view("guests_interface/includes/google-maps");?>
<?php $this->load->view("guests_interface/includes/typekit-fonts");?>
<?php $this->load->view("guests_interface/includes/yandex-metrika");?>
</body>
</html>

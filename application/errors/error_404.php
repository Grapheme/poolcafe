<?php
	$config =&get_config();
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php $config =&get_config();?>
	<meta charset="utf-8">
	<title>Page Not Found :(</title>
	<style>
		html, body {
				font: 16px "ff-meta-web-pro", "futura-pt", sans-serif;
				padding: 0;
				margin: 0;
				color: #252525;
			}
			body {
				padding: 5em;
			}
			.where-san-tropez {
				width: 201px;
				height: 77px;
				margin: 0 auto;
				background: url(<?=$config['base_url'];?>img/error404/where_st.png);
			}
			.num404 {
				position: relative;
				width: 639px;
				height: 343px;
				margin: 0 auto;
				background: url(<?=$config['base_url'];?>img/error404/error.png);
			}
			.back-to-main {
				position: absolute;
				bottom: -2.5em;
				left: -3em;
				display: inline-block;
				padding: .2em .7em;
				background-color: #e18c44;
				height: 1.4em;
			}
			.back-to-main a {
				display: block;
				line-height: 1.2;
				text-decoration: none;
				color: #FFF;
				font-weight: 500;
			}
			.grandies {

				position: relative;
				width: 102px;
				height: 343px;
				top: 100px;
				left: 639px;
			}
			.parallax-layer {
				position: absolute;
			}
			.mom {
				right: 10px;
				top: -10px;
			}
			.dad {
				position: relative;
				z-index: 9999;
			}
	</style>
</head>
<body>
	<div class="container">
		<div class="where-san-tropez"></div>
		<div class="num404">
			<div class="back-to-main">
				<a href="<?=$config['base_url'];?>">вернуться на главную</a>
			</div>
			
			<div class="grandies">
				<img class="parallax-layer mom" src="<?=$config['base_url'];?>img/error404/grmum.png" alt="">
				<img class="dad" src="<?=$config['base_url'];?>img/error404/grdad.png" alt="">
		    </div>
		</div>
		
	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="<?=$config['base_url'];?>js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
	<script src="<?=$config['base_url'];?>js/vendor/jquery.parallax.js"></script>
	<script src="<?=$config['base_url'];?>js/cabinet/parallax-config.js"></script>
	<script type="text/javascript" src="//use.typekit.net/tnx6yum.js"></script>
	<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
</body>
</html>

<section id="news" style="z-index:9997;" data-menu="dark" >
	<div class="container clearfix">
		<h2><span>Новости&amp;События</span></h2>
		<div class="events-list">
			<div class="list-title clearfix">
				Ближайшие события
				<a href="<?=site_url('events');?>">Показать все</a>
			</div>
		<?php for($i=0;$i<count($events);$i++):?>
			<div class="events-item">
				<div class="event-title clearfix">
					<?=$events[$i]['category_title'];?>
					<span class="date"><?=month_date($events[$i]['date_publish'])?></span>
				</div>
				<div class="event-content">
					<figure class="card">
						<div class="card__front">
							<img class="avatar" src="<?=site_url('loadimage/events/'.$events[$i]['id']);?>" alt="<?=$events[$i]['title'];?>" />
						</div>
						<div class="card__back">
							<div class="back__circle">
								<div class="back__age"><?=$events[$i]['age'];?></div>
								<div class="back__time">НАЧАЛО <strong><?=$events[$i]['time'];?></strong></div>
								<div class="back__price"><?=$events[$i]['price'];?></div>
							</div>
						</div>
					</figure>
					<div class="event-text">
						<h3><a href="<?=site_url('events/'.$events[$i]['translit'].'?event='.$events[$i]['id']);?>"><?=$events[$i]['title'];?></a></h3>
						<p><?=$events[$i]['anonce'];?></p>
						<div class="tags">
							<?=$events[$i]['tags'];?>
						</div>
					</div>
				</div>
			</div>
		<?php endfor;?>
		</div>
		<div class="news-list">
			<div class="list-title clearfix">
				Последние новости
				<a href="<?=site_url('news');?>">Показать все</a>
			</div>
		<?php for($i=0;$i<count($news);$i++):?>
			<div class="news-item">
				<div class="news-date"><?=month_date($news[$i]['date_publish'])?></div>
				<h3><a href="<?=site_url('news/'.$news[$i]['translit'].'?news='.$news[$i]['id']);?>" class=""><?=$news[$i]['title'];?></a></h3>
				<p><?=$news[$i]['anonce']?></p>
				<a class="read-more" href="#">Подробный фотоотчет</a>
			</div>
		<?php endfor;?>
		</div>
	</div>
</section>
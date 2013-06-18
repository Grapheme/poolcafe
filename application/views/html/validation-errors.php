<div class="alert alert-block">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<h5><?=$alert_header;?></h5>
	<div class="text-error">
		<ol>
			<?= validation_errors(); ?>
		</ol>
	</div>
</div>
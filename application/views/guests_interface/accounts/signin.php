<!DOCTYPE html>
<html lang="en">
<head>
<?php $this->load->view("admin_interface/includes/head");?>
</head>
<body>
	<div class="container">
	<?php $this->load->view("guests_interface/forms/sign-in");?>
	</div>
	<?php $this->load->view("admin_interface/includes/scripts");?>
	
	<script type="text/javascript" src="<?=site_url('js/cabinet/guest.js');?>"></script>
</body>
</html>

<form action="<?=site_url('login-in');?>" method="POST" class="form-signin">
	<h2 class="form-signin-heading text-center">Авторизация</h2>
	<input type="text" class="input-block-level valid-required" name="login" value="" placeholder="Логин">
	<input type="password" class="input-block-level valid-required" name="password" value="" placeholder="Пароль">
	<div class="div-form-operation">
		<button class="btn input-block-level btn-loading no-clickable" type="submit">Вход</button>
	</div>
</form>
<form action="<?=site_url('send-forgot-password');?>" method="POST" class="form-forgot-password" id="forgot-password">
	<p class="form-forgot-password-heading text-info">
		<i class="icon-info-sign"></i> Введите ниже Ваш адрес електронной почты (e-mail). Как только Вы сделаете это, Вы получите письмо на e-mail на подтверждение Вашего запроса. 
		В письме также будет содержаться ссылка, по которой Вам нужно будет перейти на страницу, где сможете указать новый пароль для Вашего аккаунта.
	</p>
	<input type="text" name="email" id="recowery-email" value="" class="input-block-level valid-email valid-required" placeholder="Введите адрес Email указанный при регистрации" <?=TOOLTIP_FIELD_BLANK;?> />
	<div class="text-error form-request"></div>
	<div class="div-form-operation">
		<button class="btn input-block-level" id="btn-forgot-button" name="" value="">Продолжить</button>
	</div>
	<div class="wait-request hidden"></div>
</form>
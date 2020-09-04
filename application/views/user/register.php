<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1><?=$title?></h1>
	<?php if(!empty(validation_errors())) { ?>
		<div class="alert alert-danger form-error">
			<?=validation_errors()?>
		</div>
	<?php } ?>
	<?=form_open()?>
		<?=form_label($this->lang->line('field_username'), 'username')?><br>
		<?=form_input('username', set_value('username'), ['class' => 'form-control form-custom'])?><br>
		<?=form_label($this->lang->line('field_email'), 'email')?><br>
		<?=form_input('email', set_value('email'), ['class' => 'form-control form-custom', 'placeholder' => $this->lang->line('optional')])?><br>
		<?=form_label($this->lang->line('field_password'), 'password')?><br>
		<?=form_password('password', set_value('password'), ['class' => 'form-control form-custom'])?><br>
		<?=form_label($this->lang->line('field_password_confirm'), 'password_confirm')?><br>
		<?=form_password('password_confirm', set_value('password_confirm'), ['class' => 'form-control form-custom'])?><br>
		<?=form_submit('btn_register', $this->lang->line('btn_register'), ['class' => 'btn btn-primary'])?>
	<?=form_close()?>
	<br>
	<a href="<?=base_url('user/login')?>"><?=$this->lang->line('msg_login')?></a>
</div>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="display-1"><?=$kana->kana?></h1>
	<form action="<?=base_url('revision/validate/'.$mode.'/'.$kana->fk_word)?>" method="POST">
		<input type="text" name="answer" autofocus>
		<input type="submit" name="submit">
	</form>
</div>
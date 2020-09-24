<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_choice_modes')?></h1>
<a href="<?=base_url('revision')?>" class="btn btn-outline-primary"><?=$this->lang->line('btn_back')?></a>
<form method="POST">
	<?php foreach ($modes as $mode) { ?>
		<input type="checkbox" name="modes[<?=$mode->id?>]" value="<?=$mode->fk_word_type?>" <?=in_array($mode->id, $_SESSION['modes'][$mode->fk_word_type]) ? 'checked' : ''?>> <?=$mode->mode?><br>
	<?php } ?>
	<br>
	<input type="submit" name="submit">
</form>
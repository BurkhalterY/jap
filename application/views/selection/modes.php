<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_choice_modes')?></h1>
<a href="<?=base_url('revision')?>" class="btn btn-outline-primary"><?=$this->lang->line('btn_back')?></a>
<?php if(isset($error)){ ?>
	<span class="alert-danger"><?=$error?></span>
<?php } ?>
<form method="POST">
	<?php $prec_word_type = '';
	foreach ($modes as $mode) {
		if($mode->fk_word_type != $prec_word_type){
			$prec_word_type = $mode->fk_word_type;
			echo '<h2>'.$this->lang->line($mode->word_type->type).'</h2>';
		} ?>
		<input type="checkbox" name="modes[<?=$mode->id?>]" value="<?=$mode->fk_word_type?>" <?=in_array($mode->id, $_SESSION['modes'][$mode->fk_word_type]) ? 'checked' : ''?>> <?=$mode->mode?><br>
	<?php } ?>
	<br>
	<input type="submit" name="submit">
</form>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1><?=$tracing->kanji->meaning?></h1>

	<div class="full-inline">
		<span class="big-kanji"><?=$tracing->kanji->kanji?></span><br>
		<img src="<?=base_url('medias/tracings/'.$tracing->image)?>" alt="<?=$tracing->kanji->meaning?>" /><br>
	</div>

	<a href="<?=base_url('revision/validate_trace/'.$tracing->id.'/0')?>" class="btn btn-danger"><?=$this->lang->line('btn_error')?></a>
	<a href="<?=base_url('revision/validate_trace/'.$tracing->id.'/1')?>" class="btn btn-success"><?=$this->lang->line('btn_correct')?></a>
</div>
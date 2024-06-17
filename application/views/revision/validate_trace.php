<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1><?=$kanji->meaning?></h1>

	<div class="full-inline">
		<span class="big-kanji"><?=$kanji->kanji?></span><br>
		<img src="<?=base_url('medias/tracings/'.$tracing)?>" alt="<?=$kanji->meaning?>" /><br>
	</div>

	<a href="<?=base_url('revision/validate_trace/'.$route.'/0')?>" class="btn btn-danger"><?=$this->lang->line('btn_error')?></a>
	<a href="<?=base_url('revision/validate_trace/'.$route.'/1')?>" class="btn btn-success"><?=$this->lang->line('btn_correct')?></a>
</div>
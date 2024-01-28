<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_revision')?></h1>
<a href="<?=base_url('revision/selection')?>" class="btn btn-primary"><?=$this->lang->line('choice_words')?></a>
<br><br>
<div class="row">
	<div class="col-md-4 offset-md-1 text-center">
		<a href="<?=base_url('revision/trace')?>">
			<img src="<?=base_url('assets/images/rev/calligraphy.jpg')?>" alt="Calligraphy" class="img-thumbnail" />	
			<span class="btn btn-primary"><?=$this->lang->line('write_kanjis')?></span>
		</a>
		<br><br>
	</div>
	<div class="col-md-4 offset-md-2 text-center">
		<a href="<?=base_url('revision/translate')?>">
			<img src="<?=base_url('assets/images/rev/translate.png')?>" alt="Translate" class="img-thumbnail" />	
			<span class="btn btn-primary"><?=$this->lang->line('translate')?></span>
		</a>
		<br><br>
	</div>
</div>
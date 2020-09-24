<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_revision_2')?></h1>
<a href="<?=base_url('selection')?>" class="btn btn-primary"><?=$this->lang->line('title_choice_words')?></a>
<a href="<?=base_url('selection/modes')?>" class="btn btn-primary"><?=$this->lang->line('title_choice_modes')?></a>
<br><br>
<div class="row">
	<div class="col-md-4 offset-md-4 text-center">
		<a href="<?=base_url('revision/revision')?>">
			<img src="<?=base_url('assets/images/calligraphy.jpg')?>" alt="<?=$this->lang->line('title_revision')?>" class="img-thumbnail" />	
			<span class="btn btn-primary"><?=$this->lang->line('title_revision')?></span>
		</a>
		<br><br>
	</div>
</div>
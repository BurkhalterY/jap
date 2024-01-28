<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_list')?></h1>
<div class="row">
	<?php foreach ($categories as $categorie) { ?>
		<div class="col-md-4">
			<strong><?=$categorie->cat_name?></strong>
			<a href="<?=base_url('exploration/category/'.$categorie->id)?>">
				<img src="<?=base_url('assets/images/cat/'.$categorie->image)?>" alt="<?=$categorie->cat_name?>" class="img-fluid" />
			</a>
		</div>
	<?php } ?>
</div>
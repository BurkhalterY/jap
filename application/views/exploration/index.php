<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_list')?></h1>
<div class="row">
	<?php foreach ($categories as $category) { ?>
		<div class="col-md-4">
			<strong><?=$category->cat_name?></strong>
			<a href="<?=base_url('exploration/category/'.$category->id)?>">
				<img src="<?=base_url('assets/images/cat/'.$category->image)?>" alt="<?=$category->cat_name?>" class="img-fluid" />
			</a>
		</div>
	<?php } ?>
</div>
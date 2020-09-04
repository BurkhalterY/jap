<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$category->cat_name?></h1>
<a href="<?=base_url('exploration')?>" class="btn btn-outline-primary"><?=$this->lang->line('btn_back')?></a>
<?php foreach ($series as $serie) { ?>
	<li>
		<?php if(isset($serie->empty)) { ?>
			<?=$serie->serie_name?> <?=$this->lang->line('msg_empty')?>
		<?php } else { ?>
			<a href="<?=base_url('exploration/serie/'.$serie->id)?>"><?=$serie->serie_name?></a>
		<?php } ?>
	</li>
<?php } ?>
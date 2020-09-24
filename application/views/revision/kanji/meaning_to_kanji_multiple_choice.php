<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="display-1"><?=$kanji->meaning?></h1>
	<?php foreach ($multiple_choice as $choice) { ?>
		<a href="<?=base_url('revision/validate/'.$mode.'/'.$kanji->fk_word.'?answer='.urlencode($choice->kanji))?>" class="kanji-case btn btn-primary btn-lg"><?=$choice->kanji?></a>
	<?php } ?>
</div>
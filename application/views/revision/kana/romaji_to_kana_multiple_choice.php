<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="display-1"><?=$kana->romaji?></h1>
	<?php foreach ($multiple_choice as $choice) { ?>
		<a href="<?=base_url('revision/validate/'.$mode.'/'.$kana->fk_word.'?answer='.urlencode($choice->kana))?>" class="kanji-case btn btn-primary btn-lg"><?=$choice->kana?></a>
	<?php } ?>
</div>
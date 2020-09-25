<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="display-1"><?=$voc->translation?></h1>
	<?php foreach ($multiple_choice as $choice) { ?>
		<a href="<?=base_url('revision/validate/'.$mode.'/'.$voc->fk_word.'?answer='.urlencode($choice->kanji_or_kana))?>" class="kanji-case btn btn-primary btn-lg"><?=$choice->kanji_or_kana?></a>
	<?php } ?>
</div>
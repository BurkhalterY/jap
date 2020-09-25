<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="display-1"><?=$voc->translation?></h1>

	<span class="big-kanji"><?=$voc->kanji_or_kana?></span>
	<img src="<?=$base64?>" alt="Tracing" /><br>

	<a href="<?=base_url('revision/revision')?>" class="btn btn-primary">Suivant</a>
</div>
<script>
	$(document).keypress(function(e) {
		if (e.keyCode == 13) {
			location.href = "<?=base_url('revision/revision')?>";
		}
	});
</script>

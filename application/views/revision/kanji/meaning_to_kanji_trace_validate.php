<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="display-1"><?=$kanji->meaning?></h1>

	<span class="big-kanji"><?=$kanji->kanji?></span>
	<img src="<?=$base64?>" alt="Kanji tracing" /><br>

	<a href="<?=base_url('revision/revision')?>" class="btn btn-primary">Suivant</a>
</div>
<script>
	$(document).keypress(function(e) {
		if (e.keyCode == 13) {
			location.href = "<?=base_url('revision/revision')?>";
		}
	});
</script>

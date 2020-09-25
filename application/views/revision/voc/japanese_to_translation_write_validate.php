<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1 class="badge-<?=$correct ? 'success' : 'danger'?>"><?=$correct ? 'BIEN JOUÉ !' : 'FAUX !'?></h1>
	<?php if(!$correct){ ?>
		<p>Question : <?=$voc->kanji_or_kana?></p>
		<p class="text-success">La réponse était : <?=$voc->translation?></p>
		<p class="text-danger">Votre réponse : <?=$answer?></p>
	<?php } ?>
	<a href="<?=base_url('revision/revision')?>" class="btn btn-primary">Suivant</a>
</div>
<script>
	$(document).keypress(function(e) {
		if (e.keyCode == 13) {
			location.href = "<?=base_url('revision/revision')?>";
		}
	});
</script>

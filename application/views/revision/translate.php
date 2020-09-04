<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1><?=$kanji->kanji?></h1>

	<div id="form">
		<input type="text" id="your-answer" class="form-control form-custom" onkeydown="enter(event)" autofocus><br>
		<button type="button" id="back" class="btn btn-primary" onclick="window.location.href='<?=base_url('revision')?>'"><?=$this->lang->line('btn_back')?></button>
		<button type="button" id="new" class="btn btn-primary" onclick="location.reload();"><i class="fas fa-redo-alt"></i></button>
		<button type="button" id="save" class="btn btn-success" onclick="validate()"><?=$this->lang->line('btn_validate')?></button>
	</div>
	<div id="validate" style="display: none;">
		<span>
			<?=$this->lang->line('meaning')?> : <strong><?=$kanji->meaning?></strong><br>
			<?php if(!empty($kanji->kanas)){ ?><?=$this->lang->line('kanas')?> : <strong><?=$kanji->kanas?></strong><br><?php } ?>
			<?=$this->lang->line('your_answer')?> : <strong id="answer"></strong><br>
		</span>
		<a href="<?=base_url('revision/validate_translate/'.$kanji->id.'/0')?>" id="btn-error" class="btn btn-danger"><?=$this->lang->line('btn_error')?></a>
		<a href="<?=base_url('revision/validate_translate/'.$kanji->id.'/1')?>" id="btn-correct" class="btn btn-success"><?=$this->lang->line('btn_correct')?></a>
	</div>

	<script>
		function enter(e) {
			if (e.keyCode === 13 && $('#your-answer').val() != "") {
				validate();
			}
		}

		function validate() {
			$('#form').hide(400);
			$('#validate').show(400);

			let answer = $('#your-answer').val();
			$('#answer').html(answer);


			let _href = $("#btn-error").attr("href");
			$("#btn-error").attr("href", _href + '?a=' + answer);
			_href = $("#btn-correct").attr("href");
			$("#btn-correct").attr("href", _href + '?a=' + answer);
		}
	</script>
</div>
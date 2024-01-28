<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="text-center">
	<h1><?=$kanji->meaning?></h1>
	<div class="full-inline">
		<button type="button" id="remove" class="btn btn-danger" onclick="removeSymbol();">-</button>
		<canvas id="full-canvas" width="0" height="250"></canvas>
		<button type="button" id="add" class="btn btn-primary" onclick="addSymbol();">+</button>
	</div>
	<br>
	<canvas id="canvas" width="250" height="250"></canvas>

	<form action="<?=base_url('revision/post_trace')?>" method="post" id="form">
		<input type="hidden" name="id" value="<?=$kanji->id?>">
		<input type="hidden" name="image" id="image">
		<input type="hidden" name="json" id="json">
		<button type="button" id="back" class="btn btn-primary" onclick="window.location.href='<?=base_url('revision')?>'"><?=$this->lang->line('btn_back')?></button>
		<button type="button" id="new" class="btn btn-primary" onclick="location.reload();">↺</button>
		<button type="button" id="reset" class="btn btn-danger" onclick="resetCanvas()"><?=$this->lang->line('btn_reset')?></button>
		<button type="button" id="save" class="btn btn-success" onclick="validate()"><?=$this->lang->line('btn_validate')?></button>
	</form>

	<script src="<?=base_url('assets/js/trace.js')?>"></script>
</div>
<?php foreach ($series as $serie) { ?>
	<?php if(count($serie->kanjis) == 0) { ?>
		<h2><?=$serie->serie_name?> <?=$this->lang->line('msg_empty')?></h2>
	<?php } else { ?>
		<h2><a data-toggle="collapse" href="#collapse-<?=$serie->id?>" role="button" aria-expanded="true" aria-controls="collapse-<?=$serie->id?>"><?=$serie->serie_name?></a></h2>
		<div class="collapse show text-justify" id="collapse-<?=$serie->id?>">
			<button type="button" class="btn btn-outline-secondary" onclick="addSerie(<?=$serie->id?>);"><?=$this->lang->line('select_all')?></button>
			<button type="button" class="btn btn-outline-danger" onclick="addSRS(<?=$serie->id?>);"><?=$this->lang->line('srs')?></button><br>
			<?php foreach ($serie->kanjis as $kanji) { ?>
				<button type="button" id="kanji-<?=$kanji->id?>" class="btn <?=isset($_SESSION['to_train'][$kanji->id]) ? 'btn-success' : 'btn-outline-secondary'?> kanji-select<?=$kanji->srs?' srs':''?>" title="<?=$kanji->meaning?>" onclick="addKanji(<?=$kanji->id?>);"><?=$kanji->kanji?></button>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>
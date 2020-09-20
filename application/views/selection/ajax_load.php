<?php foreach ($categories as $category) { ?>
	<?php if(count($category->words) == 0) { ?>
		<h2><?=$category->cat_name?> <?=$this->lang->line('msg_empty')?></h2>
	<?php } else { ?>
		<h2><a data-toggle="collapse" href="#collapse-<?=$category->id?>" role="button" aria-expanded="true" aria-controls="collapse-<?=$category->id?>"><?=$category->cat_name?></a></h2>
		<div class="collapse show text-justify" id="collapse-<?=$category->id?>">
			<button type="button" class="btn btn-outline-secondary" onclick="addCategory(<?=$category->id?>);"><?=$this->lang->line('select_all')?></button>
			<button type="button" class="btn btn-outline-danger" onclick="addSRS(<?=$category->id?>);"><?=$this->lang->line('srs')?></button><br>
			<?php if(isset($category->words['kana'])) { ?>
				<div>Kana</div>
				<?php foreach ($category->words['kana'] as $kana) { ?>
					<button type="button" data-id="<?=$kana->fk_word?>" class="btn <?=isset($_SESSION['to_train'][$kana->fk_word]) ? 'btn-success' : 'btn-outline-secondary'?> word-select<?=$kana->srs ? ' srs' : ''?>" title="<?=$kana->romaji?>" onclick="addWord(<?=$kana->fk_word?>);"><?=$kana->kana?></button>
				<?php } ?>
			<?php } ?>
			<?php if(isset($category->words['kanji'])) { ?>
				<div>Kanji</div>
				<?php foreach ($category->words['kanji'] as $kanji) { ?>
					<button type="button" data-id="<?=$kanji->fk_word?>" class="btn <?=isset($_SESSION['to_train'][$kanji->fk_word]) ? 'btn-success' : 'btn-outline-secondary'?> word-select<?=$kanji->srs ? ' srs' : ''?>" title="<?=$kanji->meaning?>" onclick="addWord(<?=$kanji->fk_word?>);"><?=$kanji->kanji?></button>
				<?php } ?>
			<?php } ?>
			<?php if(isset($category->words['vocabulary'])) { ?>
				<div>Vocabulaire</div>
				<?php foreach ($category->words['vocabulary'] as $vocabulary) { ?>
					<button type="button" data-id="<?=$vocabulary->fk_word?>" class="btn <?=isset($_SESSION['to_train'][$vocabulary->fk_word]) ? 'btn-success' : 'btn-outline-secondary'?> word-select<?=$vocabulary->srs ? ' srs' : ''?>" title="<?=$vocabulary->translation?>" onclick="addWord(<?=$vocabulary->fk_word?>);"><?=$vocabulary->kanji_or_kana?></button>
				<?php } ?>
			<?php } ?>
			<?php if(isset($category->words['kdlt'])) { ?>
				<div>KDLT</div>
				<?php foreach ($category->words['kdlt'] as $kdlt) { ?>
					<button type="button" data-id="<?=$kdlt->fk_word?>" class="btn <?=isset($_SESSION['to_train'][$kdlt->fk_word]) ? 'btn-success' : 'btn-outline-secondary'?> word-select<?=$kdlt->srs ? ' srs' : ''?>" title="<?=$kdlt->keyword?>" onclick="addWord(<?=$kdlt->fk_word?>);"><?=$kdlt->kanji?></button>
				<?php } ?>
			<?php } ?>
			<?php if(isset($category->words['alphabet'])) { ?>
				<div>Lettres</div>
				<?php foreach ($category->words['alphabet'] as $alphabet) { ?>
					<button type="button" data-id="<?=$alphabet->fk_word?>" class="btn <?=isset($_SESSION['to_train'][$alphabet->fk_word]) ? 'btn-success' : 'btn-outline-secondary'?> word-select<?=$alphabet->srs ? ' srs' : ''?>" title="<?=$alphabet->kana?>" onclick="addWord(<?=$alphabet->fk_word?>);"><?=$alphabet->letter?></button>
				<?php } ?>
			<?php } ?>
		</div>
	<?php } ?>
<?php } ?>
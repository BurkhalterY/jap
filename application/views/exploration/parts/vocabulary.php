<h2><?=$this->lang->line('vocabulary')?></h2>
<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-vocabulary">Voir la liste</button>
<div class="modal fade" id="modal-vocabulary" tabindex="-1" role="dialog" aria-labelledby="modal-vocabulary" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Liste de vocabulaire</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<th><?=$this->lang->line('kanji')?></th>
						<th><?=$this->lang->line('kana')?></th>
						<th><?=$this->lang->line('translation')?></th>
					</tr>
					<?php foreach ($vocabulary as $value) { ?>
						<tr>
							<td><?=$value->kanji?></td>
							<td><?=$value->kana?></td>
							<td><?=$value->translation?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('btn_close')?></button>
			</div>
		</div>
	</div>
</div>
<div class="text-justify">
	<?php foreach ($vocabulary as $key => $value) { ?>
		<button type="button" class="btn btn-outline-success kanji-case" data-toggle="modal" data-target="#modal-vocabulary-<?=$value->id?>"><?=$value->kanji_or_kana?></button>
		<div class="modal fade" id="modal-vocabulary-<?=$value->id?>" tabindex="-1" role="dialog" aria-labelledby="modal-vocabulary-<?=$value->id?>" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title"><?=$value->kanji_or_kana?></h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<?php $l = empty($value->kanji) ? 6 : 4; ?>
							<?php if($l == 4){ ?>
								<div class="col-md-<?=$l?>">
									<h3><?=$this->lang->line('kanji')?> <img src="<?=base_url('assets/images/jp.png')?>" alt="🇯🇵" /></h3>
									<p><?=$value->kanji?></p>
								</div>
							<?php } ?>
							<div class="col-md-<?=$l?>">
								<h3><?=$this->lang->line('kana')?> <img src="<?=base_url('assets/images/jp.png')?>" alt="🇯🇵" /></h3>
								<p><?=$value->kana?></p>
							</div>
							<div class="col-md-<?=$l?>">
								<h3><?=$this->lang->line('translation')?> <img src="<?=base_url('assets/images/fr.png')?>" alt="🇫🇷" /></h3>
								<p><?=$value->translation?></p>
							</div>
						</div>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
							<hr>
							<textarea id="form-<?=$value->fk_word?>" class="form-control" placeholder="<?=$this->lang->line('field_note')?>"><?=$value->note??''?></textarea>
						<?php } ?>
					</div>
					<div class="modal-footer">
						<?php if($key > 0) { ?>
							<button type="button" class="btn btn-outline-success<?=$key == count($vocabulary) - 1 ? ' mr-auto' : ''?>" onclick="change('vocabulary-<?=$value->id?>', 'vocabulary-<?=$vocabulary[$key-1]->id?>');"><i class="fas fa-arrow-left"></i></button>
						<?php } ?>
						<?php if($key < count($vocabulary) - 1) { ?>
							<button type="button" class="btn btn-outline-success mr-auto" onclick="change('vocabulary-<?=$value->id?>', 'vocabulary-<?=$vocabulary[$key+1]->id?>');"><i class="fas fa-arrow-right"></i></button>
						<?php } ?>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
							<button type="button" class="btn btn-primary" onclick="addNote(<?=$value->id?>);"><?=$this->lang->line('btn_save')?></button>
						<?php } ?>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('btn_close')?></button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
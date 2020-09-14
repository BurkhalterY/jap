<h2><?=$this->lang->line('kanji')?></h2>
<div class="text-justify">
	<?php foreach ($kanji as $key => $value) { ?>
		<button type="button" class="btn btn-primary kanji-case" data-toggle="modal" data-target="#modal-kanji-<?=$value->id?>"><?=$value->kanji?></button>
		<div class="modal fade" id="modal-kanji-<?=$value->id?>" tabindex="-1" role="dialog" aria-labelledby="modal-kanji-<?=$value->id?>" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title"><?=$value->kanji?></h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<h3><?=$this->lang->line('kanji')?> <img src="<?=base_url('assets/images/jp.png')?>" alt="🇯🇵" /></h3>
								<p><?=$value->kanji?></p>
							</div>
							<div class="col-md-6">
								<h3><?=$this->lang->line('meaning')?> <img src="<?=base_url('assets/images/fr.png')?>" alt="🇫🇷" /></h3>
								<p><?=$value->meaning?></p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h3><?=$this->lang->line('onyomi')?></h3>
								<p><?=$value->onyomi?></p>
							</div>
							<div class="col-md-6">
								<h3><?=$this->lang->line('kunyomi')?></h3>
								<p><?=$value->kunyomi?></p>
							</div>
						</div>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
							<hr>
							<textarea id="form-<?=$value->fk_word?>" class="form-control" placeholder="<?=$this->lang->line('field_note')?>"><?=$value->note??''?></textarea>
						<?php } ?>
					</div>
					<div class="modal-footer">
						<?php if($key > 0) { ?>
							<button type="button" class="btn btn-outline-success<?=$key == count($kanji) - 1 ? ' mr-auto' : ''?>" onclick="change('kanji-<?=$value->id?>', 'kanji-<?=$kanji[$key-1]->id?>');"><i class="fas fa-arrow-left"></i></button>
						<?php } ?>
						<?php if($key < count($kanji) - 1) { ?>
							<button type="button" class="btn btn-outline-success mr-auto" onclick="change('kanji-<?=$value->id?>', 'kanji-<?=$kanji[$key+1]->id?>');"><i class="fas fa-arrow-right"></i></button>
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
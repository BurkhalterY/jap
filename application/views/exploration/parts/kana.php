<h2><?=$this->lang->line('kana')?></h2>
<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-kana">Voir la liste</button>
<div class="modal fade" id="modal-kana" tabindex="-1" role="dialog" aria-labelledby="modal-kana" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Liste des kana</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<th><?=$this->lang->line('romaji')?></th>
						<th><?=$this->lang->line('kana')?></th>
						<th><input type="checkbox"></th>
					</tr>
					<?php foreach ($kana as $value) { ?>
						<tr>
							<td><?=$value->romaji?></td>
							<td><?=$value->kana?></td>
							<td><input type="checkbox" name="check[<?=$value->fk_word?>]"></td>
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
	<?php foreach ($kana as $key => $value) { ?>
		<button type="button" class="btn btn-outline-success kanji-case" data-toggle="modal" data-target="#modal-kana-<?=$value->id?>"><?=$value->kana?></button>
		<div class="modal fade" id="modal-kana-<?=$value->id?>" tabindex="-1" role="dialog" aria-labelledby="modal-kana-<?=$value->id?>" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title"><?=$value->kana?></h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<h3><?=$this->lang->line('romaji')?> <img src="<?=base_url('assets/images/fr.png')?>" alt="🇫🇷" /></h3>
								<p><?=$value->romaji?></p>
							</div>
							<div class="col-md-6">
								<h3><?=$this->lang->line('kana')?> <img src="<?=base_url('assets/images/jp.png')?>" alt="🇯🇵" /></h3>
								<p><?=$value->kana?></p>
							</div>
						</div>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
							<hr>
							<textarea id="form-<?=$value->fk_word?>" class="form-control" placeholder="<?=$this->lang->line('field_note')?>"><?=$value->note??''?></textarea>
						<?php } ?>
					</div>
					<div class="modal-footer">
						<?php if($key > 0) { ?>
							<button type="button" class="btn btn-outline-success<?=$key == count($kana) - 1 ? ' mr-auto' : ''?>" onclick="change('kana-<?=$value->id?>', 'kana-<?=$kana[$key-1]->id?>');"><i class="fas fa-arrow-left"></i></button>
						<?php } ?>
						<?php if($key < count($kana) - 1) { ?>
							<button type="button" class="btn btn-outline-success mr-auto" onclick="change('kana-<?=$value->id?>', 'kana-<?=$kana[$key+1]->id?>');"><i class="fas fa-arrow-right"></i></button>
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
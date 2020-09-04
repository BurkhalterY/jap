<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$serie->serie_name?></h1>
<a href="<?=base_url('exploration/category/'.$serie->fk_category)?>" class="btn btn-outline-primary"><?=$this->lang->line('btn_back')?></a>
<button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#modal-list">Voir la liste</button>
<div class="modal fade" id="modal-list" tabindex="-1" role="dialog" aria-labelledby="modal-list" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title">Liste du vocabulaire</h2>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<table class="table">
					<tr>
						<th><?=$this->lang->line('meaning')?></th>
						<th><?=$this->lang->line('kanji')?></th>
						<th><?=$this->lang->line('kanas')?></th>
					</tr>
					<?php foreach ($kanjis as $kanji) { ?>
						<tr>
							<td><?=$kanji->meaning?></td>
							<td><?=$kanji->kanji?></td>
							<td><?=$kanji->kanas?></td>
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
	<?php foreach ($kanjis as $key => $kanji) { ?>
		<button type="button" class="btn btn-primary kanji-case" data-toggle="modal" data-target="#modal-<?=$kanji->id?>"><?=$kanji->kanji?></button>
		<div class="modal fade" id="modal-<?=$kanji->id?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?=$kanji->id?>" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title"><?=$kanji->kanji?></h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<h3><?=$this->lang->line('meaning')?> <img src="<?=base_url('assets/images/fr.png')?>" alt="🇫🇷" /></h3>
								<p><?=$kanji->meaning?></p>
							</div>
							<?php if(!empty($kanji->kanas)){?>
								<div class="col-md-6">
									<h3><?=$this->lang->line('kanas')?> <img src="<?=base_url('assets/images/jp.png')?>" alt="🇯🇵" /></h3>
									<p><?=$kanji->kanas?></p>
								</div>
							<?php } ?>
						</div>
						<?php if(!empty($kanji->global_note)) { ?>
						<hr>
							<p><strong><?=$this->lang->line('global_note')?> :<br></strong><?=$kanji->global_note?></p>
						<?php } ?>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
							<textarea id="form-<?=$kanji->id?>" class="form-control" placeholder="<?=$this->lang->line('field_note')?>"><?=$kanji->note??''?></textarea>
						<?php } ?>
					</div>
					<div class="modal-footer">
						<?php if($key > 0) { ?>
							<button type="button" class="btn btn-outline-success<?=$key == count($kanjis) - 1 ? ' mr-auto' : ''?>" onclick="change(<?=$kanji->id?>, <?=$kanjis[$key-1]->id?>);"><i class="fas fa-arrow-left"></i></button>
						<?php } ?>
						<?php if($key < count($kanjis) - 1) { ?>
							<button type="button" class="btn btn-outline-success mr-auto" onclick="change(<?=$kanji->id?>, <?=$kanjis[$key+1]->id?>);"><i class="fas fa-arrow-right"></i></button>
						<?php } ?>
						<?php if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) { ?>
							<button type="button" class="btn btn-primary" onclick="addNote(<?=$kanji->id?>);"><?=$this->lang->line('btn_save')?></button>
						<?php } ?>
						<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('btn_close')?></button>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
<script>
	function addNote(id) {
		$.ajax({
			method: "POST",
			url: "<?=base_url('revision/add_note')?>",
			data: {
				kanji: id,
				note: $('#form-'+id).val()
			}
		});
	}

	function change(current, next) {
		$('#modal-'+current).modal('toggle');
		$('#modal-'+next).modal('toggle');
	}
</script>
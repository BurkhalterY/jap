<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_choice_words')?></h1>
<a href="<?=base_url('revision')?>" class="btn btn-outline-primary"><?=$this->lang->line('btn_back')?></a>
<div class="row">
	<?php foreach ($categories as $category) { ?>
		<div class="col-md-4">
			<strong><?=$category->cat_name?></strong>
			<a data-toggle="modal" href="#modal-<?=$category->id?>">
				<img src="<?=base_url('assets/images/cat/'.$category->image)?>" alt="<?=$category->cat_name?>" class="img-fluid" />
			</a>
			<div class="modal fade" id="modal-<?=$category->id?>" tabindex="-1" role="dialog" aria-labelledby="modal-<?=$category->id?>" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h2 class="modal-title"><?=$category->cat_name?></h2>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body unloaded" id="content-<?=$category->id?>">
							<div class="d-flex justify-content-center">
								<div class="spinner-border" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal"><?=$this->lang->line('btn_close')?></button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			$('#modal-<?=$category->id?>').on('show.bs.modal', function (e) {
				let div = $('#content-<?=$category->id?>');
				if (div.hasClass('unloaded')) {
					$.ajax("<?=base_url('revision/selection_ajax/'.$category->id)?>").done(function(content) {
						div.html(content);
						div.removeClass('unloaded');
					});
				}
			});
		</script>
	<?php } ?>
</div>
<script>
	function addKanji(id) {
		let kanji = $('#kanji-'+id);
		let active = '';
		if(kanji.hasClass('btn-outline-secondary')){
			kanji.removeClass('btn-outline-secondary');
			kanji.addClass('btn-success');
			active = '/1';
		} else {
			kanji.removeClass('btn-success');
			kanji.addClass('btn-outline-secondary');
		}

		$.ajax("<?=base_url('revision/add_kanji_to_train')?>/"+id+"/"+active);
	}

	function addSerie(id) {
		let kanjis = $('#collapse-'+id+' > button.kanji-select');
		let active = '';
		if(kanjis.hasClass('btn-outline-secondary')){
			kanjis.removeClass('btn-outline-secondary');
			kanjis.addClass('btn-success');
			active = '/1';
		} else {
			kanjis.removeClass('btn-success');
			kanjis.addClass('btn-outline-secondary');
		}

		$.ajax("<?=base_url('revision/add_serie_to_train')?>/"+id+active);
	}

	function addSRS(id) {
		let disabledKanjis = $('#collapse-'+id+' > button.kanji-select');
		disabledKanjis.removeClass('btn-success');
		disabledKanjis.addClass('btn-outline-secondary');

		let kanjis = $('#collapse-'+id+' > button.srs');
		if(kanjis.hasClass('btn-outline-secondary')){
			kanjis.removeClass('btn-outline-secondary');
			kanjis.addClass('btn-success');
		}

		$.ajax("<?=base_url('revision/add_srs_to_train')?>/"+id);
	}
</script>
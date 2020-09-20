<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('title_choice_words')?></h1>
<a href="<?=base_url('revision')?>" class="btn btn-outline-primary"><?=$this->lang->line('btn_back')?></a>
<ul>
	<?php foreach ($categories as $category) { ?>
		<li>
			<a data-toggle="modal" href="#modal-<?=$category->id?>">
				<?=$category->cat_name?>
				<?php if(!empty($category->image)) { ?>
					<img src="<?=base_url('assets/images/'.$category->image)?>" alt="<?=$category->cat_name?>" class="img-fluid" />
				<?php } ?>
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
			<script>
				$('#modal-<?=$category->id?>').on('show.bs.modal', function (e) {
					let div = $('#content-<?=$category->id?>');
					if (div.hasClass('unloaded')) {
						$.ajax("<?=base_url('selection/ajax_load/'.$category->id)?>").done(function(content) {
							div.html(content);
							div.removeClass('unloaded');
						});
					}
				});
			</script>
		</li>
	<?php } ?>
</ul>
<script>
	function addWord(id) {
		let word = $("[data-id='"+id+"'");
		let active = '';
		if(word.hasClass('btn-outline-secondary')){
			word.removeClass('btn-outline-secondary');
			word.addClass('btn-success');
			active = '/1';
		} else {
			word.removeClass('btn-success');
			word.addClass('btn-outline-secondary');
		}
		$("[data-id='"+word.attr("data-id")+"'").attr("class", word.attr("class"));

		$.ajax("<?=base_url('selection/add_word_to_train')?>/"+id+"/"+active);
	}

	function addCategory(id) {
		let words = $('#collapse-'+id+' > button.word-select');
		let active = '';
		if(words.hasClass('btn-outline-secondary')){
			words.removeClass('btn-outline-secondary');
			words.addClass('btn-success');
			active = '/1';
		} else {
			words.removeClass('btn-success');
			words.addClass('btn-outline-secondary');
		}
		words.each(function(index){
			$("[data-id='"+$(this).attr("data-id")+"'").attr("class", $(this).attr("class"));
		});

		$.ajax("<?=base_url('selection/add_category_to_train')?>/"+id+active);
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

		$.ajax("<?=base_url('selection/add_srs_to_train')?>/"+id);
	}
</script>
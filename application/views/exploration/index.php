<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('')?></h1>
<ul>
	<?php foreach ($categories as $category) { ?>
		<li><a href="<?=base_url('exploration/index/'.$category->id)?>"><?=$category->cat_name?>
		<?php if(!empty($category->image)) { ?>
			<img src="<?=base_url('assets/images/'.$category->image)?>" alt="<?=$category->cat_name?>" class="img-fluid" />
		<?php } ?>
		</a></li>
	<?php } ?>
</ul>
<?php
	if(isset($kana)){ include 'parts/kana.php'; }
	if(isset($kanji)){ include 'parts/kanji.php'; }
	if(isset($vocabulary)){ include 'parts/vocabulary.php'; }
?>
<script>
	function addNote(id) {
		$.ajax({
			method: "POST",
			url: "<?=base_url('revision/add_note')?>",
			data: {
				word: id,
				note: $('#form-'+id).val()
			}
		});
	}

	function change(current, next) {
		$('#modal-'+current).modal('hide');
		$('#modal-'+next).modal('show');
	}
</script>
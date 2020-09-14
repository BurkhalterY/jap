<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<h1><?=$this->lang->line('')?></h1>
<ul>
	<?php foreach ($categories as $categorie) { ?>
		<li><a href="<?=base_url('exploration/index/'.$categorie->id)?>"><?=$categorie->cat_name?>
		<?php if(!empty($categorie->image)) { ?>
			<img src="<?=base_url('assets/images/'.$categorie->image)?>" alt="<?=$categorie->cat_name?>" class="img-fluid" />
		<?php } ?>
		</a></li>
	<?php } ?>
</ul>
<?php
	if(isset($kana)){ include 'parts/kana.php'; };
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
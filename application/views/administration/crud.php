<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<nav class="navbar navbar-expand-md navbar-light bg-light">
	<ul class="navbar-nav mr-auto">
		<li class="nav-item <?=is_active('/\/administration\/kana/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kana')?>">Kana</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/kanji/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kanji')?>">Kanji</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/vocabulary/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/vocabulary')?>">Vocabulaire</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/kdlt/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/kdlt')?>">KDLT</a>
		</li>
		<li class="nav-item <?=is_active('/\/administration\/alphabet/i') ? 'active' : ''?>">
			<a class="nav-link" href="<?=base_url('administration/alphabet')?>">Alphabet</a>
		</li>
	</ul>
</nav>

<?php foreach($crud->css_files as $file){ ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php } ?>
<?php foreach($crud->js_files as $file){ ?>
	<script src="<?php echo $file; ?>"></script>
<?php } ?>
<?=$crud->output?>

<br>
<form id="my-form" action="<?=base_url('administration/set_category')?>" method="POST">
	<select name="category">
		<?php foreach ($categories as $cat) { ?>
			<option value="<?=$cat->id?>"><?=$cat->cat_name?></option>
		<?php } ?>
	</select>
	<input type="submit">
</form>

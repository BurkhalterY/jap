<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php include 'admin_menu.php' ?>

<?php foreach($crud->css_files as $file){ ?>
	<link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php } ?>
<?php foreach($crud->js_files as $file){ ?>
	<script src="<?php echo $file; ?>"></script>
<?php } ?>
<?=$crud->output?>

<?php if(isset($categories)){ ?>
<br>
<form id="my-form" action="<?=base_url('administration/set_category')?>" method="POST">
	<select name="category">
		<?php foreach ($categories as $cat) { ?>
			<option value="<?=$cat->id?>"><?=$cat->cat_name?></option>
		<?php } ?>
	</select>
	<input type="submit">
</form>
<?php } ?>

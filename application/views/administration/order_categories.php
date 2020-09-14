<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php include 'admin_menu.php' ?><br>
<h1><?=isset($category) ? $category->cat_name : 'Root'?></h1>
<form method="POST">
	<ol id="sortable">
		<?php foreach ($categories as $cat) { ?>
			<li class="ui-state-default"><?=$cat->cat_name?><input type="hidden" name="order[]" value="<?=$cat->id?>"> <a href="<?=base_url('administration/order_categories/'.$cat->id)?>"><i class="fas fa-external-link-alt"></i></a></li>
		<?php } ?>
	</ol>
	<input type="submit" name="submit">
</form>
<script>
	$(function() {
		$("#sortable").sortable();
		$("#sortable").disableSelection();
	});
</script>
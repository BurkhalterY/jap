<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php include 'admin_menu.php' ?><br>
<h1><?=isset($category) ? $category->cat_name : 'Root'?></h1>
<form method="POST">
	<ol id="sortable">
		<?php foreach ($wordcat as $word) { ?>
			<li class="ui-state-default"><?=$word->denomination?><input type="hidden" name="order[]" value="<?=$word->id?>"></li>
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
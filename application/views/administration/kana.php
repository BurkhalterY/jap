<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<form action="<?=base_url('administration/set_category')?>" method="POST">
	<select name="category">
		<?php foreach ($categories as $cat) { ?>
			<option value="<?=$cat->id?>"><?=$cat->cat_name?></option>
		<?php } ?>
		<input type="submit" name="submit">
	</select>
	<table>
		<tr>
			<th>Rōmaji</th>
			<th>Kana</th>
		</tr>
		<?php foreach ($kana as $row) { ?>
			<tr>
				<td><?=$row->romaji?></td>
				<td><?=$row->kana?></td>
				<td><input type="checkbox" name="check[<?=$row->fk_word?>]"></td>
			</tr>
		<?php } ?>
	</table>
</form>
<script>
	var chkboxes = $('input:checkbox');
	var lastChecked = null;

	chkboxes.click(function(e) {
		if (!lastChecked) {
			lastChecked = this;
			return;
		}

		if (e.shiftKey) {
			var start = chkboxes.index(this);
			var end = chkboxes.index(lastChecked);

			chkboxes.slice(Math.min(start,end), Math.max(start,end) + 1).prop('checked', lastChecked.checked);
		}

		lastChecked = this;
	});
</script>
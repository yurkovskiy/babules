<!-- Categories index -->
<h2><?php echo __("Categories of expences")?></h2>
<div class="well">
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th><?php echo __("Name")?></th>
			<th><?php echo __("Description")?></th>
			<th><?php echo __("Management")?></th>
		</tr>
	</thead>
	<tbody>
		<?php
		$count = 1;
		if ($currentPage != 1)
		{
			$count = $itemsPerPage * ($currentPage - 1) + 1;			
		}
		foreach ($data as $category) {
			$edit_link = URL::site("categories/categories/edit")."/".$category->category_id;
			$view_link = URL::site("categories/categories/view")."/".$category->category_id;
			echo "<tr>\n";
			echo "<td>{$count} <!--[{$category->category_id}]--></td>\n";
			echo "<td>{$category->category_name}</td>\n";
			echo "<td>{$category->category_desc}</td>\n";
			echo "<td> <a class=\"btn\" href=\"{$edit_link}\" title=\"Редагувати\"><i class=\"icon-edit\"></i></a>
					  <a class=\"btn\" href=\"#\" onclick=\"delConfirm({$category->category_id})\" title=\"Видалити\"><i class=\"icon-remove\"></i></a></td>\n";
			echo "<script type=\"text/javascript\">\n$('#a_{$category->category_id}').popover();\n</script>\n";
			echo "</tr>\n";
			$count++;
		}
		?>
	</tbody>
</table>
</div>
<script type="text/javascript">
function delConfirm(record_id) {
	var confirmMessage = 'Ви дійсно хочете видалити запис #' + record_id;
	if (confirm(confirmMessage)) {
		var delLink = '<?php echo URL::site("categories/categories/del")."/";?>' + record_id;
		window.open(delLink, '_self');
		return false;
	}
	else {
		return false;
	}
}
</script>
<div class="pagination"><?php echo "{$page_links}\n" ?></div>
<a class="btn btn-primary" href="<?php echo URL::site("categories/categories/add")?>">Додати нову категорію</a>
<!-- /Categories index -->
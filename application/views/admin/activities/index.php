<!-- Activities index -->
<h2>Транзакції</h2>
<div class="well">
<div>
	<select id="category_id" name="category_id" onchange="filter()">
		<option value="">&lt;Фільтр по категоріям&gt;</option>
		<?php
		foreach ($categories as $key => $value)
		{
			echo "<option value=\"{$key}\">{$value}</option>\n";
		} 
		?>		
	</select>
	<script type="text/javascript">
	function filter()
	{
		var category_id = document.getElementById("category_id").value;
		if (category_id.length < 1) {
			return;
		}
		var rurl = '<?php echo URL::site("activities/activities/index")?>' +'/' + category_id;
		window.location = rurl;
	}
	</script>
	<?php if (isset($category_id)) { ?>
		<script type="text/javascript">
		document.getElementById("category_id").value = <?php echo $category_id?>
		</script>
	<?php } ?>
	<a style="margin-bottom: 9px;" class="btn btn-primary" href="<?php echo URL::site("activities/activities/add")?>">Додати нову транзакцію</a>
</div>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>Категорія</th>
			<th>Тип операції</th>
			<th>Сума</th>
			<th>Дата</th>
			<th>Опис</th>
			<th>Управління</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$count = 1;
		if ($currentPage != 1)
		{
			$count = $itemsPerPage * ($currentPage - 1) + 1;			
		}
		foreach ($data as $activity) {
			$edit_link = URL::site("activities/activities/edit")."/".$activity->activity_id;
			$view_link = URL::site("activities/activities/view")."/".$activity->activity_id;
			echo "<tr>\n";
			echo "<td>{$count}</td>\n";
			echo "<td>{$categories[$activity->category_id]}</td>\n";
			echo "<td>{$operationTypes[$activity->operation_type]}</td>\n";
			echo "<td>{$activity->activity_sum}</td>\n";
			echo "<td>{$activity->activity_date}</td>\n";
			echo "<td>{$activity->activity_desc}</td>\n";
			echo "<td><a class=\"btn\" href=\"{$edit_link}\" title=\"Редагувати\"><i class=\"icon-edit\"></i></a>
					  <a class=\"btn\" href=\"#\" onclick=\"delConfirm({$activity->activity_id})\" title=\"Видалити\"><i class=\"icon-remove\"></i></a></td>\n";
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
		var delLink = '<?php echo URL::site("activities/activities/del")."/";?>' + record_id;
		window.open(delLink, '_self');
		return false;
	}
	else {
		return false;
	}
}
</script>
<div class="pagination"><?php echo "{$page_links}\n" ?></div>
<a class="btn btn-primary" href="<?php echo URL::site("activities/activities/add")?>">Додати нову транзакцію</a>
<!-- /Activities index -->
<!-- Activities index [Search] -->
<h2>Операції [Результати пошуку]</h2>
<div class="alert alert-success">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<strong>Шаблон:</strong> <?php echo $pattern?>
	<strong>Кількість співпадінь:</strong> <?php echo $numberOfRecords?>
	<br><strong>Фільтр: </strong><span>
		<?php
			if (!is_null($category_ids))
			{ 
				foreach ($category_ids as $v)
				{
					echo "<b>|</b>{$categories[$v]}&nbsp;";
				}
			}
		?></span>
</div>
<div class="well">
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
		$sumOnPage = 0.0;
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
			$sumOnPage += $activity->activity_sum;
			$count++;
		}
		?>
		<tr class="info">
		    <td colspan="7"><strong>Сума на сторінці: <?php echo $sumOnPage?> грн.</strong></td>
		</tr>
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
<!-- /Activities index [Search] -->
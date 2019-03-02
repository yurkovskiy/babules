<!-- Activity edit form -->
<?php
$action = URL::base()."activities/activities/register";
$activity_id = 0;
$category_id = 0;
$operation_type = 0;
$activity_sum = null;
$activity_desc = null;
$activity_date = null;
if (isset($data)) {
	$action = URL::base()."activities/activities/update";
	foreach ($data as $activity) {
		$activity_id = $activity->activity_id;
		$category_id = $activity->category_id;
		$operation_type = $activity->operation_type;
		$activity_sum = $activity->activity_sum;
		$activity_desc = $activity->activity_desc;
		$activity_date = $activity->activity_date;
	}
}

?>
<script src="<?php echo URL::base();?>public/js/forms.js"></script>
<script src="<?php echo URL::base();?>public/js/calendar/calendar.js"></script>
<script src="<?php echo URL::base();?>public/js/calendar/calendar-en.js"></script>
<script src="<?php echo URL::base();?>public/js/calendar/calendar-setup.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo URL::base();?>public/js/calendar/css/calendar-blue.css">

<div class="container">
	<h3>Реєстрація/Редагування інформації про транзакції</h3>
	<div class="well">
	<!--<form class="form-horizontal" onsubmit="return checkForm(this)" action="<?php echo $action?>" method="POST" name="editform" id="editform">-->
	<form class="form-horizontal" action="<?php echo $action?>" method="POST" name="editform" id="editform">
		<input type="hidden" name="activity_id" id="activity_id" value="<?php echo $activity_id?>">
		
		<!-- category_id -->
		<div class="control-group">
			<label class="control-label" for="category_id">Назва категорії</label>
			<div class="controls">
				<select name="category_id">
					<?php
					foreach ($categories as $category)
					{
						echo "<option value=\"{$category->category_id}\">{$category->category_name}</option>\n";
					} 
					?>
				</select>
			</div>
		</div>
		<script type="text/javascript">
			document.forms[0].elements["category_id"].value = <?php echo $category_id?>;
		</script>
		<!--/category_id -->
		
		<!-- operation_type -->
		<div class="control-group">
			<label class="control-label" for="operation_type">Тип операції</label>
			<div class="controls">
				<select name="operation_type">
					<option value="0">Витрата</option>
					<option value="1">Спец. витрата</option>
				</select>
			</div>
		</div>
		
		<script type="text/javascript">
			document.forms[0].elements["operation_type"].value = <?php echo $operation_type?>;		
		</script>
		<!-- /operation_type -->
		
		<!-- activity_sum -->
		<div class="control-group">
			<label class="control-label" for="activity_sum">Сума</label>
			<div class="controls">
				<input class="input-mini" pattern="\d+(\.\d{2})?" type="text" placeholder="Введіть суму" id="activity_sum" name="activity_sum" value="<?php echo $activity_sum?>" required>
			</div>
		</div>
		<!--/activity_sum -->
				
		<!-- activity_desc -->
		<div class="control-group">
			<label class="control-label" for="activity_desc">Короткий опис</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" placeholder="Введіть опис транзакції" id="activity_desc" name="activity_desc" value="<?php echo $activity_desc?>" required>
			</div>
		</div>
		<!--/activity_desc -->
		
		<!-- activity_date -->
		<div class="control-group">
			<label class="control-label" for="activity_date">Дата YYYY-MM-DD</label>
			<div class="controls">
				<input type="text" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="дата транзакції" id="activity_date" name="activity_date" value="<?php echo $activity_date?>" required>
				<img src="<?php echo URL::base();?>public/js/calendar/css/img.gif" id="f_trigger_ad" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onmouseout="this.style.background=''">
				<script type="text/javascript">
				Calendar.setup({
			        inputField     :    "activity_date",     // id of the input field
			        ifFormat       :    "%Y-%m-%d",      // format of the input field
			        button         :    "f_trigger_ad",  // trigger for the calendar (button ID)
			        align          :    "",           // alignment (defaults to "Bl")
			        firstDay	   :	1,
			        singleClick    :    true,
			    });
				</script>
			</div>
		</div>
		<!--/activity_date -->
		
		<!-- Submit button -->
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit" value="send">Зберегти</button>
				<button type="reset" class="btn btn-primary" id="btn_reset" name="btn_reset" value="reset">Очистити</button>
			</div>
		</div>
		<!--/Submit button -->
	</form>
	</div>
</div>
<!-- /Activity edit form -->
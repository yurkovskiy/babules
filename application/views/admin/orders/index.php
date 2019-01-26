<!-- Order generation form -->
<?php
$action = URL::base()."activities/orders/view";
?>
<script src="<?php echo URL::base();?>public/js/calendar/calendar.js"></script>
<script src="<?php echo URL::base();?>public/js/calendar/calendar-en.js"></script>
<script src="<?php echo URL::base();?>public/js/calendar/calendar-setup.js"></script>

<link rel="stylesheet" type="text/css" href="<?php echo URL::base();?>public/js/calendar/css/calendar-blue.css">

<!-- checkDates function -->
<script type="text/javascript">
function checkDates(form) {
	var startDate = parseInt((form.elements["start_date"].value.split("-").join("")));
	var endDate = parseInt((form.elements["end_date"].value.split("-").join("")));
	if (startDate > endDate) {
		document.getElementsByClassName("alert")[0].style.display = "block";
		return false;
	}
	return true;
}
</script>
<!-- /checkDates function -->

<div class="container">
	<h3>Генератор звітів</h3>
	<div class="well">
	<form onsubmit="return checkDates(this)" class="form-horizontal" action="<?php echo $action?>" method="POST" name="editform" id="editform">	
	    <div class="alert alert-error" style="display: none">
      		<button type="button" class="close" data-dismiss="alert">&times;</button>
      		<strong>Помилка!</strong> Початкова дата є більшою за кінцеву.
    	</div>
			
		<!-- start_date -->
		<div class="control-group">
			<label class="control-label" for="start_date">Дата YYYY-MM-DD</label>
			<div class="controls">
				<input type="text" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="початкова дата" id="start_date" name="start_date" required>
				<img src="<?php echo URL::base();?>public/js/calendar/css/img.gif" id="f_trigger_sd" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onmouseout="this.style.background=''">
				<script type="text/javascript">
				Calendar.setup({
			        inputField     :    "start_date",     // id of the input field
			        ifFormat       :    "%Y-%m-%d",      // format of the input field
			        button         :    "f_trigger_sd",  // trigger for the calendar (button ID)
			        align          :    "",           // alignment (defaults to "Bl")
			        firstDay	   :    1,
			        singleClick    :    true
			    });
				</script>
			</div>
		</div>
		<!--/start_date -->
		
		<!-- end_date -->
		<div class="control-group">
			<label class="control-label" for="end_date">Дата YYYY-MM-DD</label>
			<div class="controls">
				<input type="text" pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" placeholder="кінцева дата" id="end_date" name="end_date" required>
				<img src="<?php echo URL::base();?>public/js/calendar/css/img.gif" id="f_trigger_ed" style="cursor: pointer; border: 1px solid red;" title="Date selector" onmouseover="this.style.background='red';" onmouseout="this.style.background=''">
				<script type="text/javascript">
				Calendar.setup({
			        inputField     :    "end_date",     // id of the input field
			        ifFormat       :    "%Y-%m-%d",      // format of the input field
			        button         :    "f_trigger_ed",  // trigger for the calendar (button ID)
			        align          :    "",           // alignment (defaults to "Bl")
			        firstDay	   :    1,
			        singleClick    :    true
			    });
				</script>
			</div>
		</div>
		<!--/end_date -->
		
		<!-- operation_type -->
		<div class="control-group">
			<label class="control-label" for="operation_type">Тип операції</label>
			<div class="controls">
				<select name="operation_type">
					<option value="0">Витрата</option>
					<option value="1">Дохід</option>
				</select>
			</div>
		</div>
		
		<!-- category_id -->
		<div class="control-group">
			<label class="control-label" for="category_id">Категорія</label>
			<div class="controls">
				<select name="category_id" onchange="catChange(this)">
					<option value="null"></option>
					<?php
					foreach ($categories as $category)
					{
						echo "<option value=\"{$category->category_id}\">{$category->category_name}</option>\n";
					}
					?>
				</select>
			</div>
			<script type="text/javascript">
			// change visibility of btn_graph button
			function catChange(element)
			{
				var btn_graph = document.getElementById("btn_graph");
				var val = element.value; // get value from <select>
				if (val == "null") 
				{
					btn_graph.style.visibility = "visible";
				}
				else
				{
					btn_graph.style.visibility = "hidden";
				}
			}
			</script>
		</div>
						
		<!-- Submit button -->
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-primary" id="btn_submit" name="btn_submit" value="send">Сума</button>
				<button type="reset" class="btn btn-primary" id="btn_reset" name="btn_reset" value="reset">Очистити</button>
				<button type="submit" class="btn btn-success" id="btn_graph" name="btn_graph" value="graph" >По категоріям</button>
				<button type="submit" class="btn btn-danger" id="btn_dynamic" name="btn_dynamic" value="dynamic" >По датам</button>
				<button type="submit" class="btn btn-warning" id="btn_dynamicyears" name="btn_dynamicyears" value="dynamicyears" >Динаміка витрат</button>
			</div>
		</div>
		<!--/Submit button -->
	</form>
	</div>
</div>
<!-- /Order generation form -->
<!-- Category edit form -->
<?php
$action = URL::base()."categories/categories/register";
$category_id = 0;
$category_name = null;
$category_desc = null;
if (isset($data)) {
	$action = URL::base()."categories/categories/update";
	foreach ($data as $category) {
		$category_id = $category->category_id;
		$category_name = $category->category_name;
		$category_desc = $category->category_desc;
	}
}

?>
<script src="<?php echo URL::base();?>public/js/forms.js"></script>

<div class="container">
	<h3>Реєстрація/Редагування інформації про категорію доходів / витрат</h3>
	<div class="well">
	<!--<form class="form-horizontal" onsubmit="return checkForm(this)" action="<?php echo $action?>" method="POST" name="editform" id="editform">-->
	<form class="form-horizontal" action="<?php echo $action?>" method="POST" name="editform" id="editform">
		<input type="hidden" name="category_id" id="category_id" value="<?php echo $category_id?>">
		
		<!-- Category name -->
		<div class="control-group">
			<label class="control-label" for="category_name">Назва категорії</label>
			<div class="controls">
				<input type="text" placeholder="Введіть назву категорії" id="category_name" name="category_name" value="<?php echo $category_name?>" required>
			</div>
		</div>
		<!--/Category name -->
		
		<!-- Category desc -->
		<div class="control-group">
			<label class="control-label" for="category_desc">Короткий опис</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" placeholder="Введіть опис категорії" id="category_desc" name="category_desc" value="<?php echo $category_desc?>">
			</div>
		</div>
		<!--/Category desc -->
		
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
<!-- /Category edit form -->
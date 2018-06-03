<?php
$action = $action = URL::base()."activities/activities/dosearch"; 
?>
<!-- Activity seacrh form -->
<script src="<?php echo URL::base();?>public/js/forms.js"></script>

<div class="container">
	<h3>Пошук операцій</h3>
	<div class="well">
	<form class="form-horizontal" action="<?php echo $action?>" method="POST" name="searchform" id="searchform">
		<!-- activity_desc -->
		<div class="control-group">
			<label class="control-label" for="activity_desc">Короткий опис</label>
			<div class="controls">
				<input class="input-xxlarge" type="text" placeholder="Введіть опис транзакції" id="activity_desc" name="activity_desc" required>
			</div>
		</div>
		<!--/activity_desc -->
		
		<!-- Submit button -->
		<div class="control-group">
			<div class="controls">
				<button type="submit" class="btn btn-success" id="btn_submit" name="btn_submit" value="send">Пошук</button>
				<button type="reset" class="btn btn-primary" id="btn_reset" name="btn_reset" value="reset">Очистити</button>
			</div>
		</div>
		<!--/Submit button -->
	</form>
	</div>
</div>
<!-- /Activity search form -->
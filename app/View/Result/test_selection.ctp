<div class="page-title" id="page-title">
	<div class="row">
		<div class="col-md-6">
			<h1><i class="fa fa-bar-chart-o"></i> <?php echo __("Test Results")?></h1>
			<h4></h4>
		</div>
	</div>
</div>

<div class="posts form">
	<form action method="post">
		<select class="form-control" name="test_id">
			<option value="0"><?php echo __("Select Test")?></option>
			<?php
			foreach ($allTest as $test) {
				echo " <option value ={$test['id']}>{$test['name']}</option > ";
			}
			?>
		</select>
		<input class="btn btn-large btn-primary" type="submit" value="Select"/>
	</form>
</div>
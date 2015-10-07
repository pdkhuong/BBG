<div class="page-title" id="page-title">
	<div class="row">
		<div class="col-md-6">
			<h1><i class="fa fa-bar-chart-o"></i> <?php echo __("Training Results")?></h1>
			<h4></h4>
		</div>
	</div>
</div>

<div class="posts form">
	<form action method="post">
		<select class="form-control" name="training_id">
			<option value="0"><?php echo __('Select a Training');?></option>
			<?php
			foreach ($allTraining as $training) {
				echo " <option value ={$training['ItrainerTraining']['id']}>{$training['ItrainerTraining']['name']}</option > ";
			}
			?>
		</select>
		<input class="btn btn-large btn-primary" type="submit" value="Select"/>
	</form>
</div>

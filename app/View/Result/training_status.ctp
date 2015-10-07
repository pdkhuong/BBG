<div class="page-title" id="page-title">
	<div class="row">
		<div class="col-md-6">
			<h1><i class="fa fa-bar-chart-o"></i> <?php echo __("Training Status")?></h1>
			<h4></h4>
		</div>
	</div>
</div>

<label for="training_id"><?php echo __('Select a training')?></label>
<select class="form-control" id="select_training_id">
	<option value="0" <?=(!isset($selectedTraining)) ? 'selected="selected"' : ''?>>
		<?php echo __('Select a Training');?>
	</option>
	<?php foreach ($allTraining as $training) { ?>
		<option value=<?= $training['ItrainerTraining']['id'] ?>
			<?=(isset($selectedTraining) && $selectedTraining["ItrainerTraining"]["id"] == $training['ItrainerTraining']['id'])
			? 'selected="selected' : ''?>>
			<?=$training['ItrainerTraining']['name']?>
		</option> ";
	<?php }?>
</select>

<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="block-title">
				<h3><i class="fa fa-bars"></i> <?php echo __('Active users') ?>
				</h3>
			</div>
			<div class="block-body" data-training_id_controller="#select_training_id" id="tbl_active_users"
					 data-data_url="<?=Router::url(
						 array(
							 'controller' => 'Result',
							 'action' => 'trainingstatusresult',
							 '?' => array(
								 'training_id' => '#training_id#',
							 )
						 )
					 )?>">
				<div class="table-responsive">
					<table class="table table-advance">
						<thead>
						<tr>
							<th class="col-sm-2"><?php echo __('Online Status') ?></th>
							<th class="col-sm-6"><?php echo __('User') ?></th>
							<th class="col-sm-4"><?php echo __('Last Access') ?></th>
						</tr>
						</thead>
						<tbody id="tbl_active_users_result">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	(function ($) {
		$(document).ready(function () {
			$('#tbl_active_users').on('refreshValue', function () {
				var me = this;
				training_id_controller = $(me).data('training_id_controller');
				training_id = $(training_id_controller).val();
				requestUrl = $(me).data('data_url');
				requestUrl = requestUrl.replace('%23training_id%23', training_id);
				$.ajax({
					url: requestUrl,
					success: function (d) {
						d = JSON.parse(d);
						var html = "";
						for (var i = 0; i < d.users.length; i++) {
							html += "<tr>";
							html += "<td></td>";
							html += "<td>" + d.users[i].name + "</td>";
							html += "<td>" + d.users[i].last_access + "</td>";
							html += "</tr>";
						}
						$('#tbl_active_users_result').html(html);
					}
				});
			});
			$('#select_training_id').on('change', function () {
				$('#tbl_active_users').trigger('refreshValue');
			});

			var timer = window.setInterval(function () {
				if ($('#select_training_id').val() != 0)
					$('#tbl_active_users').trigger('refreshValue');
			}, 5000);
		});
	})(jQuery);
</script>
<?php
echo $this->Html->script('sfreport', array('inline' => false));
?>

<div class="page-title" id="page-title">
	<div class="row">
		<div class="col-md-6">
			<h1><i class="fa fa-bar-chart-o"></i> <?php echo __(
					"Feedback Results: "
				) . $feedback['ItrainerTraining']['name'] ?></h1>
			<h4></h4>
		</div>
		<div class="col-md-6 text-right">
			<?php
			echo $this->Html->link(
				__('Download CSV'),
				Router::url(
					array('controller' => 'Result', 'action' => 'outputCsv', '?' => array('filename' => 'happysheet'))
				),
				array('class' => 'btn btn-inveser')
			);
			echo "\n";
			echo $this->Html->link(
				__('Download PDF'),
				Router::url(
					array(
						'controller' => 'Result',
						'action' => 'feedback',
						'?' => array(
							'feedback_id' => $feedback['ItrainerTraining']['id'],
							'render_type' => 'pdf'
						)
					)
				),
				array('class' => 'btn btn-inveser', 'target' => '_blank')
			);
			?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="block-title">
				<h3><i class="fa fa-bars"></i> <?php echo __('Summary') ?></h3>
			</div>
			<div class="block-body">
				<div class="table-responsive">
					<table class="table table-advance">
						<tr>
							<td class="col-sm-10"><?php echo __('Sent feedback forms')?></td>
							<td class="col-sm-2 text-right"
									id="FeedbackTotal_TotalFeedback"><?=$result['FeedbackTotal']['TotalFeedback']?></td>
						</tr>
						<tr>
							<td><?php echo __('Total result')?></td>
							<td class="text-right"
									id="FeedbackTotal_AverageResult"><?=$result['FeedbackTotal']['AverageResult']?></td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="block-title">
				<h3><i class="fa fa-list-ul"></i> <?php echo __('Results') ?></h3>
			</div>
			<?php
			foreach ($questionList as $category) {
				?>
				<div class="block-body">
					<div class="table-responsive">
						<table class="table table-advance">
							<thead>
							<tr>
								<th class="col-sm-6"><?=$category['ItrainerFeedbackCategory']['name']?></th>
								<th class="col-sm-1 text-right">1</th>
								<th class="col-sm-1 text-right">2</th>
								<th class="col-sm-1 text-right">3</th>
								<th class="col-sm-1 text-right">4</th>
								<th class="col-sm-2 text-right"
										id="catsum<?= $category['ItrainerFeedbackCategory']['id'] ?>">
									Ø <?=$result['CategoryTotal'][$category['ItrainerFeedbackCategory']['id']]?></th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($category['children'] as $question) {
								?>
								<tr>
									<td><?=$question['ItrainerFeedbackQuestion']['name']?></td>
									<td class="text-right"
											id="question<?= $question['ItrainerFeedbackQuestion']['id'] ?>_1"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count1']?></td>
									<td class="text-right"
											id="question<?= $question['ItrainerFeedbackQuestion']['id'] ?>_2"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count2']?></td>
									<td class="text-right"
											id="question<?= $question['ItrainerFeedbackQuestion']['id'] ?>_3"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count3']?></td>
									<td class="text-right"
											id="question<?= $question['ItrainerFeedbackQuestion']['id'] ?>_4"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count4']?></td>
									<td class="text-right"
											id="question<?= $question['ItrainerFeedbackQuestion']['id'] ?>_Total">
										Ø <?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['AverageResult']?></td>
								</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="block-title">
				<h3><i class="fa fa-comments"></i> <?php echo __('Comments') ?></h3>
			</div>
			<div class="block-body">
				<div class="table-responsive">
					<table class="table table-advance">
						<thead>
						<tr>
							<th class="col-sm-6"><?php echo __('Personal Data')?></th>
							<th class="col-sm-6"><?php echo __('Comment')?></th>
						</tr>
						</thead>
						<tbody>
						<?php
						foreach ($comments as $comment) {
							$user = $comment['ItrainerFeedbackUser'];
							$cmt = $comment['ItrainerFeedbackComment'];
							?>
							<tr>
								<td><?=(isset($user['is_anonymously']) && $user['is_anonymously'] == 0 && isset($user['first_name']) && isset($user['surname'])) ? $$user['first_name'] . " " . $user['surname'] : "Anonymous"?></td>
								<td><?=$cmt['comment']?></td>
							</tr>
						<?php
						}
						?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>



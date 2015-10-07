<div class="page-title" id="page-title">
	<div class="row">
		<div class="col-md-6">
			<h1><i class="fa fa-bar-chart-o"></i>
				<?php echo __("Test Results: ")
					. $test['ItrainerTraining']['name'] ?></h1>
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
						'action' => 'test',
						'?' => array(
							'test_id' => $test['ItrainerTraining']['id'],
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
						<thead>
						<tr>
							<th class="col-sm-6"></th>
							<th class="col-sm-2 text-right"><?php echo __('Pre-Test') ?></th>
							<th class="col-sm-2 text-right"><?php echo __('Post-Test') ?></th>
							<th class="col-sm-2 text-right"><?php echo __('Difference') ?></th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td><?php echo __('Sent tests')?></td>
							<td id="TestTotal_TotalPreTest" class="text-right"><?=$result['TestTotal']['NumPreTestSent']?></td>
							<td id="TestTotal_TotalPostTest" class="text-right"><?=$result['TestTotal']['NumPostTestSent']?></td>
							<td class="text-right"></td>
						</tr>
						<tr>
							<td><?php echo __('Average points of all users')?></td>
							<td id="TestTotal_AvgPreTest" class="text-right"><?=$result['TestTotal']['AveragePreTest']?></td>
							<td id="TestTotal_AvgPostTest" class="text-right"><?=$result['TestTotal']['AveragePostTest']?></td>
							<td class="text-right"
									id="TestTotal_AvgPostTestDiff"><?=$result['TestTotal']['AveragePostTest'] - $result['TestTotal']['AveragePreTest']?></td>
						</tr>
						<tr>
							<td><?php echo __('Possible Points')?></td>
							<td id="TestTotal_MaxPreTest" class="text-right"><?=$result['TestTotal']['PossiblePoint']?></td>
							<td id="TestTotal_MaxPostTest" class="text-right"><?=$result['TestTotal']['PossiblePoint']?></td>
							<td class="text-right"></td>
						</tr>
						<tr>
							<td><?php echo __('Average results of all users in %')?></td>
							<td id="TestTotal_AvgPercenPreTest"
									class="text-right"><?=$result['TestTotal']['PossiblePoint'] > 0 ? round(
									100 * $result['TestTotal']['AveragePreTest'] / $result['TestTotal']['PossiblePoint']
								) : "0" . '%'?></td>
							<td id="TestTotal_AvgPercentPostTest"
									class="text-right"><?=$result['TestTotal']['PossiblePoint'] > 0 ? round(
									100 * $result['TestTotal']['AveragePostTest'] / $result['TestTotal']['PossiblePoint']
								) : "0" . '%'?></td>
							<td
								id="TestTotal_AvgPercentPostTestDiff"
								class="text-right"><?=$result['TestTotal']['PossiblePoint'] > 0 ? (round(
									100 * $result['TestTotal']['AveragePostTest'] / $result['TestTotal']['PossiblePoint']
								) - round(
									100 * $result['TestTotal']['AveragePreTest'] / $result['TestTotal']['PossiblePoint']
								)) : "0" . '%'?></td>
						</tr>
						</tbody>
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
				<h3><i class="fa fa-bars"></i> <?php echo __('TOP 10 Pre-Test') ?></h3>
			</div>
			<div class="block-body">
				<div class="table-responsive">
					<table class="table table-advance">
						<thead>
						<tr>
							<th class="col-sm-1"></th>
							<th class="col-sm-4"><?php echo __('Name') ?></th>
							<th class="col-sm-1 text-right"><?php echo __('Points') ?></th>
							<th class="col-sm-7"></th>
						</tr>
						</thead>
						<tbody>
						<?php
						for ($i = 0; $i < count($result['TopResult']['TopPreTest']); $i++) {
							$userResult = $result['TopResult']['TopPreTest'][$i];
							?>
							<tr>
								<td id="Top10PreTest_Order<%= $i + 1 %>" class="text-right"><?=$i?></td>
								<td id="Top10PreTest_Name<%= $i %>"><?=$userResult['name']?></td>
								<td id="Top10PreTest_Mark<%= $i %>" class="text-right"><?=$userResult['mark']?></td>
								<td></td>
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

<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="block-title">
				<h3><i class="fa fa-bars"></i> <?php echo __('TOP 10 Post-Test') ?></h3>
			</div>
			<div class="block-body">
				<div class="table-responsive">
					<table class="table table-advance">
						<thead>
						<tr>
							<th class="col-sm-1"></th>
							<th class="col-sm-4"><?php echo __('Name') ?></th>
							<th class="col-sm-1 text-right"><?php echo __('Points') ?></th>
							<th class="col-sm-7"></th>
						</tr>
						</thead>
						<tbody>
						<?php
						for ($i = 0; $i < count($result['TopResult']['TopPostTest']); $i++) {
							$userResult = $result['TopResult']['TopPostTest'][$i];
							?>
							<tr>
								<td id="Top10PostTest_Order<%= $i %>" class="text-right"><?=$i?></td>
								<td id="Top10PostTest_Name<%= $i %>"><?=$userResult['name']?></td>
								<td id="Top10PostTest_Mark<%= $i %>" class="text-right"><?=$userResult['mark']?></td>
								<td></td>
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

<div class="row">
	<div class="col-md-12">
		<div class="block">
			<div class="block-title">
				<h3><i class="fa fa-list-ul"></i> <?php echo __('Results') ?></h3>
			</div>
			<?php
			foreach ($answerList as $question) {
				?>
				<div class="block-body">
					<div class="table-responsive">
						<table class="table">
							<thead>
							<tr>
								<th class="col-sm-6"><?=$question['QuestionnaireQuestion']['name']?></th>
								<th class="col-sm-2 text-right"><?php echo __('Pre-Test') ?></th>
								<th class="col-sm-2 text-right"><?php echo __('Post-Test') ?></th>
								<th class="col-sm-2 text-right"><?php echo __('Difference') ?></th>
							</tr>
							</thead>
							<tbody>
							<?php
							foreach ($question['children'] as $answer) {
								$preTestCount = isset($result['AnswerResult']['PreTest'][$answer['QuestionnaireAnswer']['id']])
									? $result['AnswerResult']['PreTest'][$answer['QuestionnaireAnswer']['id']]['count'] : 0;
								$postTestCount = isset($result['AnswerResult']['PostTest'][$answer['QuestionnaireAnswer']['id']])
									? $result['AnswerResult']['PostTest'][$answer['QuestionnaireAnswer']['id']]['count'] : 0;

								$preTestTotal = $result['TestTotal']['NumPreTestSent'];
								$postTestTotal = $result['TestTotal']['NumPostTestSent'];
								if ($preTestTotal > 0) {
									$preTestPercent = 100 * $preTestCount / $preTestTotal;
									$postTestPercent = 100 * $postTestCount / $postTestTotal;
								} else {
									$preTestPercent = 0;
									$postTestPercent = 0;
								}
								if (isset($answer['QuestionnaireAnswer']['is_true']) && $answer['QuestionnaireAnswer']['is_true'] == 1) {
									$isTrue = true;
								} else {
									$isTrue = false;
								}
								?>
								<tr class="<?= ($isTrue ? "success" : "danger") ?>">
									<td><?=$answer['QuestionnaireAnswer']['answer']?></td>
									<td class="text-right"
											id="question<?= $answer['QuestionnaireAnswer']['id'] ?>_PreTest"><?=$preTestPercent . '%'?></td>
									<td class="text-right"
											id="question<?= $answer['QuestionnaireAnswer']['id'] ?>_PostTest"><?=$postTestPercent . '%'?></td>
									<td class="text-right"
											id="question<?= $answer['QuestionnaireAnswer']['id'] ?>_Different"><?=($postTestPercent - $preTestPercent) . '%'?></td>
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

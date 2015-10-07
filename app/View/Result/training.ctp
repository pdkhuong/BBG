<?php
echo $this->Html->script('trainingresult', array('inline' => false));
echo $this->Html->css('trainingresult', array('inline' => false));
$totalLogin = $result['maxResponseCount'];
$sentResult = $result['currentResponseCount'];
?>

	<div class="page-title" id="page-title">
		<div class="row">
			<div class="col-md-6">
				<h1><i class="fa fa-bar-chart-o"></i> <?php echo __(
						"Training Results: "
					) . $training['ItrainerTraining']['name'] ?></h1>
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
							'action' => 'training',
							'?' => array(
								'training_id' => $training['ItrainerTraining']['id'],
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
				<div class="block-body">
					<div><?php echo __(
							'Date: '
						) . $training['ItrainerTraining']['start_date'] . " - " . $training['ItrainerTraining']['end_date']?> </div>
				</div>
				<button id="btn_interim" class="btn btn-primary show"><?php echo __('Show interim results')?></button>
				<div class="block-body">
					<div><?php echo __('Sent results: ') . $sentResult . __(' of ') . $totalLogin?> </div>
				</div>
			</div>
		</div>
	</div>

	<ul class="nav nav-tabs">
		<?php
		$i = 0;
		foreach ($models as $modelId => $model) {
			?>
			<li class="<?= $i == 0 ? "active" : "" ?>"><a
					href="#resultModel_<?= $modelId ?>"
					data-toggle="tab"><?=$model['model']['info']['ItrainerModel']['name']?></a></li>
			<?php
			$i++;
		}
		?>
	</ul>

	<div class="tab-content">
	<?php
	$i = 0;
	foreach ($models as $modelId => $model) {
		$categoryClassName = "category_" . $modelId;
		$criteriaClassName = "criteria_" . $modelId;
		$bothClassName = "category_criteria_" . $modelId;
		?>
		<!--Assessment result-->
		<div class="tab-pane <?= $i == 0 ? "active" : "" ?>" id="resultModel_<?= $modelId ?>">
		<!--List of model and comparison models-->
		<div class="row">
			<div class="col-md-12">
				<div class="block">
					<div class="block-body">
						<div class="col-sm-3">
							<img src="<?= $model['model']['image'] ?>"/>
							<br>
							<span><?=$model['model']['info']['ItrainerModel']['name']?></span>
						</div>
						<div class="col-sm-3 text-center">
							<span><?php echo __('VS')?></span>
						</div>

						<?php
						foreach ($model['competitors'] as $competitorId => $competitor) {
							?>
							<div class="col-sm-3">
								<img src="<?= $competitor['image'] ?>"/>
								<br>
								<span><?=$competitor['info']['ItrainerModel']['name']?></span>
							</div>
						<?php
						}
						?>
						<div class="clear:both"></div>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-inverser showCollapse" data-target=".<?= $categoryClassName ?>">
			<?php echo __('Open all main categories')?>
		</button>
		<button class="btn btn-inverser showCollapse" data-target=".<?= $bothClassName ?>">
			<?php echo __('Open all')?>
		</button>
		<button class="btn btn-inverser hideCollapse" data-target=".<?= $bothClassName ?>">
			<?php echo __('Close all')?>
		</button>
		<button class="btn btn-inverser hideCollapse" data-target=".<?= $criteriaClassName ?>">
			<?php echo __('Close all subcategories')?>
		</button>
		<?php
		foreach ($criteriaList as $category) {
			$cat = $category['ItrainerTrainingCategory'];
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="block">
						<div class="block-title" data-toggle="collapse"
								 data-target="#<?= $categoryClassName ?>_<?= $cat['id'] ?>">
							<h3><i class="fa fa-ellipsis-v"></i>
								<a class="title" data-toggle="collapse"
									 href="#<?= $categoryClassName ?>_<?= $cat['id'] ?>"><?=$cat['name']?></a>
							</h3>
						</div>
						<div class="block-body <?= $categoryClassName ?> <?= $bothClassName ?> collapse"
								 id="<?= $categoryClassName ?>_<?= $cat['id'] ?>">
							<img src="/img/wait.gif" data-realsrc="<?=Router::url(
								array(
									'controller' => 'Result',
									'action' => 'trainingResultImage',
									'?' => array(
										'category_id' => $cat['id'],
										'chart_type' => 'stack',
										'training_id' => $training['ItrainerTraining']['id'],
										'model_id' => $modelId
									)
								)
							)?>"/>
							<?php foreach ($category["children"] as $criteria) {
								$c = $criteria['ItrainerTrainingCriteria'];
								?>
								<div class="col-md-12">
									<div class="block">
										<div class="block-title" data-toggle="collapse"
												 data-target="#criteria_<?= $modelId ?>_<?= $c['id'] ?>">
											<h3><i class="fa fa-bars"></i>
												<a class="title" data-toggle="collapse"
													 href="#criteria_<?= $modelId ?>_<?= $c['id'] ?>"><?=$c['name']?></a>
											</h3>
										</div>
										<div class="block-body <?= $criteriaClassName ?> <?= $bothClassName ?> collapse"
												 id="criteria_<?= $modelId ?>_<?= $c['id'] ?>">
											<div class="col-md-12">
												<img src="/img/wait.gif" data-realsrc="<?=Router::url(
													array(
														'controller' => 'Result',
														'action' => 'trainingResultImage',
														'?' => array(
															'criteria_id' => $c['id'],
															'chart_type' => 'stack',
															'training_id' => $training['ItrainerTraining']['id'],
															'model_id' => $modelId
														)
													)
												)?>"/>
											</div>
											<button class="btn btn-inverser hideCollapse"
															data-target="#criteria_<?= $modelId ?>_<?= $cat['id'] ?>">
												<?php echo __('Close')?>
											</button>
											<button class="btn btn-inverser hideCollapse" data-target=".<?= $bothClassName ?>">
												<?php echo __('Close all')?>
											</button>
											<a class="btn btn-inverser" href="#top">
												<?php echo __('Top')?>
											</a>
										</div>

									</div>
								</div>
							<?php }?>
							<button class="btn btn-inverser hideCollapse"
											data-target="#<?= $categoryClassName ?>_<?= $cat['id'] ?>">
								<?php echo __('Close')?>
							</button>
							<button class="btn btn-inverser hideCollapse" data-target=".<?= $bothClassName ?>">
								<?php echo __('Close all')?>
							</button>
							<a class="btn btn-inverser" href="#top">
								<?php echo __('Top')?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		foreach ($categoryComparisonList as $categoryCompare) {
			$cat1 = $categoryCompare['left']['ItrainerTrainingCategory'];
			$cat2 = $categoryCompare['right']['ItrainerTrainingCategory'];
			?>
			<div class="row">
				<div class="col-md-12">
					<div class="block">
						<div class="block-title" data-toggle="collapse"
								 data-target="#categorycompare_<?= $modelId ?>_<?= $cat1['id'] ?>_<?= $cat2['id'] ?>">
							<h3><i class="fa fa-ellipsis-v"></i>
								<a class="title" data-toggle="collapse"
									 href="#categorycompare_<?= $modelId ?>_<?= $cat1['id'] ?>_<?= $cat2['id'] ?>">
									<?=$cat1['name'] . __(' vs. ') . $cat2['name']?>
								</a></h3>
						</div>
						<div class="block-body <?= $categoryClassName ?> <?= $bothClassName ?> collapse"
								 id="categorycompare_<?= $modelId ?>_<?= $cat1['id'] ?>_<?= $cat2['id'] ?>">
							<div class="col-md-12">
								<img src="/img/wait.gif" data-realsrc="<?=Router::url(
									array(
										'controller' => 'Result',
										'action' => 'trainingResultImage',
										'?' => array(
											'category_1_id' => $cat1['id'],
											'category_2_id' => $cat2['id'],
											'chart_type' => 'scatter',
											'training_id' => $training['ItrainerTraining']['id'],
											'model_id' => $modelId
										)
									)
								)?>"/>
							</div>
							<button class="btn btn-inverser hideCollapse"
											data-target="#<?= $categoryClassName ?>_<?= $cat['id'] ?>">
								<?php echo __('Close')?>
							</button>
							<button class="btn btn-inverser hideCollapse" data-target=".<?= $bothClassName ?>">
								<?php echo __('Close all')?>
							</button>
							<a class="btn btn-inverser" href="#top">
								<?php echo __('Top')?>
							</a>
						</div>
					</div>
				</div>
			</div>
		<?php
		}
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="block">
					<div class="block-title" data-toggle="collapse"
							 data-target="#participantonevaluation_<?= $modelId ?>">
						<h3><i class="fa fa-ellipsis-v"></i>
							<a class="title" data-toggle="collapse"
								 href="#participantonevaluation_<?= $modelId ?>">
								<?php echo __('Participation on evaluation')?></a></h3>
					</div>
					<div class="block-body <?= $criteriaClassName ?> <?= $bothClassName ?> collapse"
							 id="participantonevaluation_<?= $modelId ?>">
						<div class="block">
							<div class="block-title">
								<h3><i class="fa fa-ellipsis-v"></i>
									<?php echo __('Proportion of participants that evaluated this criterion:')?></h3>
							</div>
							<div class="block-body">
								<div class="table-responsive">
									<table class="table">
										<thead>
										<tr>
											<th class="col-sm-1"></th>
											<th class="col-sm-1"><?=$model['model']['info']['ItrainerModel']['name']?></th>
											<?php foreach ($model['competitors'] as $competitor) { ?>
												<th class="col-sm-1"><?=$competitor['info']['ItrainerModel']['name']?></th>
											<?php }?>
										</tr>
										</thead>
										<tbody>
										<?php foreach ($criteriaList as $category) {
											$categoryId = $category['ItrainerTrainingCategory']['id'];
											$comparisonResult = $result['participant'][$modelId];
											?>
											<tr class="warning">
												<td class="first col-sm-1"><?=$category['ItrainerTrainingCategory']['name']?></td>
												<td class="col-sm-1 text-right"><?php
													$val = min($comparisonResult[$model['model']['info']['ItrainerModel']['id']][$categoryId]);
													if ($sentResult == 0) {
														echo "0%";
													} else {
														echo (100 * $val / $sentResult) . '%';
													}
													?></td>
												<?php foreach ($model['competitors'] as $competitor) { ?>
													<td class="col-sm-1 text-right"><?php
														$val = min($comparisonResult[$competitor['info']['ItrainerModel']['id']][$categoryId]);
														if ($sentResult == 0) {
															echo "0%";
														} else {
															echo (100 * $val / $sentResult) . '%';
														}
														?></td>
												<?php }?>
											</tr>
											<?php foreach ($category['children'] as $criteria) {
												$criteriaId = $criteria['ItrainerTrainingCriteria']['id'];
												?>
												<tr>
													<td class="first col-sm-1"><?=$criteria['ItrainerTrainingCriteria']['name']?></td>
													<td class="col-sm-1 text-right"><?php
														$val = $comparisonResult[$model['model']['info']['ItrainerModel']['id']][$categoryId][$criteriaId];
														if ($sentResult == 0) {
															echo "0%";
														} else {
															echo (100 * $val / $sentResult) . '%';
														}
														?></td>
													<?php foreach ($model['competitors'] as $competitor) { ?>
														<td class="col-sm-1 text-right"><?php
															$val = $comparisonResult[$competitor['info']['ItrainerModel']['id']][$categoryId][$criteriaId];
															if ($sentResult == 0) {
																echo "0%";
															} else {
																echo (100 * $val / $sentResult) . '%';
															}
															?></td>
													<?php }?>
												</tr>
											<?php } ?>
										<?php }?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<button class="btn btn-inverser hideCollapse" data-target="#participantonevaluation_<?= $modelId ?>">
							<?php echo __('Close')?>
						</button>
						<button class="btn btn-inverser hideCollapse" data-target=".<?= $bothClassName ?>">
							<?php echo __('Close all')?>
						</button>
						<a class="btn btn-inverser" href="#top">
							<?php echo __('Top')?>
						</a>
					</div>
				</div>
			</div>
		</div>
		<button class="btn btn-inverser showCollapse" data-target=".<?= $bothClassName ?>">
			<?php echo __('Open all')?>
		</button>
		<button class="btn btn-inverser hideCollapse" data-target=".<?= $bothClassName ?>">
			<?php echo __('Close all')?>
		</button>
		<a class="btn btn-inverser" href="#top">
			<?php echo __('Top')?>
		</a>
		</div>
		<?php $i++;
	}?>
	</div>

<?php
?>
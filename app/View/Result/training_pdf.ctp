<?php
$totalLogin = $result['maxResponseCount'];
$sentResult = $result['currentResponseCount'];

// prepare the cached image folder
$imageUrlFolder = "img/report_cached/$folderName/";
ob_start();
?>
<div class="pages">
<?php
// ####################
// CREATE INTRO
// ####################
?>
<div class="page-intro">
	<table class="user-infos">
		<tr>
			<td><?=__('Training')?></td>
			<td><?=$training['ItrainerTraining']['name']?></td>
		</tr>
		<tr>
			<td><?=__('Training Key')?></td>
			<td><?=$training['ItrainerTraining']['key_login']?></td>
		</tr>
		<tr>
			<td><?=__('Date')?></td>
			<td><?=$training['ItrainerTraining']['start_date']?></td>
		</tr>
	</table>
</div>
<pagebreak class=""/>

<?php
$firstCompetition = true;
foreach ($models as $modelId => $model) {
	echo (!$firstCompetition) ? '<pagebreak class=""/>' : '';
	?>
	<h1 style="text-align: center"><?=$model['model']['info']['ItrainerModel']['name']?></h1>

	<?php
	// ####################
	// CREATE STACKED BAR CHART
	// ####################
	for ($i = 0; $i < count($criteriaList); $i++) {
		$category = $criteriaList[$i];
		$cat = $category['ItrainerTrainingCategory'];
		$imageUrl = $imageUrlFolder . $imageArray[$modelId]['category'][$i]['category_image'] . '.png';
		?>
		<h3><?=$cat['name']?></h3>
		<img src="<?= $imageUrl ?>" alt=""/>
		<pagebreak class=""/>
		<?php
		$criteriaGroupCount = 0;
		for ($j = 0; $j < count($category["children"]); $j++) {
			$criteria = $category["children"][$j];
			$c = $criteria['ItrainerTrainingCriteria'];
			$criteriaGroupCount++;
			$imageUrl = $imageUrlFolder . $imageArray[$modelId]['category'][$i]['criteria_images'][$j] . '.png';
			?>
			<h4><?=$cat['name'] . ": " . $c['name']?></h4>
			<img src="<?= $imageUrl ?>" alt=""/>
			<?php
			if ($criteriaGroupCount == 2) {
				echo '<pagebreak class=""/>';
				$criteriaGroupCount = 0;
			}
		} ?>
		<?php
		if ($criteriaGroupCount > 0) {
			echo '<pagebreak class=""/>';
		}
	} ?>

	<pagebreak class=""/>
	<?php
	// ####################
	// CREATE SCATTER CHART
	// ####################
	$first = true;
	for ($i = 0; $i < count($categoryComparisonList); $i++) {
		$categoryCompare = $categoryComparisonList[$i];
		$cat1 = $categoryCompare['left']['ItrainerTrainingCategory'];
		$cat2 = $categoryCompare['right']['ItrainerTrainingCategory'];
		$imageUrl = $imageUrlFolder . $imageArray[$modelId]['category_comparison'][$i] . '.png';
		if (!$first) {
			echo '<pagebreak class=""/>';
		}

		?>
		<h3><?=$cat1['name'] . __(' vs. ') . $cat2['name']?></h3>
		<img src="<?= $imageUrl ?>" width="630" alt=""/>
		<?php

		$first = false;
	}
	?>
	<pagebreak orientation="L"/>

	<h3><?php echo __('Participation on evaluation')?></h3>

	<div class="content">
		<h4><?php echo __('Proportion of participants that evaluated this criterion:')?></h4>
		<table class="competition_details" border="1" style="border-collapse:collapse;">

			<thead>
			<tr>
				<th></th>
				<th class="porsche asz_model"><?=$model['model']['info']['ItrainerModel']['name']?></th>
				<?php foreach ($model['competitors'] as $competitor) { ?>
					<th><?=$competitor['info']['ItrainerModel']['name']?></th>
				<?php }?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($criteriaList as $category) {
				$categoryId = $category['ItrainerTrainingCategory']['id'];
				$comparisonResult = $result['participant'][$modelId];
				?>
				<tr class="categorie">
					<th class="first_col"><?=$category['ItrainerTrainingCategory']['name']?></th>
					<td class="porsche"><?php
						$val = min($comparisonResult[$model['model']['info']['ItrainerModel']['id']][$categoryId]);
						if ($sentResult == 0) {
							echo "0%";
						} else {
							echo (100 * $val / $sentResult) . '%';
						}
						?></td>

					<?php foreach ($model['competitors'] as $competitor) { ?>
						<td><?php
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
					<tr class="criterion">
						<td class="first_col"><?=$criteria['ItrainerTrainingCriteria']['name']?></td>

						<td class="porsche"><?php
							$val = $comparisonResult[$model['model']['info']['ItrainerModel']['id']][$categoryId][$criteriaId];
							if ($sentResult == 0) {
								echo "0%";
							} else {
								echo (100 * $val / $sentResult) . '%';
							}
							?></td>

						<?php foreach ($model['competitors'] as $competitor) { ?>
							<td><?php
								$val = $comparisonResult[$competitor['info']['ItrainerModel']['id']][$categoryId][$criteriaId];
								if ($sentResult == 0) {
									echo "0%";
								} else {
									echo (100 * $val / $sentResult) . '%';
								}
								?></td>
						<?php }?>
					</tr>
				<?php
				}
			}
			?>
			</tbody>
		</table>
	</div>

	<pagebreak orientation="P" />

	<?php
	$modelSpec = array();
	$modelSpec[$model['model']['info']['ItrainerModel']['id']] = array(
		'name' => $model['model']['info']['ItrainerModel']['name'],
		'specs' => array(
			array('tag' => __('Price'), 'value' => $model['model']['info']['ItrainerModel']['price']),
			array('tag' => __('Engine type'), 'value' => $model['model']['info']['ItrainerModel']['engine_type']),
			array('tag' => __('Cylinders/displacement'), 'value' => $model['model']['info']['ItrainerModel']['cylinders']),
			array('tag' => __('Power (kW/hp) @ rpm'), 'value' => $model['model']['info']['ItrainerModel']['power']),
			array('tag' => __('Max. torque (Nm) @ rpm'), 'value' => $model['model']['info']['ItrainerModel']['max_torque']),
			array(
				'tag' => __('Power output per litre (kW/l)'),
				'value' => $model['model']['info']['ItrainerModel']['power_output_per_litre']
			),
			array(
				'tag' => __('Power-to-weight ratio (kg/PS)'),
				'value' => $model['model']['info']['ItrainerModel']['power_to_weight_ratio']
			),
			array('tag' => __('CO2 emissions (g/km)'), 'value' => $model['model']['info']['ItrainerModel']['co2_emissions']),
			array(
				'tag' => __('Fuel consumption (l/100 km)'),
				'value' => $model['model']['info']['ItrainerModel']['fuel_consumption']
			),
			array('tag' => __('Transmission'), 'value' => $model['model']['info']['ItrainerModel']['transmission']),
			array(
				'tag' => __('Acceleration (0-100 km/h in s)'),
				'value' => $model['model']['info']['ItrainerModel']['acceleration']
			),
			array('tag' => __('Top speed (in km/h)'), 'value' => $model['model']['info']['ItrainerModel']['top_speed']),
			array('tag' => __('Range (km)'), 'value' => $model['model']['info']['ItrainerModel']['range']),
			array('tag' => __('Tank capacity (in l)'), 'value' => $model['model']['info']['ItrainerModel']['tank_capacity']),
			array(
				'tag' => __('Weight (in acc. with DIN in kg)'),
				'value' => $model['model']['info']['ItrainerModel']['weight']
			),
			array(
				'tag' => __('Luggage compartment volume (in l)'),
				'value' => $model['model']['info']['ItrainerModel']['luggage_compartment_volume']
			),
		),
	);

	foreach ($modelSpec as $spec) {
		?>
		<h3><?=$spec['name']?></h3>
		<h4><?php echo __('Technical Data')?></h4>
		<table class="technical-data">
			<tbody>
			<?php foreach ($spec['specs'] as $techSpec) { ?>
				<tr>
					<th><?=$techSpec['tag']?></th>
					<td><?=$techSpec['value']?></td>
				</tr>
			<?php }?>
			</tbody>
		</table>
	<?php }?>

<?php } ?>

</div>

<?php
$html = ob_get_contents();
ob_end_clean();

App::import('Vendor', 'mpdf/mpdf');
error_reporting(0);
$mpdf = new mPDF();
$stylesheet = file_get_contents(APP . DS . 'webroot' . DS . 'css' . DS . 'porsche_pdf-pvca.css');
$mpdf->WriteHTML($stylesheet, 1);
$mpdf->WriteHTML(
	$this->element(
		'pdf/intro',
		array(
			'Title' => $training['ItrainerTraining']['name'],
			'SubTitle' => __('Evaluation Report')
		)
	)
);
$mpdf->SetHTMLHeader($this->element('pdf/header'));
$mpdf->SetHTMLFooter($this->element('pdf/footer'));

$fileName = "iTrainer - Result - {$training['ItrainerTraining']['name']} - PVCA Trainer.pdf";
$mpdf->WriteHTML($html);
$mpdf->Output($fileName, 'I');

// remove the cached directory
$dir = $absolutePath;
$it = new RecursiveDirectoryIterator($dir);
$files = new RecursiveIteratorIterator($it,
	RecursiveIteratorIterator::CHILD_FIRST);
foreach($files as $file) {
	if ($file->getFilename() === '.' || $file->getFilename() === '..') {
		continue;
	}
	if ($file->isDir()){
		rmdir($file->getRealPath());
	} else {
		unlink($file->getRealPath());
	}
}
rmdir($dir);
?>

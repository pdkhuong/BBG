<?php
ob_start();
?>
	<h3><?php echo __('Summary')?></h3>
	<table class="wp-list-table widefat fixed result-table short-infos">
		<thead>
		<tr>
			<th>&nbsp;</th>
			<th><?php echo __('Pre-Test') ?></th>
			<th><?php echo __('Post-Test') ?></th>
			<th><?php echo __('Difference') ?></th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><?php echo __('Sent tests')?></td>
			<td><?=$result['TestTotal']['NumPreTestSent']?></td>
			<td><?=$result['TestTotal']['NumPostTestSent']?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo __('Average points of all users')?></td>
			<td><?=$result['TestTotal']['AveragePreTest']?></td>
			<td><?=$result['TestTotal']['AveragePostTest']?></td>
			<td><?=$result['TestTotal']['AveragePostTest'] - $result['TestTotal']['AveragePreTest']?></td>
		</tr>
		<tr>
			<td><?php echo __('Possible Points')?></td>
			<td><?=$result['TestTotal']['PossiblePoint']?></td>
			<td><?=$result['TestTotal']['PossiblePoint']?></td>
			<td></td>
		</tr>
		<tr>
			<td><?php echo __('Average results of all users in %')?></td>
			<td><?=round(
					100 * $result['TestTotal']['AveragePreTest'] / $result['TestTotal']['PossiblePoint']
				) . '%'?></td>
			<td><?=round(
					100 * $result['TestTotal']['AveragePostTest'] / $result['TestTotal']['PossiblePoint']
				) . '%'?></td>
			<td><?=(round(
					100 * $result['TestTotal']['AveragePostTest'] / $result['TestTotal']['PossiblePoint']
				) - round(
					100 * $result['TestTotal']['AveragePreTest'] / $result['TestTotal']['PossiblePoint']
				)) . '%'?></td>
		</tr>
		</tbody>
	</table>
	<br/>
	<br/>
	<h3><?php echo __('TOP 10 Pre-Test') ?></h3>
	<ol>
		<?php
		$i = 0;
		foreach ($result['TopResult']['TopPreTest'] as $userResult) {
			?>
			<li><span><?= $userResult['mark'] . __(' Points')?></span>: <?= $userResult['name'] ?></li>
			<?php
			$i++;
			if ($i == 10) {
				break;
			}
		}
		?>
	</ol>
	<h3><?php echo __('TOP 10 Post-Test') ?></h3>
	<ol>
		<?php
		$i = 0;
		foreach ($result['TopResult']['TopPostTest'] as $userResult) {
			?>
			<li><span><?= $userResult['mark'] . __(' Points')?> </span>: <?= $userResult['name'] ?></li>
			<?php
			$i++;
			if ($i == 10) {
				break;
			}
		}
		?>
	</ol>
<?php
$i = 0;
$first = true;
foreach ($answerList as $question) {
	?>
	<?php if ($i == 0) {
		?>
		<pagebreak class=""/>
	<?php
	}
	if ($first) {
		?>
		<h3><?php echo __('Results') ?></h3>
		<?php
		$first = false;
	}?>
	<table class="wp-list-table widefat fixed result-table prepost">
		<thead>
		<tr class="question">
			<th><?=$question['QuestionnaireQuestion']['name']?></th>
			<th><?php echo __('Pre-Test') ?></th>
			<th><?php echo __('Post-Test') ?></th>
			<th><?php echo __('Difference') ?></th>
		</tr>
		</thead>
		<?php
		foreach ($question['children'] as $answer) {
			$preTestCount = isset($result['AnswerResult']['PreTest'][$answer['QuestionnaireAnswer']['id']])
				? $result['AnswerResult']['PreTest'][$answer['QuestionnaireAnswer']['id']]['count'] : 0;
			$postTestCount = isset($result['AnswerResult']['PostTest'][$answer['QuestionnaireAnswer']['id']])
				? $result['AnswerResult']['PostTest'][$answer['QuestionnaireAnswer']['id']]['count'] : 0;

			$preTestTotal = $result['TestTotal']['NumPreTestSent'];
			$postTestTotal = $result['TestTotal']['NumPostTestSent'];
			$preTestPercent = 100 * $preTestCount / $preTestTotal;
			$postTestPercent = 100 * $postTestCount / $postTestTotal;
			if (isset($answer['QuestionnaireAnswer']['is_true']) && $answer['QuestionnaireAnswer']['is_true'] == 1) {
				$isTrue = true;
			} else {
				$isTrue = false;
			}
			?>
			<tr class="<?php echo $isTrue ? 'correct' : 'wrong' ?>">
				<td><?=$answer['QuestionnaireAnswer']['answer']?></td>
				<td><?=$preTestPercent . '%'?></td>
				<td><?=$postTestPercent . '%'?></td>
				<td><?=($postTestPercent - $preTestPercent) . '%'?></td>
			</tr>
		<?php
		}
		?>
	</table>
	<?php
	$i++;
	if ($i == 3) {
		$i = 0;
	}
}
?>
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
			'Title' => $test['ItrainerTraining']['name'],
			'SubTitle' => __('Pre-/Posttest Results')
		)
	)
);
$mpdf->SetHTMLHeader($this->element('pdf/header'));
$mpdf->SetHTMLFooter($this->element('pdf/footer'));

$fileName = "Itrainer - Result - {$test['ItrainerTraining']['name']} - Pre-Post - Trainer.pdf";
$mpdf->WriteHTML($html);
$mpdf->Output($fileName, 'I');
?>

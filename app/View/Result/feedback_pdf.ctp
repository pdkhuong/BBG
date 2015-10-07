<?php
ob_start();
?>
<h3><?php echo __('Summary')?> </h3>
<table class="wp-list-table widefat fixed result-table short-infos">
	<tbody>
	<tr>
		<td><?php echo __('Sent feedback forms')?></td>
		<td><?=$result['FeedbackTotal']['TotalFeedback']?></td>
	</tr>
	<tr>
		<td><?php echo __('Total result')?></td>
		<td><?=$result['FeedbackTotal']['AverageResult']?></td>
	</tr>
	</tbody>
</table>

<pagebreak class=""/>

<h3><?php echo __('Results') ?></h3>
<?php foreach ($questionList as $category) { ?>
	<table class="wp-list-table widefat fixed result-table">
		<thead>
		<tr>
			<th class="question" style="width:50%;"><?=$category['ItrainerFeedbackCategory']['name']?></th>
			<th class="number" style="width:10%;">1</th>
			<th class="number" style="width:10%;">2</th>
			<th class="number" style="width:10%;">3</th>
			<th class="number" style="width:10%;">4</th>
			<th class="number" style="width:10%;">
				&#216; <?=$result['CategoryTotal'][$category['ItrainerFeedbackCategory']['id']]?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($category['children'] as $question) { ?>
			<tr>
				<td class="question"><?=$question['ItrainerFeedbackQuestion']['name']?></td>
				<td class="number"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count1']?></td>
				<td class="number"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count2']?></td>
				<td class="number"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count3']?></td>
				<td class="number"><?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['Count4']?></td>
				<td class="number">
					&#216; <?=$result['QuestionTotal'][$question['ItrainerFeedbackQuestion']['id']]['AverageResult']?></td>
			</tr>
		<?php }?>
		</tbody>
	</table>
<?php } ?>


<?php if (count($comments) > 0) { ?>
	<pagebreak class=""/>
	<h3><?php echo __('Comments') ?></h3>
	<table class="wp-list-table widefat fixed comment-table">
		<thead>
		<tr>
			<th class="personal-data"><?php echo __('Personal Data')?></th>
			<th><?php echo __('Comment')?></th>
		</tr>
		</thead>
		<tbody>
		<?php foreach ($comments as $comment) {
			$user = $comment['ItrainerFeedbackUser'];
			$cmt = $comment['ItrainerFeedbackComment'];
			?>
			<tr data-id="<?= $cmt['id'] ?>">
				<td><?=(isset($user['is_anonymously']) && $user['is_anonymously'] == 0 && isset($user['first_name']) && isset($user['surname'])) ? $user['first_name'] . " " . $user['surname'] : "Anonymous"?></td>
				<td>
					<?php
					$replace = array("\r", "\n");
					$order = array('\r', '\n');
					echo nl2br(str_replace($order, $replace, $cmt['comment']));
					?>
				</td>
			</tr>
		<?php }?>
		</tbody>
	</table>
<?php } ?>

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
			'Title' => $feedback['ItrainerTraining']['name'],
			'SubTitle' => __('Feedback Summary')
		)
	)
);
$mpdf->SetHTMLHeader($this->element('pdf/header'));
$mpdf->SetHTMLFooter($this->element('pdf/footer'));

$fileName = "Itrainer - Result - {$feedback['ItrainerTraining']['name']} - Feedback.pdf";
$mpdf->WriteHTML($html);
$mpdf->Output($fileName, 'I');
?>




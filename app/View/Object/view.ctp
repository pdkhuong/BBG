<h1>
  <?= $objectType->name ?>
</h1>

<hr>

<?php
foreach (array_keys($inputData) as $key) {
  ?>
  <p> <?php echo sfConvertField2Name($key); ?>:
    <? if (isset($inputData[$key]['options']) && isset($inputData[$key]['options'][$inputData[$key]['default']])): ?>
      <?= $inputData[$key]['options'][$inputData[$key]['default']] ?>
    <? else: ?>
      <?= $objectLink->$key ?>
    <? endif; ?>
  </p>
<?php } ?>


<hr />
<?php
echo $this->Html->link(
        'Delete', "/object/delete/{$objectType->id}/{$objectLink->object_id}", array('confirm' => 'Are you sure?'));
?>

<?php echo $this->Html->link('Back to list', '/object/search/' . $objectType->id); ?>
<br/>
<br/>

<?php echo $this->Upload->viewListing($objectLink->object_id); ?>

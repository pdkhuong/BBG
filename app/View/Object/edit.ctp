<h1>
  <? if ($objectLink->object_id > 0): ?>
    Edit
  <? else: ?>
    Add
  <? endif; ?>
  <?= $objectType->name ?>
</h1>

<hr />

<p>
  <?php echo $this->Html->link('Back to list', '/object/search/' . $objectType->id); ?>
</p>

<?php
echo $this->Form->create('ObjectLinkModel', array('novalidate' => true));
foreach ($inputData as $key => $options) {
  echo $this->Form->input($key, $options);
}
echo $this->Form->end('Save');
if ($objectLink->object_id > 0){
  echo $this->Upload->edit($objectLink->object_id);
}
?>
<hr />

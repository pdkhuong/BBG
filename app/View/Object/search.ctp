<h1>
  <?= $objectType->name ?>
</h1>
<hr>

<p><?php echo $this->Html->link('Add', "/object/edit/{$objectType->id}"); ?></p>
<table>
  <tr>
    <th>ID</th>
    <?php
    foreach (array_keys($inputData) as $key) {
      ?>
      <th> <?php echo sfConvertField2Name($key); ?></th>
    <?php } ?>
    <th>Actions</th>
  </tr>

  <?php
  foreach ($allLinks as $data) {
    ?>
    <tr>
      <td><?= $data->id ?></td>
      <?php
      foreach (array_keys($inputData) as $key) {
        ?>
        <td>
          <? if (isset($inputData[$key]['options']) && isset($inputData[$key]['options'][$data->$key])): ?>
            <?= $inputData[$key]['options'][$data->$key] ?>
          <? else: ?>
            <?= $data->$key ?>
          <? endif; ?>
        </td>
      <?php } ?>
      <td>
        <?php echo $this->Html->link('View', "/object/view/{$objectType->id}/{$data->object_id}"); ?>
        <?php echo $this->Html->link('Edit', "/object/edit/{$objectType->id}/{$data->object_id}"); ?>
      </td>
    </tr>
  <?php } ?>


</table>
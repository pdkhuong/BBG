<?php
$this->HTML->script('libs/jquery.dataTables', array('inline' => false));
$this->HTML->script('libs/dataTables.bootstrap', array('inline' => false));
$this->HTML->script('datatables.js', array('inline' => false));
$this->HTML->css('dataTables.bootstrap', array('inline' => false));
?>
<?php
echo $this->Form->create('TradeshowEvent', array(
  'novalidate' => true,
  'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
      'class' => 'col col-md-3 control-label text-left'
    ),
    'wrapInput' => 'col col-md-9',
    'class' => 'form-control'
  )
));
?>
<div class="page-title" id="page-title">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?= __('Add product to event') ?>
      </h1>
      <h4></h4>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array('class' => 'btn btn-inverse', 'type' => 'submit', 'escape' => false)); ?>
      <?php echo $this->Html->link(__('Cancel'), Router::url(array("action" => "index")), array('class' => 'btn btn-cancel')); ?>
    </div>
  </div>
</div>
<div class="well form-horizontal page-body posts form">
  <table class="table">
    <tr>
      <th><input id="cbProduct" type="checkbox"/> No.</th>
      <th>ID</th>
      <th>Product name</th>
      <th>Category</th>
      <th>Created time</th>
    </tr>

    <?php foreach ($listProduct as $key => $product): ?>
      <tr <?php echo ($key % 2 == 0) ? 'class="success"' : '' ?>>
        <td><input class="_product" name="data[TradeshowProduct][id][<?php echo $product['TradeshowProduct']['id'] ?>]" type="checkbox" <?php if(isset($ownProducts[$product['TradeshowProduct']['id']])) echo "checked"  ?>/> <?php echo ($key + 1) ?></td>
        <td><?php echo $product['TradeshowProduct']['id'] ?></td>
        <td><?php echo $product['TradeshowProduct']['name'] ?></td>
        <td><?php echo $product['TradeshowCategory']['name'] ?></td>
        <td><?php echo $product['TradeshowProduct']['created_time'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
<?php
echo $this->Form->end();
echo $this->Html->script('event.js');
?>
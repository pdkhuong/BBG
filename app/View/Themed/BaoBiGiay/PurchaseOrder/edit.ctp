<h3>
  <? if (isset($this->data['PurchaseOrder']['id']) && $this->data['PurchaseOrder']['id'] > 0): ?>
    <?= __('Edit Purchase Order') ?>: #<?= $this->data['PurchaseOrder']['id'] ?>
  <? else: ?>
    <?= __('Add Purchase Order') ?>
  <? endif; ?>
</h3>

<hr />
<?php
echo $this->Form->create('PurchaseOrder', array(
  'novalidate' => true,
  'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
      'class' => 'col col-md-3 control-label text-left'
    ),
    'wrapInput' => 'col col-md-9',
    'class' => 'form-control'
  ),

));
?>
<div class="well form-horizontal page-body posts form">
  <?php echo $this->Form->input('order_no', array('label' => array('text' => __('Order No.')))) ?>
  <?php echo $this->Form->input('buyer_name', array('label' => array('text' => __('Buyer Name')))) ?>
  <?php echo $this->Form->input('term', array('label' => array('text' => __('Terms')))) ?>
  <?php
  echo $this->Form->input('ship_via',
    array('options' => $shipType,
      'selected'=>NULL,
      'empty' => __("Please select ..."),
      'text' => __("Ship Via"),
      array('require'=>true, 'allowEmpty'=>false),
    )
  );
  ?>
  <?php
  $isErrorOrderDate = isset($errorObj['order_date']) ? TRUE : FALSE;
  $isErrorReceivedDate = isset($errorObj['received_date']) ? TRUE : FALSE;
  ?>
  <div class="form-group required <?php if($isErrorOrderDate) echo 'has-error error' ?>">
    <label for="txt_order_date" class="col col-md-3 control-label text-left"><?php echo __('Order date') ?></label>
    <div class="col col-md-3">
      <div class='input-group date' id='div_order_date' data-date-format="YYYY-MM-DD">
        <input value="<?php echo isset($this->data['PurchaseOrder']['order_date']) && $this->data['PurchaseOrder']['order_date'] ? date('Y-m-d', strtotime($this->data['PurchaseOrder']['order_date'])) : '' ?>" name="data[PurchaseOrder][order_date]" id="txt_from_date" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
    <div class="col col-md-6">
      <?php if($isErrorOrderDate):?>
        <span class="help-block text-danger"><?php echo $errorObj['order_date'][0]?></span>
      <?php endif;?>
    </div>
  </div>

  <div class="form-group required <?php if($isErrorReceivedDate) echo 'has-error error' ?>">
    <label for="txt_received_date" class="col col-md-3 control-label text-left"><?php echo __('Received date') ?></label>
    <div class="col col-md-3">
      <div class='input-group date' id='div_received_date' data-date-format="YYYY-MM-DD">
        <input value="<?php echo isset($this->data['PurchaseOrder']['received_date']) && $this->data['PurchaseOrder']['received_date'] ? date('Y-m-d', strtotime($this->data['PurchaseOrder']['received_date'])) : '' ?>" name="data[PurchaseOrder][received_date]" id="txt_from_date" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
    <div class="col col-md-6">
      <?php if($isErrorReceivedDate):?>
        <span class="help-block text-danger"><?php echo $errorObj['received_date'][0]?></span>
      <?php endif;?>
    </div>

  </div>

</div>

Added Product(s):
<div class='table-responsive well'>
  <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
    <thead>
    <tr>
      <th width="5%"><?php echo __('ID') ?></th>
      <th width="10%"><?php echo __('No.') ?></th>
      <th width="20%"><?php echo __('Name') ?></th>
      <th width="10%"><?php echo __('Unit') ?></th>
      <th width="15%"><?php echo __('Price') ?></th>
      <th width="15%"><?php echo __('Num Of Product'); ?></th>
      <th width="20%"><?php echo __('Total Price'); ?></th>
      <th width="5%">Action</th>
    </tr>
    </thead>
    <tbody id="_bodyAddedProduct">
    <?php if($addedProducts):?>
      <?php foreach($addedProducts as $productId => $addedProduct):?>
        <tr>
          <td><?php echo $productId?></td>
          <td><?php echo $addedProduct['Product']['item_no']?></td>
          <td><?php echo $addedProduct['Product']['name']?></td>
          <td><?php echo $addedProduct['ProductUnit']['name']?></td>
          <td><span id="_price_<?php echo $productId?>"><?php echo $addedProduct['Product']['price']?></span></td>
          <td>
            <input class="_num_product" data-id="<?php echo $productId?>" type="text" maxlength=10 name="data[Product][num_item][<?php echo $productId?>]" value="<?php echo $addedProduct['numOfProduct']?>"/>
          </td>
          <td><span class="_total_price" id="_total_price_<?php echo $productId?>">0</span> </td>
          <td><a class="btn btn-default btn-sm _removeProduct"> Remove </a></td>
        </tr>
      <?php endforeach;?>
    <?php endif;?>
      <tr>
        <td><b>Sum</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b id="_sum_price">0</b></td>
        <td></td>
      </tr>
    </tbody>
  </table>
</div>

List Product:
<div class='table-responsive well'>
  <table id="_product_dt" cellpadding='0' cellspacing='0' class='table items-table' data-nosearchable="0,5" data-nosortable="0,5" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
    <thead>
    <tr>
      <th width="10%"><?php echo __('ID') ?></th>
      <th width="20%"><?php echo __('No.') ?></th>
      <th width="25%"><?php echo __('Name') ?></th>
      <th width="10%"><?php echo __('Unit') ?></th>
      <th width="20%"><?php echo __('Price') ?></th>
      <th width="15%"><?php echo __('Actions'); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ($listProduct as $data):
      ?>
      <tr>
        <td><?php echo ($data['Product']['id']); ?></td>
        <td><?php echo ($data['Product']['item_no']); ?></td>
        <td><?php echo ($data['Product']['name']); ?></td>
        <td><?php echo ($data['ProductUnit']['name']); ?></td>
        <td><?php echo ($data['Product']['price']); ?></td>
        <td>
          <a class="btn btn-default btn-sm _addProduct">Add product</a>
        </td>
      </tr>
      <?php
    endforeach;
    ?>
    </tbody>
  </table>
</div>

<?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary', 'id' => "_submit"));
  echo $this->Form->end();
?>
<?php
$this->HTML->script('libs/jquery.dataTables.min', array('inline' => false));
$this->HTML->script('libs/dataTables.bootstrap.min', array('inline' => false));
$this->HTML->script('datatables.js', array('inline' => false));
$this->HTML->css('dataTables.bootstrap.min', array('inline' => false));

echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>
<script id="tableRowTemplate" type="text/x-jQuery-tmpl">
  <tr>
    <td>
      ${id}
    </td>
    <td>${item_no}</td>
    <td>${name}</td>
    <td>${unit_name}</td>
    <td><span id="_price_${id}">${price}</span></td>
    <td>
      <input class="_num_product" data-id="${id}" type="text" maxlength=10 name="data[Product][num_item][${id}]" />
    </td>
    <td><span class="_total_price" id="_total_price_${id}">0</span> </td>
    <td><a class="btn btn-default btn-sm _removeProduct"> Remove </a></td>
  </tr>
</script>


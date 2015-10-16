<div class="page-title">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Purchase Oder List') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false)); ?>
    </div>
  </div>
</div>
<?php
echo $this->Form->create('PurchaseOder', array(
  'novalidate' => true,
  'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
      'class' => 'col col-md-2 control-label text-left'
    ),
    'wrapInput' => 'col col-md-7',
    'class' => 'form-control'
  ),
  'type' => 'get'
));
?>
<div class="well form-horizontal page-body posts form">
    <div class="form-group">
      <label class="col col-md-2 control-label text-left"><?php echo __('Order date From') ?></label>
      <div class="col col-md-3">
        <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD">
          <input value="<?php echo $orderDateFrom?>" name="order_date_from" type='text' class="form-control" readonly="readonly"/>
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
      </div>

      <label class="col col-md-1 control-label text-left"><?php echo __('To') ?></label>
      <div class="col col-md-3">
        <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD">
          <input value="<?php echo $orderDateTo?>" name="order_date_to" type='text' class="form-control" readonly="readonly"/>
          <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
        </div>
      </div>
    </div>

  <?php
  echo $this->Form->input('customer_id', array(
      'options' => array(),
      'selected'=>$customerId,
      'empty' => __("Please select ..."),
      'text' => __("Customer"),
      array('require'=>true, 'allowEmpty'=>false),
    )
  );
  ?>
  <?php echo $this->Form->input('order_no', array('label' => array('text' => __('Order No.')), 'value' => $orderNo)) ?>
  <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-large btn-primary', 'id' => "_submit"));?>
</div>
<?php echo $this->Form->end(); ?>


<div class="page-body">
  <div class="row">
    <div class="col-md-12">

      <div class="block">
        <div class="block-body">
          <div class='table-responsive'>

            <table cellpadding='0' cellspacing='0' class='table' data-nosearchable=",3" data-nosortable=",3" data-idisplaylength="10" data-aasorting="[[0,'asc']]">
              <thead>
              <tr>
                <th width="10%"><?php echo __('Order No.') ?></th>
                <th width="20%"><?php echo __('Customer') ?></th>
                <th width="15%"><?php echo __('Buyer Name') ?></th>
                <th width="20%"><?php echo __('Terms') ?></th>
                <th width="5%"><?php echo __('Ship Via') ?></th>
                <th width="10%"><?php echo __('Order Date') ?></th>
                <th width="10%"><?php echo __('Received Date') ?></th>
                <th width="10%"><?php echo __('Actions'); ?></th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($dataList as $data):
                ?>
                <tr>
                  <td><?php echo $data['PurchaseOrder']['order_no']; ?></td>
                  <td><?php echo $data['PurchaseOrder']['customer_id']; ?></td>
                  <td><?php echo $data['PurchaseOrder']['buyer_name']; ?></td>
                  <td><?php echo $data['PurchaseOrder']['term']; ?></td>
                  <td><?php echo $data['PurchaseOrder']['ship_via']; ?></td>
                  <td><?php echo reformatDate($data['PurchaseOrder']['order_date']); ?></td>
                  <td><?php echo reformatDate($data['PurchaseOrder']['received_date']); ?></td>
                  <td>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit')) . '/' . $data['PurchaseOrder']['id'], array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false)) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete')) . '/' . $data['PurchaseOrder']['id'], array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false), __('Are you sure you want to delete #%s?', $data['PurchaseOrder']['id'])) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php if ($this->Paginator->param('pageCount') > 1): ?>
      <div class="col-md-12">
        <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>
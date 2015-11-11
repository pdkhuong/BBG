<h3>
  <? if (isset($this->data['WorksSheet']['id']) && $this->data['WorksSheet']['id'] > 0): ?>
    <?= __('Edit Works Sheet') ?>: <?php echo $this->data['WorksSheet']['auto_code']?>
  <? else: ?>
    <?= __('Add Works Sheet') ?>: <?php echo $autoCode?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form _works_sheet">
<?php
  echo $this->Form->create('WorksSheet', array(
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

  <?php
  $currentUrl = isset($this->data['WorksSheet']['id']) ? Router::url(array('action' => 'edit', $this->data['WorksSheet']['id']), true) : Router::url(array('action' => 'edit'), true);
  echo $this->Form->input('customer_id',
    array('options' => $listCustomer,
      'selected'=>NULL,
      'label' => array('text' => __('Customer')),
      'empty' => __("Please select customer..."),
      'id' => "_change_customer",
      'data-current-url' =>$currentUrl
    )
  );
  ?>
  <?php
    echo $this->Form->input('product_id',
      array('options' => $listProductHasPO,
        'selected'=>NULL,
        'empty' => __("Please select product..."),
        'id' => '_costing_product'
      )
    );
    ?>
  <?php
  $isErrorDeliveryDate = isset($errorObj['delivery_date']) ? TRUE : FALSE;
  ?>
  <div class="form-group required <?php if($isErrorDeliveryDate) echo 'has-error error' ?>">
    <label class="col col-md-3 control-label text-left"><?php echo __('Delivery Date') ?></label>
    <div class="col col-md-3">
      <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD">
        <input value="<?php echo isset($this->data['WorksSheet']['delivery_date']) && $this->data['WorksSheet']['delivery_date'] ? reformatDate($this->data['WorksSheet']['delivery_date']) : '' ?>" name="data[WorksSheet][delivery_date]" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
    <div class="col col-md-6">
      <?php if($isErrorDeliveryDate):?>
        <span class="help-block text-danger"><?php echo $errorObj['delivery_date'][0]?></span>
      <?php endif;?>
    </div>
  </div>

  <?php echo $this->Form->input('delivery_location', array('label' => array('text' => __('Delivery Location')))) ?>
  <?php echo $this->Form->input('difference_percent', array('label' => array('text' => __('Difference Percent')))) ?>
  <?php
  if($isAdmin){
    echo $this->Form->input('created_user_id',
      array('options' => $listUser,
        'selected'=>NULL,
        'label' => array('text' => __('Created By Staff')),
        'empty' => __("Please select created staff..."),
      )
    );
  }
  ?>
  <?php echo $this->Form->input('special_note', array('rows'=>2, 'label' => array('text' => __('Special Note')))) ?>

  Progress Step(s)
  <div class='table-responsive well'>
    <table cellpadding='0' cellspacing='0' class='table'>
      <thead>
      <tr>
        <th width="10%"><?php echo __('Order') ?></th>
        <th width="20%"><?php echo __('Progress Name') ?></th>
        <th width="30%"><?php echo __('Vendor') ?></th>
        <th width="40%"><?php echo __('Description') ?></th>
      </tr>
      </thead>
      <tbody id="_bodyAddedProgress">
      <?php if($addedProgress):?>
        <?php foreach($addedProgress as $progressId => $progress):?>
          <tr>
            <td><span><?php echo $progress['order']?></span><?php echo $this->Form->input("WorksSheetProgress.{$progressId}.order", array('type' => 'hidden', 'value' => $progress['order']));?></td>
            <td><?php echo $progress['name']?><?php echo $this->Form->input("WorksSheetProgress.{$progressId}.name", array('type' => 'hidden', 'value' => $progress['name']));?></td>
            <td>
              <?php
              echo $this->Form->input("WorksSheetProgress.{$progressId}.vendor_id",
                array('options' => $vendorList,
                  'selected'=>$progress['vendor_id'],
                  'label' => false,
                  'empty' => __("Select Vendor..."),
                )
              );
              ?>
            </td>
            <td><?php echo $this->Form->input("WorksSheetProgress.{$progressId}.description", array('type' => 'text', 'value' => $progress['description'], 'label' => false));?></td>
          </tr>
        <?php endforeach;?>
      <?php endif;?>
      </tbody>
    </table>
  </div>

  <div class="form-group">
    <div class="form-group ">
      <div class="col col-md-3 text-left">
        <?php
        echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array('class' => 'btn btn-primary', 'type' => 'submit', 'escape' => false));
        echo ' ';
        echo $this->Html->link(__('Cancel'), Router::url(array("action" => "index")), array('class' => 'btn btn-default'));
        ?>
      </div>
    </div>
    <?php
    echo $this->Form->input('id', array('type' => 'hidden'));
    echo $this->Form->end();
    ?>
</div>
<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>

<script id="tableRowTemplateWorksSheet" type="text/x-jQuery-tmpl">
  <tr>
    <td><span>${order}</span><?php echo $this->Form->input('WorksSheetProgress.${id}.order', array('type' => 'hidden', 'value' => '${order}'));?></td>
    <td>${progress_name}<?php echo $this->Form->input('WorksSheetProgress.${id}.name', array('type' => 'hidden', 'value' => '${progress_name}'));?></td>
    <td>
    <?php
    echo $this->Form->input('WorksSheetProgress.${id}.vendor_id',
      array('options' => $vendorList,
        'selected'=>NULL,
        'label' => false,
        'empty' => __("Select Vendor..."),
      )
    );
    ?>
    <td><?php echo $this->Form->input('WorksSheetProgress.${id}.description', array('type' => 'text', 'label' => false));?></td>
  </tr>
</script>

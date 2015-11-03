<h3>
  <? if (isset($this->data['WorksSheet']['id']) && $this->data['WorksSheet']['id'] > 0): ?>
    <?= __('Edit Works Sheet') ?>
  <? else: ?>
    <?= __('Add Works Sheet') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
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

  <?php echo $this->Form->input('order_no', array('label' => array('text' => __('Order No.')))) ?>
  <?php
  echo $this->Form->input('customer_id',
    array('options' => $listCustomer,
      'selected'=>NULL,
      'label' => array('text' => __('Customer')),
      'empty' => __("Please select customer..."),
    )
  );
  ?>
  <?php
  echo $this->Form->input('output_product_id',
    array('options' => $listProduct,
      'selected'=>NULL,
      'empty' => __("Please select output product..."),
    )
  );
  ?>
  <?php
  echo $this->Form->input('input_product_id',
    array('options' => $listProduct,
      'selected'=>NULL,
      'empty' => __("Please select input product..."),
    )
  );
  ?>
  <?php echo $this->Form->input('num_product', array('label' => array('text' => __('Quantity')))) ?>
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
        'label' => array('text' => __('Created By User')),
        'empty' => __("Please select created user..."),
      )
    );
  }
  ?>
  <?php
  echo $this->Form->input('approved_user_id',
    array('options' => $listUser,
      'selected'=>NULL,
      'label' => array('text' => __('Approved By User')),
      'empty' => __("Please select approved user..."),
    )
  );
  ?>
  <?php echo $this->Form->input('special_note', array('rows'=>2, 'label' => array('text' => __('Special Note')))) ?>

  Progress Step(s)
  <div class='table-responsive well'>
    <table cellpadding='0' cellspacing='0' class='table'>
      <thead>
      <tr>
        <th width="10%"><?php echo __('Order') ?></th>
        <th width="20%"><?php echo __('Progress Name') ?></th>
        <th width="25%"><?php echo __('At Location') ?></th>
        <th width="30%"><?php echo __('Description') ?></th>
        <th width="15%">Action</th>
      </tr>
      </thead>
      <tbody id="_bodyAddedProgress">
      <?php if($addedProgress):?>
        <?php foreach($addedProgress as $progressId => $progress):?>
          <tr id="_row_<?php echo $progressId?>">
            <td>
              <span class="_progress_order"><?php echo $progress['order']?></span>
              <?php echo $this->Form->input("WorksSheetProgress.{$progressId}.order", array('type' => 'hidden', 'value' => $progress['order']));?>
            </td>
            <td>
              <?php echo $progress['name']?>
              <?php echo $this->Form->input("WorksSheetProgress.{$progressId}.name", array('type' => 'hidden', 'value' => $progress['name']));?>
            </td>
            <td>
              <?php echo $progress['location']?>
              <?php echo $this->Form->input("WorksSheetProgress.{$progressId}.location", array('type' => 'hidden', 'value' => $progress['location']));?>
            </td>
            <td>
              <?php echo $progress['description']?>
              <?php echo $this->Form->input("WorksSheetProgress.{$progressId}.description", array('type' => 'hidden', 'value' => $progress['description']));?>
            </td>
            <td>
              <a class="btn btn-default btn-sm _editProgress" data-id=<?php echo $progressId?>> Edit </a>
              <a class="btn btn-default btn-sm _removeProgress"> Remove </a>
            </td>
          </tr>
        <?php endforeach;?>
      <?php endif;?>
      </tbody>
    </table>
  </div>

  <div class="form-group">
    <div class="col col-md-9">
    </div>
    <div class="col-md-3 text-right">
      <button type="button" class="btn btn-default btn-sm _addProgress" data-toggle="modal" data-target="#progressModal"><?php echo __("Add Progress Step(s)")?></button>
  </div>
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
  //echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>
<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>

<div id="progressModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Progress Step(s)</h4>
      </div>
      <div class="modal-body">
        <div id="_progress_msg" class="alert alert-danger hidden"></div>
        <div class="form-group required">
          <label class="col col-md-3 control-label text-left"><?php echo __('Progress Name')?></label>
          <div class="col col-md-9 required">
            <input id="_progress_name" class="form-control" maxlength="255" type="text" required="required">
          </div>
        </div>
        <div class="form-group required">
          <label class="col col-md-3 control-label text-left"><?php echo __('At Location')?></label>
          <div class="col col-md-9 required">
            <input id="_progress_location" class="form-control" maxlength="255" type="text" required="required">
          </div>
        </div>
        <div class="form-group">
          <label class="col col-md-3 control-label text-left"><?php echo __('Description')?></label>
          <div class="col col-md-9">
            <input id="_progress_description" class="form-control" maxlength="255" type="text">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input id="_progress_id" type="hidden" >
        <input id="_progress_order" type="hidden" >
        <button id="_progress_ok" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>

<script id="tableRowTemplateWorksSheet" type="text/x-jQuery-tmpl">
  <tr id="_row_${id}">
    <td>
      <span class="_progress_order">${order}</span>
      <?php echo $this->Form->input('WorksSheetProgress.${id}.order', array('type' => 'hidden', 'value' => '${order}'));?>
    </td>
    <td>
      ${progress_name}
      <?php echo $this->Form->input('WorksSheetProgress.${id}.name', array('type' => 'hidden', 'value' => '${progress_name}'));?>
    </td>
    <td>
      ${progress_location}
      <?php echo $this->Form->input('WorksSheetProgress.${id}.location', array('type' => 'hidden', 'value' => '${progress_location}'));?>
    </td>
    <td>
      ${progress_description}
      <?php echo $this->Form->input('WorksSheetProgress.${id}.description', array('type' => 'hidden', 'value' => '${progress_description}'));?>
    </td>
    <td>
    <a class="btn btn-default btn-sm _editProgress" data-id=${id}> Edit </a>
    <a class="btn btn-default btn-sm _removeProgress"> Remove </a>
    </td>
  </tr>
</script>

<h3>
  <? if (isset($this->data['Salary']['id']) && $this->data['Salary']['id'] > 0): ?>
    <?= __('Edit Salary Item') ?>: #<?= $this->data['Salary']['id'] ?>
  <? else: ?>
    <?= __('Add Salary Item') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
  echo $this->Form->create('Salary', array(
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
  echo $this->Form->input('customer_id',
    array('options' => $listCustomer,
      'selected'=>NULL,
      'label' => array('text' => __('Customer')),
      'empty' => __("Please select customer..."),
    )
  );
  ?>
  <?php echo $this->Form->input('amount', array('label' => array('text' => __('Amount')))) ?>
  <?php
  $isErrorDate = isset($errorObj['date']) ? TRUE : FALSE;
  ?>
  <div class="form-group required <?php if($isErrorDate) echo 'has-error error' ?>">
    <label class="col col-md-3 control-label text-left"><?php echo __('Date') ?></label>
    <div class="col col-md-3">
      <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD">
        <input value="<?php echo isset($this->data['Salary']['date']) && $this->data['Salary']['date'] ? reformatDate($this->data['Salary']['date']) : '' ?>" name="data[Salary][date]" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
    <div class="col col-md-6">
      <?php if($isErrorDate):?>
        <span class="help-block text-danger"><?php echo $errorObj['date'][0]?></span>
      <?php endif;?>
    </div>
  </div>

  <?php echo $this->Form->input('mark_up', array('label' => array('text' => __('Mark Up')))) ?>
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
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
        <?php if (isset($this->data['TradeshowEvent']['id']) && $this->data['TradeshowEvent']['id'] > 0): ?>
          <?= __('Edit event') ?>: #<?= $this->data['TradeshowEvent']['id'] ?>
          <? else: ?>
          <?= __('Add event') ?>
        <?php endif; ?>
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
  <div class="form-group">
    <div class="col col-md-9 col-md-offset-3">
      <label class="required"><?php echo __('Mandatory Fields'); ?></label>
    </div>
  </div>

  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('location', array('label' => array('text' => __('Location')))) ?>
  <?php echo $this->Form->input('description', array('label' => array('text' => __('Description')))) ?>

  <div class="form-group">
    <label class="col col-md-3 control-label text-left"><?php echo __('Thumbnail') ?></label>
    <div class="col col-md-3">
      <?php
      $controller->TradeshowEvent->id = isset($this->data['TradeshowEvent']['id']) ? $this->data['TradeshowEvent']['id'] : 0;

      echo $this->File->linkFileFormElement($controller->TradeshowEvent, 'thumbnail', array());
      ?>
    </div>
  </div>

  <div class="form-group">
    <label for="txt_from_date" class="col col-md-3 control-label text-left"><?php echo __('From date') ?></label>
    <div class="col col-md-3">
      <div class='input-group date' id='div_from_date' data-date-format="YYYY-MM-DD">
        <input value="<?php echo isset($this->data['TradeshowEvent']['from_date']) ? date('Y-m-d', strtotime($this->data['TradeshowEvent']['from_date'])) : '' ?>" name="data[TradeshowEvent][txt_from_date]" id="txt_from_date" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
  </div>

  <div class="form-group">
    <label for="txt_to_date" class="col col-md-3 control-label text-left"><?php echo __('To date') ?></label>
    <div class="col col-md-3">
      <div class='input-group date' id='div_to_date' data-date-format="YYYY-MM-DD">
        <input value="<?php echo isset($this->data['TradeshowEvent']['to_date']) ? date('Y-m-d', strtotime($this->data['TradeshowEvent']['to_date'])) : '' ?>" name="data[TradeshowEvent][txt_to_date]" id="txt_to_date" type='text' class="form-control" readonly="readonly" />
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
  </div>

</div>
<?php
echo $this->Form->input('id', array('type' => 'hidden'));
echo $this->Form->end();
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');

echo $this->Html->script('event.js');
?>
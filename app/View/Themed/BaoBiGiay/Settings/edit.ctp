<h3>
  <? if (isset($this->data['Product']['id']) && $this->data['Product']['id'] > 0): ?>
    <?= __('Edit Settings') ?>: <?= $this->data['Product']['id'] ?>
  <? else: ?>
    <?= __('Add Settings') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
  <?php
  echo $this->Form->create('Settings', array(
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

  <?php echo $this->Form->input('key', array('label' => array('text' => __('Key')))) ?>
  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('val', array('label' => array('text' => __('value')))) ?>
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

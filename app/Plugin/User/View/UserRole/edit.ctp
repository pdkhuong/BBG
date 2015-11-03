<h3>
  <? if (isset($this->data['UserRole']['id']) && $this->data['UserRole']['id'] > 0): ?>
  <?= __('Edit Role' )  ?>: <?= $this->data['UserRole']['name'] ?>
  <? else: ?>
  <?= __('Add Role' )  ?>
  <? endif; ?>
</h3>

<hr />

<div class="well form-horizontal page-body posts form">
  <?php
  echo $this->Form->create('UserRole', array(
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
  <?= $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?= $this->Form->input('description', array('label' => array('text' => ('Description')))) ?>
  <div class="form-group ">
    <div class="col col-md-3 text-left">
      <?php
      echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array('class' => 'btn btn-primary', 'type' => 'submit', 'escape' => false));
      echo ' ';
      echo $this->Html->link(__('Cancel'), Router::url(array("action" => "search")), array('class' => 'btn btn-default'));
      ?>
    </div>
  </div>
<?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  //echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
?>
</div>

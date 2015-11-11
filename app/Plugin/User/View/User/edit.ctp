<h3>
  <? if (isset($this->data['UserModel']['id']) && $this->data['UserModel']['id'] > 0): ?>
    <?= __('Edit User') ?>: <?= $this->data['UserModel']['user_email'] ?>
  <? else: ?>
    <?= __('Add User') ?>
  <? endif; ?>
</h3>

<hr />

<div class="well form-horizontal page-body posts form">

  <?php
  echo $this->Form->create('UserModel', array(
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
  <?= $this->Form->input('user_email', array('label' => array('text' => __('Email')))) ?>
  <?= $this->Form->input('firstname', array('label' => array('text' => __('Fist Name')))) ?>
  <?= $this->Form->input('lastname', array('label' => array('text' => __('Last Name')))) ?>
  <?= $this->Form->input('user_status', array('label' => array('text' => __('Status')), 'options' => Configure::read('User.UserStatus'))) ?>
  <?= $this->Form->input('role', array('label' => array('text' => __('Role')), 'options' => $roles)) ?>
  <?= $this->Form->input('password', array('label' => array('text' => __('Password')), 'autocomplete' => 'off')) ?>

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

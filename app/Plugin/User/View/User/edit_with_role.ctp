<h3>
  <? if (isset($this->data['UserModel']['id']) && $this->data['UserModel']['id'] > 0): ?>
    <?= __('Edit') ?>: <?= $this->data['UserModel']['user_email'] ?>
  <? else: ?>
    <?= __('Add') ?>
  <? endif; ?>
</h3>

<hr />

<div class="posts form">
  <?php
  echo $this->Form->create('UserModel', array(
    'novalidate' => true,
    'inputDefaults' => array(
      'div' => 'form-group',
      'wrapInput' => false,
      'class' => 'form-control'
    ),
    'class' => 'well',
    'type' => 'file'
  ));
  ?>
  <?= $this->Form->input('user_email', array('label' => 'Email')) ?>
  <?= $this->Form->input('user_login', array('label' => 'Usename')) ?>
  <?= $this->Form->input('firstname', array('label' => 'Fist Name')) ?>
  <?= $this->Form->input('lastname', array('label' => 'Last Name')) ?>

  <?= $this->Form->input('role', array('label' => 'Role', 'options' => $roles)) ?>
  <?= $this->Form->input('user_status', array('label' => 'Status', 'options' => Configure::read('User.UserStatus'))) ?>
  <?= $this->Form->input('password', array('label' => 'Password', 'autocomplete' => 'off')) ?>

  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>

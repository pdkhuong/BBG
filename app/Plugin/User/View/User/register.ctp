<div class="container">
  <h3>Register New Account</h3>

  <?php
  echo $this->Form->create('UserModel', array(
    'novalidate' => true,
    'inputDefaults' => array(
      'div' => 'form-group',
      'wrapInput' => array('class' => 'col-sm-5'),
      'class' => 'form-control'
    ),
    'class' => 'form-horizontal'
  ));
  ?>
  <?php echo $this->Form->input('user_email', array(
    'label' => array('text' => 'Email', 'class' => 'col-sm-3 control-label'),
    'type' => 'email',
    'placeholder' => __('Email'),
    ));
  ?>
  <?php echo $this->Form->input('user_login', array(
    'label' => array('text' => 'Username', 'class' => 'col-sm-3 control-label'),
    'placeholder' => __('Username'),
    ));
  ?>
  <?php echo $this->Form->input('firstname', array(
    'label' => array('text' => 'Fist Name', 'class' => 'col-sm-3 control-label'),
    'placeholder' => __('First Name'),
  ));
  ?>
  <?php echo $this->Form->input('lastname', array(
  'label' => array('text' => 'Last Name', 'class' => 'col-sm-3 control-label'),
  'placeholder' => __('Last Name'),
  ));
  ?>
  <?php echo $this->Form->input('password', array(
    'type' => 'password',
    'value' => '',
    'label' => array('text' => 'Password', 'class' => 'col-sm-3 control-label'),
    'placeholder' => __('Password')
  )); ?>
  <?php echo $this->Form->input('password_confirmation', array(
    'type' => 'password',
    'value' => '',
    'label' => array('text' => 'Password Confirmation', 'class' => 'col-sm-3 control-label'),
    'placeholder' => __('Password Confirmation')
  )); ?>

  <div class="form-group">
    <div class = 'col-sm-offset-3 col-sm-5'>
      <?php echo $this->Form->submit(__('Register'), array('class' => 'btn btn-default')); ?>
    </div>
  </div>

  <?php echo $this->Form->end(); ?>
</div>

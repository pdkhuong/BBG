<h3>
  <?= __('User') ?> #<?= $data['UserModel']['id'] ?>
</h3>
<?php
$userStatus = Configure::read('User.UserStatus');
?>
<hr>
<div class="bs-docs-section">
  <div class="bs-callout bs-callout-danger">
    <p><code><?= __('Name') ?></code>: <?= $data['UserModel']['display_name'] ?></p>
    <p><code><?= __('Email') ?></code>: <?= $data['UserModel']['user_email'] ?></p>
    <p><code><?= __('Address') ?></code>: <?= $data['UserModel']['user_login'] ?></p>
    <p><code><?= __('Status') ?></code>: <?= $userStatus[$data['UserModel']['user_status']] ?></p>
  </div>
</div>

<hr />

<?= $this->Html->link(__('Back to list'), Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'index')), array('class' => 'btn btn-primary')) ?> &nbsp;
<?= $this->Html->link(__('Edit'), Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'edit', $data['UserModel']['id'])), array('class' => 'btn btn-primary')) ?> &nbsp;
<?= $this->Html->link(__('Delete'), Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'delete', $data['UserModel']['id'])), array('confirm' => __('Are you sure you want to delete this?'), 'class' => 'btn btn-danger')) ?>

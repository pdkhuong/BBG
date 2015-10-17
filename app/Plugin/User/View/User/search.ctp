<h3>
  <?= __('User list') ?>
</h3>
<hr>
<p><?= $this->Html->link(__('Add'), Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'edit')), array('class' => 'btn btn-primary')) ?></p>

<div class='table-responsive'>
  <table cellpadding='0' cellspacing='0' class='table table-striped table-bordered'>
    <thead>
      <tr>
        <th>ID</th>
        <th><?= __('Name') ?></th>
        <th><?= __('Email') ?></th>
        <th><?= __('Roles') ?></th>
        <th><?= __('Status') ?></th>

        <th class='actions'><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $userStatus = Configure::read('User.UserStatus');
      foreach ($dataList as $data):
        ?>
        <tr>
          <td><?= $data['UserModel']['id'] ?></td>
          <td><?= $this->Html->link($data['UserModel']['display_name'], Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'view', $data['UserModel']['id']))) ?></td>
          <td><?= $data['UserModel']['user_email'] ?></td>
          <td>
            <?php if (isset($selectedRoles[$data['UserModel']['id']])): ?>
              <?php foreach ($selectedRoles[$data['UserModel']['id']] as $role): ?>
                - <?= $role ?> <br />
              <?php endforeach; ?>
            <?php endif; ?>
          </td>
          <td><?= $userStatus[$data['UserModel']['user_status']] ?></td>

          <td class='actions'>
            <?= $this->Html->link(__('Roles'), Router::url(array('plugin' => 'User', 'controller' => 'UserRoleAccess', 'action' => 'editRoles')) . '/' . $data['UserModel']['id'], array('class' => 'btn btn-default btn-xs btn-edit')) ?>
            <?= $this->Html->link(__('Edit'), Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'edit')) . '/' . $data['UserModel']['id'], array('class' => 'btn btn-default btn-xs btn-edit')) ?>
            <?= $this->Form->postLink(__('Delete'), Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'delete')) . '/' . $data['UserModel']['id'], array('class' => 'btn btn-default btn-xs btn-delete'), __('Are you sure you want to delete #%s?', $data['UserModel']['id'])) ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>

    <?php if ($this->Paginator->param('pageCount') > 1): ?>
      <tfoot>
        <tr>
          <td colspan='6'>
            <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
          </td>
        </tr>
      </tfoot>
    <? endif; ?>

  </table>
</div>
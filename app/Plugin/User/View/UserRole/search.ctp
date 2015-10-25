<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('User Role List') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('plugin' => 'User', 'controller' => 'UserRole', 'action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false, 'id' => '_addProduct')); ?>
    </div>
  </div>
</div>

<div class='table-responsive'>
  <table cellpadding='0' cellspacing='0' class='table table-striped table-bordered'>
    <thead>
      <tr>
        <th>ID</th>
        <th><?= __('Name') ?></th>
        <th><?= __('Description') ?></th>

        <th class='actions'><?php echo __('Actions'); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($dataList as $data):
        ?>
        <tr>
          <td><?= $data['UserRole']['id'] ?></td>
          <td><?= $data['UserRole']['name'] ?></td>
          <td><?= $data['UserRole']['description'] ?></td>


          <td class='actions'>
            <?php if ($data['UserRole']['id'] != USER_ROLE_ANONYM): ?>
              <?= $this->Html->link(__('Permission'), Router::url(array('plugin' => 'User', 'controller' => 'UserRoleRight', 'action' => 'edit')) . '/' . $data['UserRole']['id'], array('class' => 'btn btn-default btn-xs btn-edit')) ?>
              <?= $this->Html->link(__('Edit'), Router::url(array('plugin' => 'User', 'controller' => 'UserRole', 'action' => 'edit')) . '/' . $data['UserRole']['id'], array('class' => 'btn btn-default btn-xs btn-edit')) ?>
              <?= $this->Form->postLink(__('Delete'), Router::url(array('plugin' => 'User', 'controller' => 'UserRole', 'action' => 'delete')) . '/' . $data['UserRole']['id'], array('class' => 'btn btn-default btn-xs btn-delete'), __('Are you sure you want to delete #%s?', $data['UserRole']['id'])) ?>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>

    <?php if ($this->Paginator->param('pageCount') > 1): ?>
      <tfoot>
        <tr>
          <td colspan='4'>
            <?php echo $this->Paginator->first('<<'); ?>
            <?php echo $this->Paginator->numbers(); ?>
            <?php echo $this->Paginator->last('>>'); ?>
          </td>
        </tr>
      </tfoot>
    <? endif; ?>

  </table>
</div>

<h3>
  <?= __('Log') ?>
</h3>
<hr>
<div class="col-md-10">
<?php echo $this->Form->create('LogModel', array(
        'novalidate'    => true,
        'url' => Router::url(array('plugin'=>'DBlogger', 'controller'=>'DBlogger', 'action'=>'index')),
        'type' => 'get',
        'class' => 'form-horizontal',
    ));
?>
        <?php echo $this->Form->input('message.log', array(
                'div'=>'col-sm-4',
                'class'=>'form-control',
                'label'=>array('text'=>__('Message')),
                'type'=>'text',
                'placeholder'=>'Type Sth here'
                ));
        ?>
        <?php echo $this->Form->input('user_id.id', array(
                'div'=>'col-sm-2',
                'class'=>'form-control',
                'label'=>array('text'=>__('UserID')),
                'type'=>'number',
                'placeholder'=>'Type a number'
                ));
        ?>
        <?php echo $this->Form->input('type', array(
                'options' => Configure::read('DBlogger.Types'),
                'empty' => __('Default'),
                'div'=>'col-sm-3',
                'class'=>'form-control',
                ));

        ?>
        <?php
            $options = array(
                'div'   => 'col-sm-1',
                'label' => 'Search',
                'class' => 'btn btn-primary pull-right',
                'style' => 'margin-top: 1.9em; margin-bottom: 1em'
            );
            echo $this->Form->end($options);
        ?>
</div>
<div class='table-responsive'>
    <br/>
  <table cellpadding='0' cellspacing='0' class='table table-striped table-bordered'>
    <thead>
      <tr>
        <td colspan="4" class="text-right">
          <?= $this->Html->link(__('Keep 10,000 rows'), Router::url(array('plugin' => 'DBlogger', 'controller' => 'DBlogger', 'action' => 'keep', 10000)), array('class' => 'btn btn-default btn-xs btn-edit')) ?>
          <?= $this->Html->link(__('Keep 100,000 rows'), Router::url(array('plugin' => 'DBlogger', 'controller' => 'DBlogger', 'action' => 'keep', 100000)), array('class' => 'btn btn-default btn-xs btn-edit')) ?>
        </td>
      </tr>
      <tr>
        <th>ID</th>
        <th><?= __('Message') ?></th>
        <th><?= __('Created') ?></th>
        <th><?= __('URI') ?></th>
      </tr>
    </thead>
    <tbody>
      <?php
      $userStatus = Configure::read('User.UserStatus');
      foreach ($dataList as $data):
        ?>
        <tr>
          <td><?= $data['LogModel']['id'] ?></td>
          <td><a href="<?= Router::url(array('plugin' => 'DBlogger', 'controller' => 'DBlogger', 'action' => 'detail', $data['LogModel']['id']), true) ?>" target="_blank"><?= nl2br(substr($data['LogModel']['message'], 0, 160)) ?>...</a></td>
          <td><?= $data['LogModel']['created_time'] ?></td>
          <td><?= $data['LogModel']['uri'] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>

    <?php if ($this->Paginator->param('pageCount') > 1): ?>
      <tfoot>
        <tr>
          <td colspan='6'>
            <?php
                echo $this->Paginator->pagination(array('ul' => 'pagination'));?>
          </td>
        </tr>
      </tfoot>
    <? endif; ?>

  </table>
</div>

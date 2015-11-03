<h3>
  <?= __('Product') ?> #<?= $data['Product']['id'] ?>
</h3>
<hr>
<div class='table-responsive'>
  <table cellpadding='0' cellspacing='0' class='table table-striped table-bordered'>
    <thead>
    <tr>
      <th width="30%"><?php echo __('Properties') ?></th>
      <th width="70%"><?php echo __('Value') ?></th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td>Code</td>
        <td><?= $data['Product']['item_no'] ?></td>
      </tr>
      <tr>
        <td>Name</td>
        <td><?= $data['Product']['name'] ?></td>
      </tr>
      <tr>
        <td>Specification</td>
        <td><?= $data['Product']['specification'] ?></td>
      </tr>
      <tr>
        <td>Unit</td>
        <td><?= $data['ProductUnit']['name'] ?></td>
      </tr>
      <tr>
        <td>Customer</td>
        <td><?= $data['Customer']['name'] ?></td>
      </tr>
      <tr>
        <td>Staff Member</td>
        <td><?= $data['User']['display_name'] ?></td>
      </tr>
      <tr>
        <td>Quantity</td>
        <td><?= vnNumberFormat($data['Product']['quantity'], 0) ?></td>
      </tr>
      <tr>
        <td>Price</td>
        <td><?= vnNumberFormat($data['Product']['price'], 0) ?></td>
      </tr>
      <tr>
        <td>Layout</td>
        <td>
          <?php if(isset($data['File']['id']) && $data['File']['file_path'] && file_exists($data['File']['file_path'])) :?>
            <a href="/<?php echo $data['File']['file_path']?>"><?php echo $data['File']['original_filename']?></a>
          <?php endif;?>
        </td>
      </tr>
    </tbody>

  </table>
</div>

<?= $this->Html->link(__('Back to list'), Router::url(array('plugin' => false, 'controller' => 'Product', 'action' => 'index')), array('class' => 'btn btn-primary')) ?> &nbsp;

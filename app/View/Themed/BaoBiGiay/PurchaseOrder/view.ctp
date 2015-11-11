<h3>
  <?= __('Purchase Order') ?>: <?= $data['PurchaseOrder']['order_no'] ?>
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
        <td>Order No.</td>
        <td><?= $data['PurchaseOrder']['order_no'] ?></td>
      </tr>
      <tr>
        <td>Customer</td>
        <td><?= $data['Customer']['name'] ?></td>
      </tr>
      <tr>
        <td>Buyer Name</td>
        <td><?= $data['PurchaseOrder']['buyer_name'] ?></td>
      </tr>
      <tr>
        <td>Order Date (YYYY-MM-DD)</td>
        <td><?= reformatDate($data['PurchaseOrder']['order_date']); ?></td>
      </tr>
      <tr>
        <td>Received Date (YYYY-MM-DD)</td>
        <td><?= reformatDate($data['PurchaseOrder']['received_date']); ?></td>
      </tr>
      <tr>
        <td>Terms</td>
        <td><?= $data['PurchaseOrder']['term'] ?></td>
      </tr>
      <tr>
        <td>Ship Via</td>
        <td><?= $shipType[$data['PurchaseOrder']['ship_via']]; ?></td>
      </tr>

      <tr>
        <td>Staff Member</td>
        <td><?= $data['User']['display_name'] ?></td>
      </tr>
    </tbody>

  </table>
  Added Product(s):
  <div class='table-responsive well'>
    <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
      <thead>
      <tr>
        <th width="10%"><?php echo __('ID') ?></th>
        <th width="20%"><?php echo __('No.') ?></th>
        <th width="25%"><?php echo __('Name') ?></th>
        <th width="10%"><?php echo __('Unit') ?></th>
        <th width="15%"><?php echo __('Num Of Product'); ?></th>
        <th width="20%"><?php echo __('Total Price'); ?></th>
      </tr>
      </thead>
      <tbody id="_bodyAddedProduct">
      <?php
      if($addedProducts):
        $totalPrice = 0;
        foreach($addedProducts as $productId => $addedProduct):
          $price = $addedProduct['price'];
          $totalPrice += $price;
          ?>
          <tr>
            <td><?php echo $productId?></td>
            <td><?php echo $addedProduct['Product']['item_no']?></td>
            <td><?php echo $addedProduct['Product']['name']?></td>
            <td><?php echo $addedProduct['ProductUnit']['name']?></td>
            <td><?php echo $addedProduct['numOfProduct']?></td>
            <td><?php  echo $price ? $price : 'N/A'?></td>
          </tr>
        <?php endforeach;?>
      <?php endif;?>
      <tr>
        <td><b>Sum</b></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td><b><?php echo vnNumberFormat($totalPrice, 0)?></b></td>
      </tr>
      </tbody>
    </table>
  </div>
</div>

<?= $this->Html->link(__('Back to list'), Router::url(array('plugin' => false, 'controller' => 'PurchaseOrder', 'action' => 'index')), array('class' => 'btn btn-primary')) ?> &nbsp;

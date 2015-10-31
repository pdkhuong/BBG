<table cellpadding='20' cellspacing='3' width="100%">
  <tr>
    <td>Khách hàng: <b><?php echo $data['Customer']['name']?></b></td>
    <td></td>
  </tr>
  <tr>
    <td>Mã Khách hàng: <b><?php echo $data['Customer']['code']?></b></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Danh sách sản phẩm:</b></td>
    <td></td>
  </tr>
</table>
<table cellpadding='0' cellspacing='0' width="90%" border="1px">
  <thead>
    <tr>
      <th width="5%"> STT</th>
      <th width="10%"> Mã SP</th>
      <th width="25%"> Tên SP</th>
      <th width="20%"> Qui Cách SP</th>
      <th width="10%"> Đơn Vị</th>
      <th width="15%"> Số Lượng</th>
      <th width="15%"> Giá</th>
    </tr>
  </thead>
  <?php if($productItems):
    $stt = 0;
    foreach($productItems as $product):
      $stt ++;
      ?>
  <tr>
    <td width="5%"> <?php echo $stt?></td>
    <td width="10%"> <?php echo $product['Product']['item_no']?></td>
    <td width="25%"> <?php echo $product['Product']['name']?></td>
    <td width="20%"> <?php echo $product['Product']['specification']?></td>
    <td width="10%"> <?php echo $listUnit[$product['Product']['product_unit_id']]['name']?></td>
    <td width="15%"> <?php echo vnNumberFormat($product['FacsimileMassageProduct']['num_item'], 0)?></td>
    <td width="15%"> <?php echo $product['FacsimileMassageProduct']['price'] ? vnNumberFormat($product['FacsimileMassageProduct']['price']) : 'N/A' ?></td>
  </tr>
  <?php endforeach;?>
  <?php endif;?>
</table>

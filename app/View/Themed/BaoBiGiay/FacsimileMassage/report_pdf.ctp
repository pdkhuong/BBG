<table cellpadding="1" cellspacing="1" width="100%">
  <tr>
    <td><b>To: <?php echo $data['Customer']['name']?></b></td>
    <td><b>Date: <?php echo date('d M Y', time())?></b></td>
  </tr>
  <tr>
    <td><b>Attn: <?php echo $data['FacsimileMassage']['attn']?></b></td>
    <td><b>Fax No: <?php echo $data['Customer']['fax']?></b></td>
  </tr>
  <tr>
    <td><b>From: <?php echo $data['User']['display_name']?></b></td>
    <td><b>No Of Page(S): <?php echo $totalPage?></b></td>
  </tr>
  <tr>
    <td colspan="2">_______________________________________________________________________________</td>
  </tr>
  <tr>
    <td colspan="2"><b><i>Theo yêu cầu của Quí Công Ty chúng tôi xin hân hạnh báo giá bao bì in offset do chúng tôi
          <br> sản xuất và cung cấp cụ thể như sau:</i></b>
    </td>
  </tr>
</table>

<br>
<br>
<table cellpadding="2" width="90%" border="1px">
  <thead>
    <tr>
      <th width="5%" align="center"> STT</th>
      <th width="30%" align="center"> Chủng Loại</th>
      <th width="25%" align="center"> Kết Cấu</th>
      <th width="5%" align="center"> Số Màu</th>
      <th width="15%" align="center"> Số Lượng</th>
      <th width="20%" align="center"> Giá Trước VAT</th>
    </tr>
  </thead>
  <?php if($productItems):
    $stt = 0;
    foreach($productItems as $product):
      $stt ++;
      ?>
  <tr>
    <td width="5%" align="center"> <?php echo $stt?></td>
    <td width="30%" align="center"> <?php echo $product['Product']['name']?> <br> <?php echo $product['Product']['specification']?></td>
    <td width="25%" align="center"> <?php echo nl2br($product['Product']['structure'])?></td>
    <td width="5%" align="center"> <?php echo $product['FacsimileMassageProduct']['num_color']?></td>
    <td width="15%" align="center"> <?php echo vnNumberFormat($product['FacsimileMassageProduct']['num_item'], 0)?></td>
    <td width="20%" align="center"> <?php echo $product['FacsimileMassageProduct']['price'] ? vnNumberFormat($product['FacsimileMassageProduct']['price']) : 'N/A' ?></td>
  </tr>
  <?php endforeach;?>
  <?php endif;?>
</table>

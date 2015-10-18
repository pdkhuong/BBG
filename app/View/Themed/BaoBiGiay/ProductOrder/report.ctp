<table cellpadding='20' cellspacing='3' width="100%">
  <tr>
    <td>Khách hàng: <b><?php echo $data['Customer']['name']?></b></td>
    <td> Số <b><?php echo $data['ProductOrder']['order_no']?></b></td>
  </tr>
  <tr>
    <td>Mã Khách hàng: <b><?php echo $data['Customer']['code']?></b></td>
    <td></td>
  </tr>
  <tr>
    <td>Mã Sản Phẩm: <b><?php echo $data['OutputProduct']['item_no']?></b></td>
    <td>Tên sản phẩm <b><?php echo $data['OutputProduct']['name']?></b></td>
  </tr>
  <tr>
    <td>Qui cách sản phẩm: <b><?php echo $data['OutputProduct']['specification']?></b></td>
    <td></td>
  </tr>
  <tr>
    <td>Số lượng: <b><?php echo number_format($data['ProductOrder']['num_product'], 0, '.', '.')?>
        (giá <?php echo number_format($data['OutputProduct']['price'], 2, ',', '.')?>vnđ)</b>
    </td>
    <td>ĐVT: <b><?php echo $listUnit[$data['OutputProduct']['product_unit_id']]['name']?></b></td>
  </tr>
  <tr>
    <td>Ngày giao: <b><?php echo reformatDate($data['ProductOrder']['delivery_date'], 'd/m/Y')?></b></td>
    <td>Nơi giao: <b><?php echo $data['ProductOrder']['delivery_location']?></b></td>
  </tr>
  <tr>
    <td>Số lượng cho phép chênh lệch: <b><?php echo $data['ProductOrder']['difference_percent']?>%</b></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Yêu cầu giấy:</b></td>
    <td></td>
  </tr>
  <tr>
    <td>Giấy mặt: <?php echo $data['InputProduct']['name']?></td>
    <td></td>
  </tr>
  <tr>
    <td>Qui cách: <?php echo $data['InputProduct']['specification']?></td>
    <td></td>
  </tr>
  <tr>
    <td>Ra: <?php echo $data['ProductOrder']['output_product_note']?></td>
    <td></td>
  </tr>
  <tr>
    <td>Số lượng: <?php echo number_format($reportNum, 2, ',', '.')?> Tấm (tờ in) </td>
    <td></td>
  </tr>
  <tr>
    <td>Hao phí: <?php echo number_format($haoPhi, 2, ',', '.')?> tờ</td>
    <td></td>
  </tr>
  <tr>
    <td><b>Công đoạn sản xuất:</b></td>
    <td></td>
  </tr>
</table>
<table cellpadding='0' cellspacing='0' width="90%" border="1px">
  <thead>
    <tr>
      <th width="10%"> STT</th>
      <th width="30%"> Công đoạn</th>
      <th width="20%"> Tại</th>
      <th width="30%"> Ghi chú</th>
    </tr>
  </thead>
  <?php if($orderProgress):
    $stt = 0;
    foreach($orderProgress as $progress):
      $stt ++;
      ?>
  <tr>
    <td width="10%"> <?php echo $stt?></td>
    <td width="30%"> <?php echo $progress['ProductOrderProgress']['name']?></td>
    <td width="20%"> <?php echo $progress['ProductOrderProgress']['location']?></td>
    <td width="30%"> <?php echo $progress['ProductOrderProgress']['description']?></td>
  </tr>
  <?php endforeach;?>
  <?php endif;?>
</table>
<b><u>Ghi chú đặt biệt: </u></b>

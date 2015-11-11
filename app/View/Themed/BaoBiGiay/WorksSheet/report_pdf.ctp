<table cellpadding="1" cellspacing="1" width="100%">
  <tr>
    <td>Khách hàng: <b><?php echo $data['Customer']['name']?></b></td>
    <td>Số: <b><?php echo $data['WorksSheet']['auto_code']?></b></td>
  </tr>
  <tr>
    <td>Mã Khách hàng: <b><?php echo $data['Customer']['code']?></b></td>
    <td>Order No.: <b><?php echo $productPO['PurchaseOrder']['order_no']?></b></td>
  </tr>
  <tr>
    <td>Mã Sản Phẩm: <b><?php echo $data['Product']['item_no']?></b></td>
    <td>Tên sản phẩm: <b><?php echo $data['Product']['name']?></b></td>
  </tr>
  <tr>
    <td>Qui cách sản phẩm: <b><?php echo $data['Product']['specification']?></b></td>
    <td></td>
  </tr>
  <tr>
    <td>Số lượng: <b><?php echo vnNumberFormat($costingProduct['Costing']['quantity'], 0)?>
        (giá: <?php echo vnNumberFormat($costingProduct['Costing']['selling_price'], 0, ',', '.')?>vnđ)</b>
    </td>
    <td>ĐVT: <b><?php echo $listUnit[$data['Product']['product_unit_id']]['name']?></b></td>
  </tr>
  <tr>
    <td>Ngày giao (d/m/Y): <b><?php echo reformatDate($data['WorksSheet']['delivery_date'], 'd/m/Y')?></b></td>
    <td>Nơi giao: <b><?php echo $data['WorksSheet']['delivery_location']?></b></td>
  </tr>
  <tr>
    <td>Số lượng cho phép chênh lệch: <b><?php echo $data['WorksSheet']['difference_percent']?>%</b></td>
    <td></td>
  </tr>
  <tr>
    <td><b>Yêu cầu giấy:</b></td>
    <td></td>
  </tr>
  <tr>
    <td>Giấy mặt: <?php echo $paperName[$data['Product']['paper_name']].' '.$costingProduct['Costing']['paper_substance']?>gsm</td>
    <td>
      <?php
      if($costingProduct['Costing']['b_flute_substance']){
        echo 'Giấy sóng: '.$costingProduct['Costing']['b_flute_substance'].' cm';
      }elseif($costingProduct['Costing']['e_flute_substance']){
        echo 'Giấy sóng: '.$costingProduct['Costing']['e_flute_substance'].' cm';
      }
      ?>
    </td>
  </tr>
  <tr>
    <td>Qui cách: <?php echo $costingProduct['Costing']['paper_length'].' x '.$costingProduct['Costing']['paper_width']?> cm</td>
    <td>Qui cách: <?php echo ($costingProduct['Costing']['paper_length'] - 0.5).' x '.($costingProduct['Costing']['paper_width'] - 0.5)?> cm</td>
  </tr>
  <tr>
    <td>Ra: <?php echo $costingProduct['Costing']['paper_cutting'] ." Con/tờ in"?></td>
    <td></td>
  </tr>
  <tr>
    <td>Số lượng: <?php echo vnNumberFormat($reportNum, 0)?> Tấm (tờ in) </td>
    <td>Số lượng: <?php echo vnNumberFormat($reportNum - $haoPhi, 0)?> Tấm (tờ in) </td>
  </tr>
  <tr>
    <td>Hao phí: <?php echo vnNumberFormat($haoPhi, 0)?> tờ</td>
    <td></td>
  </tr>
  <tr>
    <td><b>Công đoạn sản xuất:</b></td>
    <td></td>
  </tr>
</table>
<table cellpadding="1" cellspacing="0" width="90%" border="1px">
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
        <td width="30%"> <?php echo $progress['WorksSheetProgress']['name']?></td>
        <td width="20%"> <?php echo $progress['Vendor']['name']?></td>
        <td width="30%"> <?php echo $progress['WorksSheetProgress']['description']?></td>
      </tr>
    <?php endforeach;?>
  <?php endif;?>
</table>
<b><u>Ghi chú đặt biệt: </u></b>
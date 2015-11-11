<h3>
  <? if (isset($this->data['FacsimileMassage']['id']) && $this->data['FacsimileMassage']['id'] > 0): ?>
    <?= __('Edit Facsimile Massage') ?>: <?= $this->data['FacsimileMassage']['name'] ?>
  <? else: ?>
    <?= __('Add Facsimile Massage') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
  <?php
    echo $this->Form->create('FacsimileMassage', array(
    'novalidate' => true,
    'inputDefaults' => array(
      'div' => 'form-group',
      'label' => array(
        'class' => 'col col-md-3 control-label text-left'
      ),
      'wrapInput' => 'col col-md-9',
      'class' => 'form-control'
    ),

  ));
  ?>
    <?php
    if($listUser){
      echo $this->Form->input('user_id',
        array(
          'options' => $listUser,
          'empty' => __("Please select staff member ..."),
          'label' => array('text' => __('Staff Member'))
        )
      );
    }
    ?>
    <?php
    echo $this->Form->input('customer_id',
      array('options' => $listCustomer,
        'selected'=>NULL,
        'label' => array('text' => __('Customer')),
        'empty' => __("Please select customer..."),
      )
    );
    ?>
    <?php echo $this->Form->input('attn', array('label' => array('text' => __('Attn')))) ?>
    <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
    <?php echo $this->Form->input('num_color', array('label' => array('text' => __('Number Color')))) ?>


  Added Product(s):
  <div class='table-responsive well'>
    <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
      <thead>
      <tr>
        <th width="5%"><?php echo __('ID') ?></th>
        <th width="10%"><?php echo __('No.') ?></th>
        <th width="20%"><?php echo __('Name') ?></th>
        <th width="10%"><?php echo __('Unit') ?></th>
        <th width="25%"><?php echo __('Specification') ?></th>
        <th width="20%"><?php echo __('Quantity'); ?></th>
        <th width="10%">Action</th>
      </tr>
      </thead>
      <tbody id="_bodyAddedProduct">
      <?php if($addedProducts):?>
        <?php foreach($addedProducts as $productId => $addedProduct):?>
          <tr>
            <td><?php echo $productId?></td>
            <td><?php echo $addedProduct['Product']['item_no']?></td>
            <td><?php echo $addedProduct['Product']['name']?></td>
            <td><?php echo $addedProduct['ProductUnit']['name']?></td>
            <td><?php echo $addedProduct['Product']['specification']?></td>
            <td>
              <input type="text" maxlength=10 name="data[Product][num_item][<?php echo $productId?>][]" value="<?php echo $addedProduct['numOfProduct']?>"/>
            </td>
            <td><a class="btn btn-default btn-sm _removeProduct2"> Remove </a></td>
          </tr>
        <?php endforeach;?>
      <?php endif;?>
      </tbody>
    </table>
  </div>

  List Product:
  <div class='table-responsive well'>
    <table id="_product_dt" cellpadding='0' cellspacing='0' class='table items-table' data-nosearchable="0,4" data-nosortable="0,4" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
      <thead>
      <tr>
        <th width="5%"><?php echo __('ID') ?></th>
        <th width="20%"><?php echo __('No.') ?></th>
        <th width="30%"><?php echo __('Name') ?></th>
        <th width="10%"><?php echo __('Unit') ?></th>
        <th width="15%"><?php echo __('Specification') ?></th>
        <th width="10%">Action</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($listProduct as $data):
        ?>
        <tr>
          <td><?php echo ($data['Product']['id']); ?></td>
          <td><?php echo ($data['Product']['item_no']); ?></td>
          <td><?php echo ($data['Product']['name']); ?></td>
          <td><?php echo ($data['ProductUnit']['name']); ?></td>
          <td><?php echo ($data['Product']['specification']); ?></td>
          <td>
            <a class="btn btn-default btn-sm _addProduct2">Add product</a>
          </td>
        </tr>
        <?php
      endforeach;
      ?>
      </tbody>
    </table>
  </div>
  <div class="form-group ">
    <div class="col col-md-3 text-left">
      <?php
      echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array('class' => 'btn btn-primary', 'type' => 'submit', 'escape' => false));
      echo ' ';
      echo $this->Html->link(__('Cancel'), Router::url(array("action" => "index")), array('class' => 'btn btn-default'));
      ?>
    </div>
  </div>
  <?php
    echo $this->Form->input('id', array('type' => 'hidden'));
    //echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary', 'id' => "_submit"));
    echo $this->Form->end();
  ?>
</div>
<?php
$this->HTML->script('libs/jquery.dataTables.min', array('inline' => false));
$this->HTML->script('libs/dataTables.bootstrap.min', array('inline' => false));
$this->HTML->script('datatables.js', array('inline' => false));
$this->HTML->css('dataTables.bootstrap.min', array('inline' => false));

echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>
<script id="tableRowTemplate" type="text/x-jQuery-tmpl">
  <tr>
    <td>
      ${id}
    </td>
    <td>${item_no}</td>
    <td>${name}</td>
    <td>${unit_name}</td>
    <td>${spec}</td>
    <td>
      <input data-id="${id}" type="text" maxlength=10 name="data[Product][num_item][${id}][]" />
    </td>
    <td><a class="btn btn-default btn-sm _removeProduct2"> Remove </a></td>
  </tr>
</script>
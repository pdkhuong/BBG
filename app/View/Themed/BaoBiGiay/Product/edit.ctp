<h3>
  <? if (isset($this->data['Product']['id']) && $this->data['Product']['id'] > 0): ?>
    <?= __('Edit Product') ?>: <?= $this->data['Product']['name'] ?>
  <? else: ?>
    <?= __('Add Product') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
  echo $this->Form->create('Product', array(
    'novalidate' => true,
    'inputDefaults' => array(
      'div' => 'form-group',
      'label' => array(
        'class' => 'col col-md-3 control-label text-left'
      ),
      'wrapInput' => 'col col-md-9',
      'class' => 'form-control'
    ),
    'type' => 'file'
  ));
  ?>

  <?php echo $this->Form->input('item_no', array('maxlength' =>6, 'label' => array('text' => __('Item No.')))) ?>
  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('specification', array('label' => array('text' => __('Specification')))) ?>
  <?php echo $this->Form->input('length', array('label' => array('text' => __('Specification Length (cm)')))) ?>
  <?php echo $this->Form->input('width', array('label' => array('text' => __('Specification Width (cm)')))) ?>
  <?php
  echo $this->Form->input('paper_name',
    array('options' => $paperName,
      'selected'=>NULL,
      'empty' => __("Please select ..."),
      'label' => array('text' => __('Paper Name'))
    )
  );
  ?>
  <?php echo $this->Form->input('substance', array('label' => array('text' => __('Substance (gsm)')))) ?>
  <?php echo $this->Form->input('structure', array('rows' =>2, 'label' => array('text' => __('Structure')))) ?>
  <?php
  echo $this->Form->input('product_unit_id',
    array('options' => $listUnit,
      'selected'=>NULL,
      'empty' => __("Please select ..."),
      array('require'=>true, 'allowEmpty'=>false),
    )
  );
  ?>
  <?php
  if($listUser){
    echo $this->Form->input('user_id',
      array(
        'options' => $listUser,
        'empty' => __("Select Staff ..."),
        'label' => array('text' => __('Staff Member'))
      )
    );
  }
  ?>
  <?php
  echo $this->Form->input('customer_id',
    array(
      'options' => $listCustomer,
      'empty' => __("Select Customer ..."),
      'label' => array('text' => __('Customer'))
    )
  );
  ?>
  <?php echo $this->Form->input('price', array('label' => array('text' => __('Price')))) ?>
  <?php if($this->data && isset($this->data['File']['id']) && $this->data['File']['id'] && $this->data['File']['file_path'] && file_exists($this->data['File']['file_path'])) :?>
    <div class="form-group">
      <label class="col col-md-3 control-label text-left">Current Layout</label>
      <div class="col col-md-9">
        <a href="/<?php echo $this->data['File']['file_path']?>"><?php echo $this->data['File']['original_filename']?></a>
      </div>
    </div>

  <?php endif;?>

  <?php echo $this->Form->input('file', array('name' => 'file_upload', 'type' => 'file', 'label' => array('text' => __('Layout')))) ?>

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
  echo $this->Form->end();
  ?>
</div>

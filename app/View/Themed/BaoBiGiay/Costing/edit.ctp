<h3>
  <? if (isset($this->data['Product']['id']) && $this->data['Product']['id'] > 0): ?>
    <?= __('Edit Product') ?>: <?= $this->data['Product']['id'] ?>
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
  ));
  ?>

  <?php echo $this->Form->input('item_no', array('label' => array('text' => __('Item No.')))) ?>
  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('description', array('label' => array('text' => __('Description')))) ?>
  <?php
  echo $this->Form->input('product_unit_id',
    array('options' => $listUnit,
      'selected'=>NULL,
      'empty' => __("Please select ..."),
      array('require'=>true, 'allowEmpty'=>false),
    )
  );
  ?>
  <?php echo $this->Form->input('price', array('label' => array('text' => __('Price')))) ?>

  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>

<h3>
	<?php if (isset($this->data['Lead']['id']) && $this->data['Lead']['id'] > 0): ?>
		<?php echo __('Chỉnh sửa khách hàng tiềm năng') ?>: <?= $this->data['Lead']['name'] ?>
		<?php else: ?>
		<?php  echo __('Thêm khách hàng tiềm năng') ?>
	<?php endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
echo $this->Form->create('Lead', array(
  'novalidate' => true,
  'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
      'class' => 'col col-md-3 control-label text-left'
    ),
    'wrapInput' => 'col col-md-9',
    'class' => 'form-control'
  )
));
  ?>

  <?php echo $this->Form->input('name', array('label' => array('text' => __('Tên')))) ?>
  <?php echo $this->Form->input('code', array('label' => array('text' => __('Code')))) ?>
  <?php echo $this->Form->input('email', array('label' => array('text' => __('Email')))) ?>
  <?php echo $this->Form->input('phone', array('label' => array('text' => __('Điện thoại')))) ?>
  <?php echo $this->Form->input('fax', array('label' => array('text' => __('Fax')))) ?>
  <?php echo $this->Form->input('address', array('label' => array('text' => __('Địa chỉ')))) ?>
  <?php echo $this->Form->input('info', array('rows' => '5', 'type' => 'textarea', 'label' => array('text' => __('Thông tin')))) ?>

  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>

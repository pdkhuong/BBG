<h3>
	<?php if (isset($this->data['Vendor']['id']) && $this->data['Vendor']['id'] > 0): ?>
		<?php echo __('Edit Vendor') ?>: <?= $this->data['Vendor']['name'] ?>
		<?php else: ?>
		<?php  echo __('Add Vendor') ?>
	<?php endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
echo $this->Form->create('Vendor', array(
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

  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('code', array('label' => array('text' => __('Code')))) ?>
  <?php echo $this->Form->input('email', array('label' => array('text' => __('Email')))) ?>
  <?php echo $this->Form->input('phone', array('label' => array('text' => __('Phone')))) ?>
  <?php echo $this->Form->input('fax', array('label' => array('text' => __('Fax')))) ?>
  <?php echo $this->Form->input('address', array('label' => array('text' => __('Address')))) ?>
  <?php echo $this->Form->input('info', array('rows' => '5', 'type' => 'textarea', 'label' => array('text' => __('Information')))) ?>

  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>

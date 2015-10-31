<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
		<h3>
		  <?php if (isset($this->data['Calendar']['id']) && $this->data['Calendar']['id'] > 0): ?>
			<?php echo __('Edit Calendar') ?>: <?php echo $this->data['Calendar']['id'] ?>
		  <?php else: ?>
			<?php echo __('Add Calendar') ?>
		  <?php endif; ?>
		</h3>
    </div>
    <div class="col-md-3 text-right">
      <?php
	  if (isset($this->data['Calendar']['id']) && $this->data['Calendar']['id'] > 0){
		echo $this->Form->postLink('<i class="fa fa-trash-o"></i> ' .__('Delete'), Router::url(array('action' => 'delete')) . '/' . $this->data['Calendar']['id'], array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false), __('Are you sure you want to delete #%s?', $this->data['Calendar']['id']));
	  }
	  ?>
    </div>
  </div>
</div>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
  echo $this->Form->create('Calendar', array(
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

	<?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>	
	<?php
	$isErrorFromDate = isset($errorObj['from_date']) ? TRUE : FALSE;
	?>
	<div class="form-group required <?php if($isErrorFromDate) echo 'has-error error' ?>">
		<label class="col col-md-3 control-label text-left"><?php echo __('From Date') ?></label>
		<div class="col col-md-3">
		  <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD HH:mm:00">
			<input value="<?php echo isset($this->data['Calendar']['from_date']) && $this->data['Calendar']['from_date'] ? $this->data['Calendar']['from_date'] : '' ?>" name="data[Calendar][from_date]" type='text' class="form-control" readonly="readonly"/>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		  </div>
		</div>
		<div class="col col-md-6">
		  <?php if($isErrorFromDate):?>
			<span class="help-block text-danger"><?php echo $errorObj['from_date'][0]?></span>
		  <?php endif;?>
		</div>
	</div>
	<?php
	$isErrorToDate = isset($errorObj['to_date']) ? TRUE : FALSE;
	?>
	<div class="form-group required <?php if($isErrorToDate) echo 'has-error error' ?>">
		<label class="col col-md-3 control-label text-left"><?php echo __('To Date') ?></label>
		<div class="col col-md-3">
		  <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD HH:mm:00">
			<input value="<?php echo isset($this->data['Calendar']['to_date']) && $this->data['Calendar']['to_date'] ? $this->data['Calendar']['to_date'] : '' ?>" name="data[Calendar][to_date]" type='text' class="form-control" readonly="readonly"/>
			<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
		  </div>
		</div>
		<div class="col col-md-6">
		  <?php if($isErrorToDate):?>
			<span class="help-block text-danger"><?php echo $errorObj['to_date'][0]?></span>
		  <?php endif;?>
		</div>
	</div>
	<?php echo $this->Form->input('description', array('rows' => '2', 'type' => 'textarea', 'label' => array('text' => __('Description')))) ?>
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
<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('calendar.js');
?>
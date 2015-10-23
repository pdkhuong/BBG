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
	<h4><?php echo __('Customers'); ?></h4>
	<div class='table-responsive well'>
		<table cellpadding='0' cellspacing='0' class='table'>
		  <thead>
		  <tr>
			<th width="80%"><?php echo __('Name') ?></th>
			<th width="20%"><?php echo __('Actions') ?></th>
		  </tr>
		  </thead>
		  <tbody id="_bodyAddedCustomer">
		  <?php if($addedCustomer):?>
			<?php foreach($addedCustomer as $customerId => $customer):?>
			  <tr id="_row_<?php echo $customerId?>">
				<td>
				  <?php echo $customer['name']?>
				  <?php echo $this->Form->input("CalendarCustomer.{$customerId}.customer_id", array('type' => 'hidden', 'value' => $customer['customer_id']));?>
				</td>
				<td>
				  <a class="btn btn-default btn-sm _removeCustomer"> Remove </a>
				</td>
			  </tr>
			<?php endforeach;?>
		  <?php endif;?>
		  </tbody>
		</table>
	</div>
	<div class="form-group">
		<div class="col col-md-9">
		</div>
		<div class="col-md-3 text-right">
		  <button type="button" class="btn btn-default btn-sm _addCustomer" data-toggle="modal" data-target="#customerModal"><?php echo __("Add Customer")?></button>
		</div>
	</div>
	
	<h4><?php echo __('Leads'); ?></h4>
	<div class='table-responsive well'>
		<table cellpadding='0' cellspacing='0' class='table'>
		  <thead>
		  <tr>
			<th width="80%"><?php echo __('Name') ?></th>
			<th width="20%"><?php echo __('Actions') ?></th>
		  </tr>
		  </thead>
		  <tbody id="_bodyAddedLead">
		  <?php if($addedLead):?>
			<?php foreach($addedLead as $leadId => $lead):?>
			  <tr id="_row_<?php echo $leadId?>">
				<td>
				  <?php echo $lead['name']?>
				  <?php echo $this->Form->input("CalendarLead.{$leadId}.lead_id", array('type' => 'hidden', 'value' => $lead['lead_id']));?>
				</td>
				<td>
				  <a class="btn btn-default btn-sm _removeLead"> Remove </a>
				</td>
			  </tr>
			<?php endforeach;?>
		  <?php endif;?>
		  </tbody>
		</table>
	</div>
	<div class="form-group">
		<div class="col col-md-9">
		</div>
		<div class="col-md-3 text-right">
		  <button type="button" class="btn btn-default btn-sm _addLead" data-toggle="modal" data-target="#leadModal"><?php echo __("Add Lead")?></button>
		</div>
	</div>
	
	<h4><?php echo __('Vendors'); ?></h4>
	<div class='table-responsive well'>
		<table cellpadding='0' cellspacing='0' class='table'>
		  <thead>
		  <tr>
			<th width="80%"><?php echo __('Name') ?></th>
			<th width="20%"><?php echo __('Actions') ?></th>
		  </tr>
		  </thead>
		  <tbody id="_bodyAddedVendor">
		  <?php if($addedVendor):?>
			<?php foreach($addedVendor as $vendorId => $vendor):?>
			  <tr id="_row_<?php echo $vendorId?>">
				<td>
				  <?php echo $vendor['name']?>
				  <?php echo $this->Form->input("CalendarVendor.{$vendorId}.vendor_id", array('type' => 'hidden', 'value' => $vendor['vendor_id']));?>
				</td>
				<td>
				  <a class="btn btn-default btn-sm _removeVendor"> Remove </a>
				</td>
			  </tr>
			<?php endforeach;?>
		  <?php endif;?>
		  </tbody>
		</table>
	</div>
	<div class="form-group">
		<div class="col col-md-9">
		</div>
		<div class="col-md-3 text-right">
		  <button type="button" class="btn btn-default btn-sm _addVendor" data-toggle="modal" data-target="#vendorModal"><?php echo __("Add Vendor")?></button>
		</div>
	</div>
	
	<h4><?php echo __('Staff Member'); ?></h4>
	<div class='table-responsive well'>
		<table cellpadding='0' cellspacing='0' class='table'>
		  <thead>
		  <tr>
			<th width="80%"><?php echo __('Name') ?></th>
			<th width="20%"><?php echo __('Actions') ?></th>
		  </tr>
		  </thead>
		  <tbody id="_bodyAddedUser">
		  <?php if($addedUser):?>
			<?php foreach($addedUser as $userId => $user):?>
			  <tr id="_row_<?php echo $userId?>">
				<td>
				  <?php echo $user['name']?>
				  <?php echo $this->Form->input("CalendarUser.{$userId}.user_id", array('type' => 'hidden', 'value' => $user['user_id']));?>
				</td>
				<td>
				  <a class="btn btn-default btn-sm _removeUser"> Remove </a>
				</td>
			  </tr>
			<?php endforeach;?>
		  <?php endif;?>
		  </tbody>
		</table>
	</div>
	<div class="form-group">
		<div class="col col-md-9">
		</div>
		<div class="col-md-3 text-right">
		  <button type="button" class="btn btn-default btn-sm _addUser" data-toggle="modal" data-target="#userModal"><?php echo __("Add User")?></button>
		</div>
	</div>

  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>
<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('calendar.js');
?>

<div id="customerModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo __("Add Customer")?></h4>
      </div>
      <div class="modal-body">
        <div id="_customer_msg" class="alert alert-danger hidden"></div>
		<?php
		echo $this->Form->input('customer_id',
			array('options' => $listCustomer,
			  'selected'=>NULL,
			  'label' => array('text' => __('Customer')),
			  'empty' => __("Please select customer..."),
			)
		);
		?>
      </div>
      <div class="modal-footer">
        <input id="_calendar_customer_id" type="hidden" >
        <input id="_customer_order" type="hidden" >
        <button id="_customer_ok" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<script id="tableRowTemplateCustomer" type="text/x-jQuery-tmpl">
  <tr id="_row_${id}">
    <td>
      <span class="_customer_name">${customerName}</span>
      <?php echo $this->Form->input('CalendarCustomer.${id}.customer_id', array('type' => 'hidden', 'value' => '${customer_id}'));?>
    </td>
    </td>
    <td>
    <a class="btn btn-default btn-sm _removeCustomer"> Remove </a>
    </td>
  </tr>
</script>

<div id="leadModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo __("Add Lead")?></h4>
      </div>
      <div class="modal-body">
        <div id="_lead_msg" class="alert alert-danger hidden"></div>
		<?php
		echo $this->Form->input('lead_id',
			array('options' => $listLead,
			  'selected'=>NULL,
			  'label' => array('text' => __('Lead')),
			  'empty' => __("Please select lead..."),
			)
		);
		?>
      </div>
      <div class="modal-footer">
        <input id="_calendar_lead_id" type="hidden" >
        <input id="_lead_order" type="hidden" >
        <button id="_lead_ok" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<script id="tableRowTemplateLead" type="text/x-jQuery-tmpl">
  <tr id="_row_${id}">
    <td>
      <span class="_lead_name">${leadName}</span>
      <?php echo $this->Form->input('CalendarLead.${id}.lead_id', array('type' => 'hidden', 'value' => '${lead_id}'));?>
    </td>
    </td>
    <td>
    <a class="btn btn-default btn-sm _removeLead"> Remove </a>
    </td>
  </tr>
</script>

<div id="vendorModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo __("Add Vendor")?></h4>
      </div>
      <div class="modal-body">
        <div id="_vendor_msg" class="alert alert-danger hidden"></div>
		<?php
		echo $this->Form->input('vendor_id',
			array('options' => $listVendor,
			  'selected'=>NULL,
			  'label' => array('text' => __('Vendor')),
			  'empty' => __("Please select vendor..."),
			)
		);
		?>
      </div>
      <div class="modal-footer">
        <input id="_calendar_vendor_id" type="hidden" >
        <input id="_vendor_order" type="hidden" >
        <button id="_vendor_ok" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<script id="tableRowTemplateVendor" type="text/x-jQuery-tmpl">
  <tr id="_row_${id}">
    <td>
      <span class="_vendor_name">${vendorName}</span>
      <?php echo $this->Form->input('CalendarVendor.${id}.vendor_id', array('type' => 'hidden', 'value' => '${vendor_id}'));?>
    </td>
    </td>
    <td>
    <a class="btn btn-default btn-sm _removeVendor"> Remove </a>
    </td>
  </tr>
</script>

<div id="userModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo __("Add Staff Member")?></h4>
      </div>
      <div class="modal-body">
        <div id="_user_msg" class="alert alert-danger hidden"></div>
		<?php
		echo $this->Form->input('user_id',
			array('options' => $listUser,
			  'selected'=>NULL,
			  'label' => array('text' => __('Staff Member')),
			  'empty' => __("Please select member..."),
			)
		);
		?>
      </div>
      <div class="modal-footer">
        <input id="_calendar_user_id" type="hidden" >
        <input id="_user_order" type="hidden" >
        <button id="_user_ok" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<script id="tableRowTemplateUser" type="text/x-jQuery-tmpl">
  <tr id="_row_${id}">
    <td>
      <span class="_user_name">${userName}</span>
      <?php echo $this->Form->input('CalendarUser.${id}.user_id', array('type' => 'hidden', 'value' => '${user_id}'));?>
    </td>
    </td>
    <td>
    <a class="btn btn-default btn-sm _removeUser"> Remove </a>
    </td>
  </tr>
</script>
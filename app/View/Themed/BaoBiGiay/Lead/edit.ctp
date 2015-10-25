<h3>
	<?php if (isset($this->data['Lead']['id']) && $this->data['Lead']['id'] > 0): ?>
		<?php echo __('Edit Lead') ?>: <?= $this->data['Lead']['name'] ?>
		<?php else: ?>
		<?php  echo __('Add Lead') ?>
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
  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('code', array('label' => array('text' => __('Code')))) ?>
  <?php echo $this->Form->input('email', array('label' => array('text' => __('Email')))) ?>
  <?php echo $this->Form->input('phone', array('label' => array('text' => __('Phone')))) ?>
  <?php echo $this->Form->input('fax', array('label' => array('text' => __('Fax')))) ?>
  <?php echo $this->Form->input('address', array('label' => array('text' => __('Address')))) ?>
  <?php echo $this->Form->input('info', array('rows' => '5', 'type' => 'textarea', 'label' => array('text' => __('Information')))) ?>
  
  Contacts
  <div class='table-responsive well'>
    <table cellpadding='0' cellspacing='0' class='table'>
      <thead>
      <tr>
        <th width="20%"><?php echo __('Name') ?></th>
        <th width="20%"><?php echo __('Email') ?></th>
        <th width="15%"><?php echo __('Phone') ?></th>
        <th width="30%"><?php echo __('Address') ?></th>
        <th width="15%"><?php echo __('Action') ?></th>
      </tr>
      </thead>
      <tbody id="_bodyAddedContact">
      <?php if($addedContact):?>
        <?php foreach($addedContact as $contactId => $contact):?>
          <tr id="_row_<?php echo $contactId?>">
            <td>
              <span class="_contact_name"><?php echo $contact['name']?></span>
              <?php echo $this->Form->input("LeadContact.{$contactId}.name", array('type' => 'hidden', 'value' => $contact['name']));?>
            </td>
            <td>
              <?php echo $contact['email']?>
              <?php echo $this->Form->input("LeadContact.{$contactId}.email", array('type' => 'hidden', 'value' => $contact['email']));?>
            </td>
            <td>
              <?php echo $contact['phone']?>
              <?php echo $this->Form->input("LeadContact.{$contactId}.phone", array('type' => 'hidden', 'value' => $contact['phone']));?>
            </td>
            <td>
              <?php echo $contact['address']?>
              <?php echo $this->Form->input("LeadContact.{$contactId}.address", array('type' => 'hidden', 'value' => $contact['address']));?>
              <?php echo $this->Form->input("LeadContact.{$contactId}.info", array('type' => 'hidden', 'value' => $contact['info']));?>
              <?php echo $this->Form->input("LeadContact.{$contactId}.fax", array('type' => 'hidden', 'value' => $contact['fax']));?>
            </td>
            <td>
              <a class="btn btn-default btn-sm _editContact" data-id=<?php echo $contactId?>> Edit </a>
              <a class="btn btn-default btn-sm _removeContact"> Remove </a>
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
      <button type="button" class="btn btn-default btn-sm _addContact" data-toggle="modal" data-target="#contactModal"><?php echo __("Add Contact")?></button>
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
  //echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>


<?php
echo $this->Html->script('lead.js');
?>

<div id="contactModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo __("Add Contact")?></h4>
      </div>
      <div class="modal-body">
        <div id="_contact_msg" class="alert alert-danger hidden"></div>
        <div class="form-group required">
          <label class="col col-md-3 control-label text-left"><?php echo __('Name')?></label>
          <div class="col col-md-9 required">
            <input id="_contact_name" class="form-control" maxlength="255" type="text" required="required">
          </div>
        </div>
        <div class="form-group">
          <label class="col col-md-3 control-label text-left"><?php echo __('Email')?></label>
          <div class="col col-md-9">
            <input id="_contact_email" class="form-control" maxlength="255" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col col-md-3 control-label text-left"><?php echo __('Phone')?></label>
          <div class="col col-md-9">
            <input id="_contact_phone" class="form-control" maxlength="255" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col col-md-3 control-label text-left"><?php echo __('Fax')?></label>
          <div class="col col-md-9">
            <input id="_contact_fax" class="form-control" maxlength="255" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col col-md-3 control-label text-left"><?php echo __('Information')?></label>
          <div class="col col-md-9">
            <input id="_contact_info" class="form-control" maxlength="255" type="text">
          </div>
        </div>
        <div class="form-group">
          <label class="col col-md-3 control-label text-left"><?php echo __('Address')?></label>
          <div class="col col-md-9">
            <input id="_contact_address" class="form-control" maxlength="255" type="text">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input id="_contact_id" type="hidden" >
        <button id="_contact_ok" type="button" class="btn btn-default" data-dismiss="modal">OK</button>
      </div>
    </div>

  </div>
</div>

<script id="tableRowTemplateContact" type="text/x-jQuery-tmpl">
  <tr id="_row_${id}">
    <td>${name}</span>
      <?php echo $this->Form->input('LeadContact.${id}.name', array('type' => 'hidden', 'value' => '${name}'));?>
    </td>
    <td>
      ${email}
      <?php echo $this->Form->input('LeadContact.${id}.email', array('type' => 'hidden', 'value' => '${email}'));?>
    </td>
    <td>
      ${phone}
      <?php echo $this->Form->input('LeadContact.${id}.phone', array('type' => 'hidden', 'value' => '${phone}'));?>
    </td>
    <td>
      ${address}
      <?php echo $this->Form->input('LeadContact.${id}.address', array('type' => 'hidden', 'value' => '${address}'));?>
      <?php echo $this->Form->input('LeadContact.${id}.info', array('type' => 'hidden', 'value' => '${info}'));?>
      <?php echo $this->Form->input('LeadContact.${id}.fax', array('type' => 'hidden', 'value' => '${fax}'));?>
    </td>
    <td>
    <a class="btn btn-default btn-sm _editContact" data-id=${id}> Edit </a>
    <a class="btn btn-default btn-sm _removeContact"> Remove </a>
    </td>
  </tr>
</script>

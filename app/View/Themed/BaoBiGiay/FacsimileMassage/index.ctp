<div class="page-title">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Facsimile Massage List') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false)); ?>
    </div>
  </div>
</div>
<?php
echo $this->Form->create('FacsimileMassageSearch', array(
  'novalidate' => true,
  'inputDefaults' => array(
    'div' => 'form-group',
    'label' => array(
      'class' => 'col col-md-2 control-label text-left'
    ),
    'wrapInput' => 'col col-md-7',
    'class' => 'form-control'
  ),
  'type' => 'get'
));
?>
<div class="well form-horizontal page-body posts form">
  <?php
  echo $this->Form->input('customer_id', array(
      'options' => $listCustomer,
      'selected'=>$customerId,
      'empty' => __("Please select ..."),
      'text' => __("Customer"),
      array('require'=>true, 'allowEmpty'=>false),
    )
  );
  ?>
  <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-large btn-primary', 'id' => "_submit"));?>
</div>
<?php echo $this->Form->end(); ?>


<div class="page-body">
  <div class="row">
    <div class="col-md-12">

      <div class="block">
        <div class="block-body">
          <div class='table-responsive'>

            <table cellpadding='0' cellspacing='0' class='table' data-nosearchable=",3" data-nosortable=",3" data-idisplaylength="10" data-aasorting="[[0,'asc']]">
              <thead>
              <tr>
                <th width="10%"><?php echo __('ID') ?></th>
                <th width="30%"><?php echo __('Name.') ?></th>
                <th width="20%"><?php echo __('Customer') ?></th>
                <th width="20%"><?php echo __('Staff') ?></th>
                <th width="20%"><?php echo __('Actions'); ?></th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($dataList as $data):
                ?>
                <tr>
                  <td><?php echo $data['FacsimileMassage']['id']; ?></td>
                  <td><?php echo $data['FacsimileMassage']['name']; ?></td>
                  <td><?php echo $data['Customer']['name']; ?></td>
                  <td><?php echo $data['User']['display_name']; ?></td>
                  <td>
                    <?= $this->Html->link('<i class="fa fa-file-pdf-o"></i>', Router::url(array('action' => 'report', $data['FacsimileMassage']['id'])), array('class' => 'btn btn-default btn-sm', 'escape' => false, 'title' => __('Export PDF'))) ?>
                    <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit', $data['FacsimileMassage']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false, 'title' => __('Edit'))) ?>
                    <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete', $data['FacsimileMassage']['id'])), array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false, 'title' => __('Delete')), __('Are you sure you want to delete #%s?', $data['FacsimileMassage']['id'])) ?>
                  </td>
                </tr>
              <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <?php if ($this->Paginator->param('pageCount') > 1): ?>
      <div class="col-md-12">
        <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php
echo $this->Html->script('costing.js');
?>
<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Salary') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false)); ?>
    </div>
  </div>
</div>

<?php
echo $this->Form->create('PurchaseOder', array(
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
  <div class="form-group">
    <label class="col col-md-2 control-label text-left"><?php echo __('Date From') ?></label>
    <div class="col col-md-3">
      <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD">
        <input value="<?php echo $dateFrom?>" name="date_from" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>

    <label class="col col-md-1 control-label text-left"><?php echo __('To') ?></label>
    <div class="col col-md-3">
      <div class='input-group date _datetime_picker' data-date-format="YYYY-MM-DD">
        <input value="<?php echo $dateTo?>" name="date_to" type='text' class="form-control" readonly="readonly"/>
        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
      </div>
    </div>
  </div>
  <?php echo $this->Form->submit(__('Search'), array('class' => 'btn btn-large btn-primary', 'id' => "_submit"));?>
</div>
<?php echo $this->Form->end(); ?>

<div class="page-body">
  <div class="row">
    <div class="col-md-12">
      <div class='table-responsive'>
        <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
          <thead>
            <tr>
              <th width="10%"><?php echo __('Customer Code') ?></th>
              <th width="20%"><?php echo __('Customer') ?></th>
              <th width="20%"><?php echo __('Amount') ?></th>
              <th width="5%"><?php echo __('Mark Up') ?></th>
              <th width="15%"><?php echo __('Date') ?></th>
              <th width="15%"><?php echo __('Entilement') ?></th>
              <th width="15%"><?php echo __('Actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataList as $data):
              ?>
              <tr>
                <td><?php echo ($data['Customer']['code']); ?></td>
                <td><?php echo ($data['Customer']['name']); ?></td>
                <td><?php echo vnNumberFormat($data['Salary']['amount']); ?></td>
                <td><?php echo ($data['Salary']['mark_up']); ?></td>
                <td><?php echo reformatDate($data['Salary']['date'], 'd/m/Y'); ?></td>
                <td><?php echo vnNumberFormat($data['Salary']['entilement']); ?></td>
                <td>
                  <?php echo $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit', $data['Salary']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false, 'title' => __('Edit'))) ?>
                  <?php echo $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete', $data['Salary']['id'])), array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false, 'title' => __('Delete')), __('Are you sure you want to delete #%s?', $data['Salary']['id'])) ?>
                </td>
              </tr>
              <?php
            endforeach;
            ?>
            <tr>
              <td><b>Sum</b></td>
              <td></td>
              <td><?php echo vnNumberFormat($sumAmount)?></td>
              <td></td>
              <td></td>
              <td><?php echo vnNumberFormat($sumEntilement)?></td>
              <td></td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td><?php echo vnNumberFormat($sumAmount2)?></td>
              <td></td>
              <td></td>
              <td><?php echo vnNumberFormat($sumEntilement2)?></td>
              <td></td>
            </tr>
            <tr>
              <td><b>Salary</b></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td><b><?php echo vnNumberFormat($sumAmount2 + $sumEntilement2)?></b></td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php
echo $this->Html->css('bootstrap-datetimepicker.css');
echo $this->Html->script('libs/moment.js');
echo $this->Html->script('libs/bootstrap-datetimepicker.js');
echo $this->Html->script('costing.js');
?>

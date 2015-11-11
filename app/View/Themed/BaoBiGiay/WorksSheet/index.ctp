<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Works Sheet List') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false)); ?>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="row">
    <div class="col-md-12">
      <div class='table-responsive'>
        <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
          <thead>
            <tr>
              <th width="10%"><?php echo __('WS No.') ?></th>
              <th width="10%"><?php echo __('Customer') ?></th>
              <th width="15%"><?php echo __('Product') ?></th>
              <th width="10%"><?php echo __('Quantity') ?></th>
              <th width="15%"><?php echo __('Delivery Date') ?></th>
              <th width="20%"><?php echo __('Created User') ?></th>
              <th width="20%"><?php echo __('Actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataList as $data):
              ?>
              <tr>
                <td><?php echo ($data['WorksSheet']['auto_code']); ?></td>
                <td><?php echo ($data['Customer']['name']); ?></td>
                <td><?php echo ($data['Product']['name']); ?></td>
                <td><?php echo vnNumberFormat($data['Product']['quantity'], 0); ?></td>
                <td><?php echo reformatDate($data['WorksSheet']['delivery_date']); ?></td>
                <td><?php echo ($data['User']['display_name']); ?></td>
                <td>
                  <?= $this->Html->link('<i class="fa fa-file-pdf-o"></i>', Router::url(array('action' => 'report', $data['WorksSheet']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false, 'title' => __('Export PDF'))) ?>
                  <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit', $data['WorksSheet']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false, 'title' => __('Edit'))) ?>
                  <?php if($isAdmin && empty($data['WorksSheet']['status'])):?>
                  <?= $this->Html->link('<i class="fa fa-check-square-o"></i>', Router::url(array('action' => 'approve', $data['WorksSheet']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false, 'title' => __('Approve'))) ?>
                  <?php endif;?>
                  <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete', $data['WorksSheet']['id'])), array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false, 'title' => __('Delete')), __('Are you sure you want to delete #%s?', $data['WorksSheet']['id'])) ?>
                </td>
              </tr>
              <?php
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <?php if ($this->Paginator->param('pageCount') > 1): ?>
      <div class="col-md-12">
        <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
      </div>
    <?php endif; ?>
  </div>
</div>

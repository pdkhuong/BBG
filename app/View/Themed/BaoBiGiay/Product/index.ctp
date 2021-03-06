<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Products') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false, 'id' => '_addProduct')); ?>
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
              <th width="10%"><?php echo __('No.') ?></th>
              <th width="20%"><?php echo __('Name') ?></th>
              <th width="20%"><?php echo __('Specification') ?></th>
              <th width="10%"><?php echo __('Customer') ?></th>
              <th width="5%"><?php echo __('Unit') ?></th>
              <th width="10%"><?php echo __('Quantity') ?></th>
              <th width="10%"><?php echo __('Price') ?></th>
              <th width="15%"><?php echo __('Actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataList as $data):
              ?>
              <tr>
                <td><?php echo ($data['Product']['item_no']); ?></td>
                <td><?php echo ($data['Product']['name']); ?></td>
                <td><?php echo ($data['Product']['specification']); ?></td>
                <td><?php echo ($data['Customer']['name']); ?></td>
                <td><?php echo ($data['ProductUnit']['name']); ?></td>
                <td><?php echo vnNumberFormat($data['Product']['quantity'], 0); ?></td>
                <td><?php echo vnNumberFormat($data['Product']['price'], 0); ?></td>
                <td>
                  <?= $this->Html->link('<i class="fa fa-file-text"></i>', Router::url(array('action' => 'view', $data['Product']['id'])), array('class' => 'btn btn-default btn-sm', 'escape' => false, 'title' => __('View Detail'))) ?>
                  <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit', $data['Product']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false, 'title' => __('Edit'))) ?>
                  <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete')) . '/' . $data['Product']['id'], array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false, 'title' => __('Delete')), __('Are you sure you want to delete #%s?', $data['Product']['id'])) ?>
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

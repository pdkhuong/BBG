<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Vendors') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse btn-large btn-primary', 'escape' => false, 'id' => '_addVendor')); ?>
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
              <th width="25%"><?php echo __('Name') ?></th>
			  <th width="20%"><?php echo __('Email') ?></th>
			  <th width="10%"><?php echo __('Phone') ?></th>
			  <th width="35%"><?php echo __('Address'); ?></th>
			  <th width="20%"><?php echo __('Actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataList as $data):
              ?>
              <tr>
                <td><?php echo ($data['Vendor']['name']); ?></td>
				<td><?php echo ($data['Vendor']['email']); ?></td>
				<td><?php echo ($data['Vendor']['phone']); ?></td>
				<td><?php echo ($data['Vendor']['address']); ?></td>
                <td>
                  <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit', $data['Vendor']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false)) ?>
                  <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete')) . '/' . $data['Vendor']['id'], array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false), __('Are you sure you want to delete #%s?', $data['Vendor']['id'])) ?>
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


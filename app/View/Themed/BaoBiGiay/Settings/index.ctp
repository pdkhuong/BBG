<div class="page-title" id="page-titl">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Settings') ?>
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
              <th width="10%"><?php echo __('ID.') ?></th>
              <th width="20%"><?php echo __('Key') ?></th>
              <th width="30%"><?php echo __('Name') ?></th>
              <th width="20%"><?php echo __('Value') ?></th>
              <th width="20%"><?php echo __('Actions'); ?></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($dataList as $data):
              ?>
              <tr>
                <td><?php echo ($data['Settings']['id']); ?></td>
                <td><?php echo ($data['Settings']['key']); ?></td>
                <td><?php echo ($data['Settings']['name']); ?></td>
                <td><?php echo ($data['Settings']['val']); ?></td>
                <td>
                  <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit', $data['Settings']['id'])), array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false)) ?>
                </td>
              </tr>
              <?php
            endforeach;
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

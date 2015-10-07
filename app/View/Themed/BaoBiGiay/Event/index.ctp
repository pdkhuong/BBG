<div class="page-title" id="page-title">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Events') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">
      <?php echo $this->Html->link('<i class="fa fa-plus"></i> ' . __('Add'), Router::url(array('action' => 'edit')), array('class' => 'btn btn-inverse', 'escape' => false)); ?>
    </div>
  </div>
</div>

<div class="page-body">
  <div class="row">
    <div class="col-md-12">
      <div class="block">
        <div class="block-body">
          <div class='table-responsive'>
            <table cellpadding='0' cellspacing='0' class="table">
              <thead>
                <tr>
                  <th width="20%"><i class="fa fa-picture-o"></i></th>
                  <th width="35%"><?php echo __('Event name') ?></th>
                  <th width="15%"><?php echo __('From date') ?></th>
                  <th width="15%"><?php echo __('To date') ?></th>
                  <th width="15%"><?php echo __('Actions'); ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                foreach ($dataList as $data):
                  ?>
                  <tr>
                    <td>
                      <?php
                      $controller->TradeshowEvent->id = isset($data['TradeshowEvent']['id']) ? $data['TradeshowEvent']['id'] : 0;
                      echo $this->File->listFileThumbnailElement($controller->TradeshowEvent, 'thumbnail', array('height' => 90));
                      ?>
                    </td>
                    <td><?php echo h($data['TradeshowEvent']['name']); ?></td>
                    <td><?php echo $data['TradeshowEvent']['from_date']; ?></td>
                    <td><?php echo $data['TradeshowEvent']['to_date']; ?></td>
                    <td>
                      <?= $this->Html->link('<i class="fa fa-edit"></i>', Router::url(array('action' => 'edit')) . '/' . $data['TradeshowEvent']['id'], array('class' => 'btn btn-default btn-edit btn-sm', 'escape' => false)) ?>
                      <?= $this->Form->postLink('<i class="fa fa-trash-o"></i>', Router::url(array('action' => 'delete')) . '/' . $data['TradeshowEvent']['id'], array('class' => 'btn btn-default btn-delete btn-sm', 'escape' => false), __('Are you sure you want to delete #%s?', $data['TradeshowEvent']['id'])) ?>
                      <?= $this->Html->link('<i class="fa fa-plus"></i>', Router::url(array('action' => 'addProduct')) . '/' . $data['TradeshowEvent']['id'], array('class' => 'btn btn-default btn-add btn-sm show-tooltip', 'escape' => false, 'title' => __('Add products'))) ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
              <?php if ($this->Paginator->param('pageCount') > 1): ?>
                <tfoot>
                  <tr>
                    <td colspan='5'>
                      <?php echo $this->Paginator->pagination(array('ul' => 'pagination')); ?>
                    </td>
                  </tr>
                </tfoot>
              <?php endif; ?>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

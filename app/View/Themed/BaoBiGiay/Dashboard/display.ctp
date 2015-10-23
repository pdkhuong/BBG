<div class="page-title">
  <div class="row">
    <div class="col-md-9">
      <h1><i class="fa fa-bars"></i>
        <?php echo __('Dashboard') ?>
      </h1>
    </div>
    <div class="col-md-3 text-right">

    </div>
  </div>
</div>

<div class="page-body">
    <div class="row">
      <div class="col-md-6">
        <div class="block block-black">
          <div class="block-title">
            <h3><i class="fa fa-calendar"></i> <?php echo __('Calendars') ?></h3>
          </div>
          <div class="block-body">
            <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
              <thead>
              <tr>
                <th width="30%"><?php echo __('From Date') ?></th>
                <th width="30%"><?php echo __('To Date') ?></th>
                <th width="40%"><?php echo __('Name') ?></th>
              </tr>
              </thead>
              <tbody>
              <?php
              foreach ($calendar as $event):
                ?>
                <tr>
                  <td><?php echo ($event['Calendar']['from_date']); ?></td>
                  <td><?php echo ($event['Calendar']['to_date']); ?></td>
                  <td>
                    <a href="<?php echo Router::url(array('controller' => 'calendar','action' => 'edit', $event['Calendar']['id'])); ?>">
                      <?php echo ($event['Calendar']['name']); ?>
                    </a>
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
      <div class="col-md-6">
        <div class="block block-black">
          <div class="block-title">
            <h3><i class="fa fa-tasks"></i> <?php echo __('Top Delivery Product Order') ?></h3>
          </div>
          <div class="block-body">
        <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
          <thead>
          <tr>
            <th width="20%"><?php echo __('Order No.') ?></th>
            <th width="30%"><?php echo __('Customer') ?></th>
            <th width="25%"><?php echo __('Output Product') ?></th>
            <th width="25%"><?php echo __('Delivery Date') ?></th>
          </tr>
          </thead>
          <tbody>
          <?php
          foreach ($productOrder as $data):
            ?>
            <tr>
            <td>
              <a href="<?php echo Router::url(array('controller' => 'product-order','action' => 'edit', $data['ProductOrder']['id'])); ?>">
                <?php echo ($data['ProductOrder']['order_no']); ?>
              </a>
            </td>
            <td><?php echo ($data['Customer']['name']); ?></td>
            <td><?php echo ($data['OutputProduct']['name']); ?></td>
            <td><?php echo ($data['ProductOrder']['delivery_date']); ?></td>
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
</div>

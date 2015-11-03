<h3>
  <?= __('Customer') ?> #<?= $data['Customer']['id'] ?>
</h3>
<hr>
<div class='table-responsive'>
  <table cellpadding='0' cellspacing='0' class='table table-striped table-bordered'>
    <thead>
    <tr>
      <th width="30%"><?php echo __('Properties') ?></th>
      <th width="70%"><?php echo __('Value') ?></th>
    </tr>
    </thead>
    <tbody>
      <tr>
        <td>Name</td>
        <td><?= $data['Customer']['name'] ?></td>
      </tr>
      <tr>
        <td>Code</td>
        <td><?= $data['Customer']['code'] ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?= $data['Customer']['email'] ?></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><?= $data['Customer']['phone'] ?></td>
      </tr>
      <tr>
        <td>Fax</td>
        <td><?= $data['Customer']['fax'] ?></td>
      </tr>
      <tr>
        <td>Address</td>
        <td><?= $data['Customer']['address'] ?></td>
      </tr>
      <tr>
        <td>Website</td>
        <td><?= $data['Customer']['website']; ?></td>
      </tr>
      <tr>
        <td>Foundation</td>
        <td><?= reformatDate($data['Customer']['foundation']); ?> (YYYY-MM-DD)</td>
      </tr>
      <tr>
        <td>Investment</td>
        <td><?= vnNumberFormat($data['Customer']['investment'], 0); ?></td>
      </tr>
      <tr>
        <td>Career</td>
        <td><?= $data['Customer']['career']; ?></td>
      </tr>
      <tr>
        <td>Staff Member</td>
        <td><?= $data['User']['display_name'] ?></td>
      </tr>
    </tbody>

  </table>
  Contact(s):
  <div class='table-responsive well'>
    <table cellpadding='0' cellspacing='0' class='table' data-nosearchable="0,2,3" data-nosortable="0,2,3" data-idisplaylength="10" data-aasorting="[[1,'asc']]">
      <thead>
      <tr>
        <th width="15%"><?php echo __('Name') ?></th>
        <th width="15%"><?php echo __('Email') ?></th>
        <th width="15%"><?php echo __('Phone') ?></th>
        <th width="20%"><?php echo __('Address') ?></th>
        <th width="20%"><?php echo __('Birthday') ?></th>
        <th width="15%"><?php echo __('Position') ?></th>
      </tr>
      </thead>
      <tbody>
      <?php
      if($contacts):
        foreach($contacts as $contact):?>
          <tr>
            <td><?php echo $contact['CustomerContact']['name']?></td>
            <td><?php echo $contact['CustomerContact']['email']?></td>
            <td><?php echo $contact['CustomerContact']['phone']?></td>
            <td><?php echo $contact['CustomerContact']['address']?></td>
            <td><?php echo $contact['CustomerContact']['birthday']?></td>
            <td><?php echo $contact['CustomerContact']['position']?></td>
          </tr>
        <?php endforeach;?>
      <?php endif;?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->Html->link(__('Back to list'), Router::url(array('plugin' => false, 'controller' => 'Customer', 'action' => 'index')), array('class' => 'btn btn-primary')) ?> &nbsp;

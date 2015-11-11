<h3>
  <?= __('Lead') ?>: <?= $data['Lead']['name'] ?>
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
        <td><?= $data['Lead']['name'] ?></td>
      </tr>
      <tr>
        <td>Code</td>
        <td><?= $data['Lead']['code'] ?></td>
      </tr>
      <tr>
        <td>Email</td>
        <td><?= $data['Lead']['email'] ?></td>
      </tr>
      <tr>
        <td>Phone</td>
        <td><?= $data['Lead']['phone'] ?></td>
      </tr>
      <tr>
        <td>Fax</td>
        <td><?= $data['Lead']['fax'] ?></td>
      </tr>
      <tr>
        <td>Address</td>
        <td><?= $data['Lead']['address'] ?></td>
      </tr>
      <tr>
        <td>Information</td>
        <td><?= $data['Lead']['info']; ?></td>
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
        <th width="25%"><?php echo __('Name') ?></th>
        <th width="25%"><?php echo __('Email') ?></th>
        <th width="25%"><?php echo __('Phone') ?></th>
        <th width="25%"><?php echo __('Address') ?></th>
      </tr>
      </thead>
      <tbody>
      <?php
      if($contacts):
        foreach($contacts as $contact):?>
          <tr>
            <td><?php echo $contact['LeadContact']['name']?></td>
            <td><?php echo $contact['LeadContact']['email']?></td>
            <td><?php echo $contact['LeadContact']['phone']?></td>
            <td><?php echo $contact['LeadContact']['address']?></td>
          </tr>
        <?php endforeach;?>
      <?php endif;?>
      </tbody>
    </table>
  </div>
</div>

<?= $this->Html->link(__('Back to list'), Router::url(array('plugin' => false, 'controller' => 'Lead', 'action' => 'index')), array('class' => 'btn btn-primary')) ?> &nbsp;

<div class="modal-dialog modal-vehicles" style="width:50%;">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      <h4 class="modal-title"><i class="fa fa-bars"></i> Request log #<?php echo $data['RequestLogModel']['id'] ?></h4>
    </div>
    <div class="modal-body">
      <dl>
        <dt>URL</dt>
        <dd><p><?php echo $data['RequestLogModel']['uri'] ?></p></dd>
        <dt>User ID/Admin ID</dt>
        <dd>
          <?php if (!is_null($data['RequestLogModel']['user_id'])): ?>
            <p>User ID: <?php echo $data['RequestLogModel']['user_id'] ?></p>
          <?php endif; ?>
          <?php if (!is_null($data['RequestLogModel']['admin_id'])): ?>
            <p>Admin ID: <?php echo $data['RequestLogModel']['admin_id'] ?></p>
          <?php endif; ?>
        </dd>
        <dt>IP Address</dt>
        <dd><p><?php echo $data['RequestLogModel']['ip'] ?></p></dd>
        <dt>Host name</dt>
        <dd><p><?php echo $data['RequestLogModel']['hostname'] ?></p></dd>
        <dt>Refer</dt>
        <dd><p><?php echo $data['RequestLogModel']['refer'] ?></p></dd>
        <dt>Created Time</dt>
        <dd><p><?php echo $data['RequestLogModel']['created_time'] ?></p></dd>
        <dt>Plugin</dt>
        <dd><p><?php echo $data['RequestLogModel']['plugin'] ?></p></dd>
        <dt>Controller</dt>
        <dd><p><?php echo $data['RequestLogModel']['controller'] ?></p></dd>
        <dt>Action</dt>
        <dd><p><?php echo $data['RequestLogModel']['action'] ?></p></dd>
        <?php if (!empty($data['RequestLogModel']['get_data'])): ?>
          <dt>Get Data</dt>
          <dd><p><?php echo var_dump(json_decode($data['RequestLogModel']['get_data'])); ?></p></dd>
        <?php endif; ?>
        <?php if (!empty($data['RequestLogModel']['post_data'])): ?>
          <dt>Post Data</dt>
          <dd><p><?php echo var_dump(json_decode($data['RequestLogModel']['post_data'])); ?></p></dd>
        <?php endif; ?>
        <?php if (!empty($data['RequestLogModel']['raw_data'])): ?>
          <dt>Raw Data</dt>
          <dd><p><?php echo var_dump(json_decode($data['RequestLogModel']['raw_data'])); ?></p></dd>
        <?php endif; ?>
        <?php if (!empty($data['RequestLogModel']['file_data'])): ?>
          <dt>File Data</dt>
          <dd><p><?php echo var_dump(json_decode($data['RequestLogModel']['file_data'])); ?></p></dd>
        <?php endif; ?>
        <?php if (!empty($data['RequestLogModel']['server_data'])): ?>
          <dt>Server Data</dt>
          <dd><p><?php echo var_dump(json_decode($data['RequestLogModel']['server_data'])); ?></p></dd>
        <?php endif; ?>
      </dl>
    </div>
  </div>
</div>

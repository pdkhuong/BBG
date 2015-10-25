<h3>
  <? if (isset($this->data['File']['id']) && $this->data['File']['id'] > 0): ?>
    <?= __('Edit File') ?>: <?= $this->data['File']['id'] ?>
  <? else: ?>
    <?= __('Add File') ?>
  <? endif; ?>
</h3>

<hr />
<div class="well form-horizontal page-body posts form">
<?php
  echo $this->Form->create('File', array(
    'novalidate' => true,
    'inputDefaults' => array(
      'div' => 'form-group',
      'label' => array(
        'class' => 'col col-md-3 control-label text-left'
      ),
      'wrapInput' => 'col col-md-9',
      'class' => 'form-control'
    ),
    'type' => 'file'
  ));
  ?>
  <?php echo $this->Form->input('name', array('label' => array('text' => __('Name')))) ?>
  <?php echo $this->Form->input('description', array('label' => array('text' => __('Description')))) ?>

  <?php if($this->data && $this->data['File']['id'] && $this->data['File']['file_path']) :?>
    <div class="form-group">
      <label class="col col-md-3 control-label text-left">Current File</label>
      <div class="col col-md-9">
        <a href="/<?php echo $this->data['File']['file_path']?>"><?php echo $this->data['File']['original_filename']?></a>
      </div>
    </div>

  <?php endif;?>

  <?php echo $this->Form->input('file', array('name' => 'file_upload', 'type' => 'file', 'label' => array('text' => __('File')))) ?>
  <div class="form-group ">
    <div class="col col-md-3 text-left">
      <?php
      echo $this->Form->button('<i class="fa fa-save"></i> ' . __('Save'), array('class' => 'btn btn-primary', 'type' => 'submit', 'escape' => false));
      echo ' ';
      echo $this->Html->link(__('Cancel'), Router::url(array("action" => "index")), array('class' => 'btn btn-default'));
      ?>
    </div>
  </div>
  <?php
  echo $this->Form->input('id', array('type' => 'hidden'));
  //echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>

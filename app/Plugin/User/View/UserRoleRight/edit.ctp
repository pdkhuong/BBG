<h3>
  Update Role Permission: <i><?= $role['UserRole']['name'] ?></i>
</h3>

<hr />

<div class="posts form">
  <?php
  echo $this->Form->create('UserRoleRight', array(
    'novalidate' => true,
    'inputDefaults' => array(
      'div' => 'form-group',
      'wrapInput' => false,
      'class' => 'form-control'
    ),
    'class' => 'well',
    'type' => 'file'
  ));
  ?>
  <?php foreach($listController['Controller'] as $controller):
    $strController = str_replace('Controller', '', $controller);
    ?>
    <div>
      <input name="<?php echo $controller ?>" id="<?php echo $controller ?>" <?php if(in_array($controller, $roleRightSelected)) echo "checked"?> type="checkbox" />
      <label for="<?php echo $strController ?>"><?php echo $strController?></label>
    </div>
  <?php endforeach;?>

  <?php foreach($listController['UserPluginCotroller'] as $controller):
    $strController = str_replace('Controller', '', $controller);
    ?>
    <div>
      <input name="<?php echo $controller ?>" id="<?php echo $controller ?>" <?php if(in_array($controller, $roleRightSelected)) echo "checked"?> type="checkbox" />
      <label for="<?php echo $strController ?>"><?php echo $strController?></label>
    </div>
  <?php endforeach;?>

  <?php
  echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-large btn-primary'));
  echo $this->Form->end();
  ?>
</div>

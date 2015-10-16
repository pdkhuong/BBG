<div id="left">
    <div class="media user-media">
        <div class="media-body">
            <h5 class="media-heading">
              Welcome
              <?php
              if($loggedUser->Admin->id>0){
                echo __('Administrator');
              }elseif($loggedUser->User->id>0){
                echo $loggedUser->User->username;
              }else{
                echo __('Guest');
              }
              ?>
            </h5>
            <ul class="list-unstyled user-info">
              <?php if($loggedUser->User->id>0):?>
              <li><small><i class="fa fa-user"></i> <a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'myProfile'))?>">Edit Profile</a></small></li>
              <?php endif;?>
              <li><small><i class="fa fa-calendar"></i> <?php echo date('Y M d H:i:s', time())?></small></li>
              <?php if($loggedUser->Admin->id > 0 || $loggedUser->User->id > 0):?>
              <li><small><i class="fa fa-power-off"></i><a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'logout'))?>"> <?php echo __('Logout')?></a></small></li>
              <?php else: ?>
                <li><small><i class="fa fa-sign-in"></i><a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'login'))?>"> <?php echo __('Login')?></a></small></li>
              <?php endif;?>
            </ul>
        </div>
    </div>
    <ul id="menu" class="collapse affix-top">
      <li class="nav-header">Main Menu</li>
      <li class="nav-divider"></li>
      <li class="<?php if($this->params['controller'] == 'Dashboard') echo 'active'?>">
          <a href="/"><i class="fa fa-home"></i> Dashboard</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Product') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Product', 'action' => 'index'))?>"><i class="fa fa-shopping-cart"> </i>Products</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Costing') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Costing', 'action' => 'index'))?>"><i class="fa fa-dollar"> </i>Costing</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'PurchaseOrder') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PurchaseOrder', 'action' => 'index'))?>"><i class="fa fa-clipboard"> </i>Purchase Order</a>
      </li>

      <li class="<?php if($this->params['controller'] == 'User') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'search'))?>"> <i class="fa fa-users"> </i>Users</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Settings') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Settings', 'action' => 'index'))?>"><i class="fa fa-cogs"> </i>Settings</a>
      </li>
    </ul>


</div>
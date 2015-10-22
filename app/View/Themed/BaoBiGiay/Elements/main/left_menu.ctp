<div id="left">
    <div class="media user-media">
        <div class="media-body">
            <h5 class="media-heading">
              Welcome
              <?php
              if($loggedUser->Admin->id>0){
                echo __('Administrator');
              }elseif($loggedUser->User->id>0){
                echo $loggedUser->User->display_name;
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
      <li class="<?php if($this->params['controller'] == 'Calendar') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Calendar', 'action' => 'index'))?>"><i class="fa fa-calendar"> </i>Calendars</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Customer') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Customer', 'action' => 'index'))?>"><i class="fa fa-users"> </i>Customers</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Lead') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Lead', 'action' => 'index'))?>"><i class="fa fa-users"> </i>Leads</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Vendor') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Vendor', 'action' => 'index'))?>"><i class="fa fa-users"> </i>Vendors</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Product') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Product', 'action' => 'index'))?>"><i class="fa fa-shopping-cart"> </i>Products</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Costing') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Costing', 'action' => 'index'))?>"><i class="fa fa-dollar"> </i>Costing</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'ProductOrder') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'ProductOrder', 'action' => 'index'))?>"><i class="fa fa-tasks"> </i>Product Order</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'PurchaseOrder') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PurchaseOrder', 'action' => 'index'))?>"><i class="fa fa-clipboard"> </i>Purchase Order</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'PurchaseOrderVendor') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PurchaseOrderVendor', 'action' => 'index'))?>"><i class="fa fa-clipboard"> </i>PA</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Salary') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Salary', 'action' => 'index'))?>"><i class="fa fa-dollar"> </i>Salary</a>
      </li>
      <?php if($loggedUser->Admin->id > 0 || isset($loggedUser->Role[USER_ROLE_ADMIN])): ?>
      <li class="<?php if($this->params['controller'] == 'File') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'File', 'action' => 'index'))?>"><i class="fa fa-file-o"> </i>Files</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'User') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'search'))?>"> <i class="fa fa-users"> </i>Users</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'UserRole') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'UserRole', 'action' => 'search'))?>"> <i class="fa fa-users"> </i>User Roles</a>
      </li>
      <li class="<?php if($this->params['controller'] == 'Settings') echo 'active'?>">
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Settings', 'action' => 'index'))?>"><i class="fa fa-cogs"> </i>Settings</a>
      </li>
      <?php endif;?>
    </ul>


</div>
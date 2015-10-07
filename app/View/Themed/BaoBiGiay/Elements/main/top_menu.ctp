<header class="header" role="banner" style="top: 0px;">
  <div class="row-main">
    <div id="inner-header" class="wrap clearfix">
      <div class="site-title"><a href="/" rel="nofollow"></a></div>
      <nav role="navigation">
        <div class="nav-wrapper nav-wrapper-main collapse navbar-collapse" id="header-nav">
          <ul class="clearfix nav nav-main">
            <li><a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Dashboard', 'action' => 'display')); ?>"><?php echo __("Dashboard"); ?></a></li>
            <li><a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Event', 'action' => 'index')); ?>"><?php echo __("Events"); ?></a></li>
            <li><a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Category', 'action' => 'index')); ?>"><?php echo __("Product Line"); ?></a></li>
            <li><a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Product', 'action' => 'index')); ?>"><?php echo __("Products"); ?></a>
              <ul class="sub-menu" style="width: 164px;">
                <li><a href="/attributes"><?php echo __("Attributes"); ?></a></li>
              </ul>
            </li>
            <?php if($loggedUser->Admin->id > 0 || isset($loggedUser->Role[3])): ?>
              <li><a href="#"><?php echo __("Systems"); ?></a>
                <ul class="sub-menu" style="width: 164px;">
                  <li><a href="/user/listing"><?php echo __("Users"); ?></a></li>
                  <li><a href="/file/manage"><?php echo __("Files"); ?></a></li>
                  <li><a href="<?php echo Router::url(array('plugin' => 'System', 'controller' => 'SystemDatabase', 'action' => 'listBackupDB')); ?>"><?php echo __("System Snapshots"); ?></a></li>
                </ul>
              </li>
            <?php endif; ?>
            <li>
              <a href="/app-themes"><?php echo __('App Layouts'); ?></a>
              <ul class="sub-menu" style="width: 164px;">
                <li>
                  <a href="<?php echo Router::url(array('plugin' => 'AppTemplate', 'controller' => 'AppTemplateScreen', 'action' => 'search')); ?>">
                    <?php echo __("Screens"); ?>
                  </a>
                </li>
              </ul>
            </li>
            <li><a href="#"><?php echo __("Account"); ?></a>
              <ul class="sub-menu" style="width: 164px;">
                <li><a href="/user/account/profile"><?php echo __("Profile"); ?></a></li>
                <li><a href="/user/account/logout"><?php echo __("Logout"); ?></a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <div class="language dropdown navbar-right flags-nav">
        <?php echo $this->MultiLanguage->listLanguages() ?>
      </div>
      <div class="navigation-toggle" data-toggle="collapse" data-target="#header-nav">
        <a href="#"></a>
      </div>
    </div>
  </div>
</header>

<div id="left">

    <div class="media user-media">
        <div class="media-body">
            <h5 class="media-heading">Welcome Administrator</h5>
            <ul class="list-unstyled user-info">
                <li><small><i class="fa fa-user"></i> <a href="http://dev.ucm.com/?m[0]=config&amp;p[0]=config_admin&amp;m[1]=user&amp;p[1]=user_admin&amp;user_id=1">Edit Profile</a></small></li>
                <li>
                    <small><i class="fa fa-question"></i>
                        <a href="#" id="header_help">
                            Help					    </a>
                    </small>
                </li>
                <li><small><i class="fa fa-calendar"></i> Tue 6th of October 2015</small></li>
                <li><small><i class="fa fa-power-off"></i><a href="/index.php?_logout=true"> Logout</a></small></li>
            </ul>
        </div>
    </div>

    <ul id="menu" class="collapse affix-top">
        <li class="nav-header">Main Menu</li>
        <li class="nav-divider"></li>
        <li class="">
            <a href="/index.php?p=home"><i class="fa fa-home"></i>                Dashboard            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=calendar&amp;p[0]=calendar_admin"><i class="fa fa-calendar"></i>                Calendar            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=customer&amp;p[0]=customer_admin_list&amp;leads=1"><i class="fa fa-users"></i>                Leads            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=customer&amp;p[0]=customer_admin_list"><i class="fa fa-users"></i>                Customers            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=vendor&amp;p[0]=vendor_admin_list"><i class="fa fa-users"></i>                Vendors            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=quote&amp;p[0]=quote_admin"><i class="fa fa-edit"></i>                Quotes            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=invoice&amp;p[0]=invoice_admin"><i class="fa fa-dollar"></i>                Invoices            </a>
        </li>
        <li class="">
            <a href="http://dev.ucm.com/?m[0]=file&amp;p[0]=file_admin"><i class="fa fa-file-o"></i>                Files <span class="label label-info">0</span>             </a>
        </li>
        <li>
            <a href="http://dev.ucm.com/?m[0]=config&amp;p[0]=config_admin"><i class="fa fa-cogs"></i>                Settings            </a>
        </li>
      <li>
        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Product', 'action' => 'index'))?>"><i class="fa fa-qrcode"></i>Products</a>
      </li>
      <li class="">
        <a class="has_sub" href="#"><i class="fa fa-users"></i> <?php echo __("Users")?></a>
        <ul>
          <li><a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'search'))?>">List User</a></li>
          <li><a href="<?php echo Router::url(array('plugin' => 'User', 'controller' => 'UserRole', 'action' => 'search'))?>">List User Role</a></li>
        </ul>

      </li>
    </ul>


</div>
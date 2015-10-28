<?php

//define in the rights
define('USER_FUNC_ACTIVE', 0);
define('USER_FUNC_DISABLE', 1);
include_once(__DIR__ . '/rights.php');
Configure::write('User.UserRight', $rights);

//admin status
define('USER_ADMIN_ACTIVE', 0);
define('USER_ADMIN_DISABLE', 1);
Configure::write('User.AdminStatus', array(USER_ADMIN_ACTIVE => __('Active'), USER_ADMIN_DISABLE => __('Disable')));

//user status
define('USER_ACTIVE', 0);
define('USER_INACTIVE', -1);
define('USER_DISABLE', 1);
Configure::write('User.UserStatus', array(USER_ACTIVE => __('Active'), USER_DISABLE => __('Disable')));

//define data access
define('USER_DATA_INCLUDE', 0);
define('USER_DATA_EXCLUDE', 1);
Configure::write('User.UserData', array(USER_DATA_INCLUDE => __('Include'), USER_DATA_EXCLUDE => __('Exclude')));

//
define('USER_MIN_PASSWORD_LENGTH', 6);

//define default role
define('USER_ROLE_ANONYM', 1);
define('USER_ROLE_REGISTER_DEFAUT', 1);//staff
define('USER_ROLE_ADMIN', 2);
define('USER_ROLE_STAFF', 3);
define('USER_ROLE_CUSTOMER', 4);
define('USER_ROLE_MARKETING', 5);
define('USER_ROLE_ACCOUNTING', 6);
define('USER_ROLE_DESIGN', 7);

Configure::write('User.UserRole', array(USER_DATA_INCLUDE => __('Include'), USER_DATA_EXCLUDE => __('Exclude')));

define('USER_AUTO_ACTIVE', 0);
define('USER_TOKEN_EXPIRE', 180);

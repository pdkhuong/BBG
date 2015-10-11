<?php

Router::connect('/user/admin', array('plugin' => 'User', 'controller' => 'UserAdmin', 'action' => 'index'));
Router::connect('/user/admin/:action/*', array('plugin' => 'User', 'controller' => 'UserAdmin'));

Router::connect('/user/role', array('plugin' => 'User', 'controller' => 'UserRole', 'action' => 'index'));
Router::connect('/user/role/:action/*', array('plugin' => 'User', 'controller' => 'UserRole'));

Router::connect('/user/access', array('plugin' => 'User', 'controller' => 'UserRoleRight', 'action' => 'index'));
Router::connect('/user/access/:action/*', array('plugin' => 'User', 'controller' => 'UserRoleRight'));

Router::connect('/user/role-access/users/*', array('plugin' => 'User', 'controller' => 'UserRoleAccess', 'action' => 'editUsers'));
Router::connect('/user/role-access/rights/*', array('plugin' => 'User', 'controller' => 'UserRoleAccess', 'action' => 'editRoles'));

Router::connect('/user', array('plugin' => 'User', 'controller' => 'User', 'action' => 'search'));
Router::connect('/user/:action/*', array('plugin' => 'User', 'controller' => 'User'));

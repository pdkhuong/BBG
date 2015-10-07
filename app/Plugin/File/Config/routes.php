<?php

Router::connect('/file/', array('plugin' => 'File', 'controller' => 'File', 'action' => 'listing'));
Router::connect('/file/:action/*', array('plugin' => 'File', 'controller' => 'File'));
Router::connect('/file_category/:action/*', array('plugin' => 'File', 'controller' => 'FileCategory'));


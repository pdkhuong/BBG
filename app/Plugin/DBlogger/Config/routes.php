<?php

Router::connect('/dblogger', array('plugin' => 'DBlogger', 'controller' => 'DBlogger', 'action' => 'index'));
Router::connect('/dblogger/:action/*', array('plugin' => 'DBlogger', 'controller' => 'DBlogger'));

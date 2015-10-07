<?php

Router::connect('/request-log', array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'index'));
Router::connect('/request-log/:action/*', array('plugin' => 'RequestLog', 'controller' => 'RequestLog'));

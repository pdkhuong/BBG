<?php
Router::connect('/CodeGenerator/:action/*', array('plugin' => 'CodeGenerator', 'controller' => 'CodeGenerator'));
?>
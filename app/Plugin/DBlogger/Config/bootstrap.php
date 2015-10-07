<?php
define('DBLOGGER_TYPE_WARNING', 'warning');
define('DBLOGGER_TYPE_ERROR', 'error');
Configure::write('DBlogger.Types', array(DBLOGGER_TYPE_WARNING => __('Warning'), DBLOGGER_TYPE_ERROR => __('Error')));

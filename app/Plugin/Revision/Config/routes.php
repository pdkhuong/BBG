<?php
/**
 * Created by thang.tran@seamiq.com
 * Date : 3/31/14
 * Time : 4:54 PM
 * Mail : thangcest2@gmail.com 
 * Tel  : 0949 795 597
 * Skype: ducthang_tran167
 */
Router::connect('/revision', array('plugin' => 'Revision', 'controller' => 'Revision', 'action' => 'index'));
Router::connect('/revision/:action/*', array('plugin' => 'Revision', 'controller' => 'Revision'));
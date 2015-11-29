<?php

/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */
/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter . By Default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 * 		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 * 		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 * 		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
  'AssetDispatcher',
  'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
/*
  Load the plugin
 */
//CakePlugin::load('System', array('bootstrap' => TRUE, 'routes' => TRUE));
//CakePlugin::load('DebugKit');
CakePlugin::load('Blocks', array('bootstrap' => TRUE));
CakePlugin::load('MultiLanguage', array('bootstrap' => TRUE, 'routes' => TRUE));
CakePlugin::load('User', array('bootstrap' => TRUE, 'routes' => TRUE));

/*
 * Config User url access rule
 */
Configure::write('USER_EXCLUDE_CONTROLLER', array(
  'controller' => array(
    'Test01Controller' => array('action1' => 1),
    'SystemToolsController' => array(),
    'AjaxController' => array(),
  ),
  'plugin' => array(
    'MultiLanguage' => array(
      'MultiLanguageController' => array('change' => 1)
    ),
    'User' => array(
      'UserController' => array(
        'register' => 1, 'logout' => 1, 'login' => 1, 'activate' => 1,
        'myProfile' => 1, 'forgotPassword' => 1, 'resetPassword' => 1,
        'profile' => 1,
      ),
      'UserAdminController' => array('logout' => 1, 'login' => 1),
    ),
  )
));
Configure::write('USER_EXCLUDE_URL', array(
  '/app-download'
));
/*
 * Only Controller is defined. Donot define action
 */
Configure::write('USER_EXCLUDE_PARENT_CONTROLLER', array(
  'controller' => array(
    'AppApiController' => 1, 'TestParent01Controller' => 1
  ),
  'plugin' => array(
    'Plugin01' => array(
      'Test01Controller' => 1
    ),
  )
));


Configure::write('USER_EXCLUDE_URL_REGEX', array(
  '/^\/multi-language\/change\/[a-z]{3}$/',
));
/*
 * End of config User url access rule
 */



/*
 * App configuraion
 */
Configure::write('AppDateFormat', 'ymd');


//HTTP Access
define('SF_HTTP_ACCESS_USER', '');
define('SF_HTTP_ACCESS_PASS', '');

Configure::write('SHIP_TYPE', array(
  1 => 'Truck',
  2 => 'POS'
));
Configure::write('PAPER_NAME', array(
  1 => 'IVORY',
  2 => 'DUPLEX',
  3 => 'BRISTOL',
  4 => 'COUCHE',
  5 => 'ART',
  6 => 'DECAL',
  7 => 'CARTON BOARD',
));

Configure::write('UPLOAD_EXTENSION', array(
  'jpg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ai', 'cdr'
));

define("ITEM_PER_PAGE", 20);
define("STATUS_CREATED", 0);
define("STATUS_APPROVED", 1);
define("UPLOAD_BASE_DIR", 'files/uploads');
include_once(__DIR__ . '/functions.php');

//email nhắc lịch làm việc trước 1 ngày = 86400s
define("EVENT_REMIDER_TIMER", 86400);
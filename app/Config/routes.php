<?php

/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
Router::connect('/', array('controller' => 'Dashboard', 'action' => 'display'));

Router::connect('/purche-order', array('controller' => 'PurcheOrder', 'action' => 'index'));
Router::connect('/purche-order/:action/*', array('controller' => 'PurcheOrder'));

Router::connect('/products', array('controller' => 'Product', 'action' => 'index'));
Router::connect('/products/:id', array('controller' => 'Product', 'action' => 'index'), array('pass' => array('id'), 'id' => '[0-9]+'));
Router::connect('/products/:action/*', array('controller' => 'Product'));
Router::connect('/categories', array('controller' => 'Category', 'action' => 'index'));
Router::connect('/categories/:id', array('controller' => 'Category', 'action' => 'index'), array('pass' => array('id'), 'id' => '[0-9]+'));
Router::connect('/categories/:action/*', array('controller' => 'Category'));
Router::connect('/attributes', array('controller' => 'Attribute', 'action' => 'index'));
Router::connect('/attributes/:action/*', array('controller' => 'Attribute'));

Router::connect('/api/products/:action/*', array('controller' => 'AppApiProduct'));
Router::connect('/api/templates/:action/*', array('controller' => 'AppApiTemplate'));
Router::connect('/app-download', array('controller' => 'AppDownload', 'action' => 'index'));

CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';

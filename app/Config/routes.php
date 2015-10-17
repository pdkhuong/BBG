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

Router::connect('/purchase-order', array('controller' => 'PurchaseOrder', 'action' => 'index'));
Router::connect('/purchase-order/:action/*', array('controller' => 'PurchaseOrder'));

Router::connect('/products', array('controller' => 'Product', 'action' => 'index'));
Router::connect('/products/:action/*', array('controller' => 'Product'));

Router::connect('/settings', array('controller' => 'Settings', 'action' => 'index'));
Router::connect('/settings/:action/*', array('controller' => 'Settings'));

Router::connect('/costing', array('controller' => 'Costing', 'action' => 'index'));
Router::connect('/settings/:action/*', array('controller' => 'Costing'));

Router::connect('/product-order', array('controller' => 'ProductOrder', 'action' => 'index'));
Router::connect('/product-order/:action/*', array('controller' => 'ProductOrder'));

CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';

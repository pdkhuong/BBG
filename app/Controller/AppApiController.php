<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('AppModel', 'Model');
App::uses('ConnectionManager', 'Model');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppApiController extends Controller {

  /**
   * Components
   *
   * @var array
   * @access public
   */
  public $components = array(
    'Session',
    'Cookie',
    'RequestHandler',
    'User.User',
    'MultiLanguage.MultiLanguage'
  );
  var $jsResponse = array();

  function beforeFilter() {
    parent::beforeFilter();

    if (SF_HTTP_ACCESS_USER != '' && (@$_SERVER['PHP_AUTH_USER'] != SF_HTTP_ACCESS_USER || @$_SERVER['PHP_AUTH_PW'] != SF_HTTP_ACCESS_PASS)) {

      $json_response = array(
        'status' => "error",
        'app' => "common",
        "error_description" => "alert_error_unauthorized"
      );
      $this->responseJson($json_response);
      $this->response->send();
      $this->_stop();
    }
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  protected function responseJson($data) {
    $this->response->type('json');
    $this->response->body(json_encode($data));

    return $this->response;
  }

  protected function getRequestBody() {
    $entity_body = file_get_contents('php://input');
    return $entity_body;
  }

  protected function responseInvalidParameters() {
    $json_response = array(
      'status' => "error",
      'app' => "common",
      "error_description" => "alert_invalid_parameter"
    );
    $this->responseJson($json_response);
  }

  protected function responseOk() {
    $json_response = array(
      'status' => "ok",
      'app' => "common",
    );
    $this->responseJson($json_response);
  }

}

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
App::uses('Sanitize', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

  /**
   * Components
   *
   * @var array
   * @access public
   */
  public $helpers = array(
    'Html' => array(
      'className' => 'SFHtml',
      'configFile' => 'sfinput'
    ),
    'Form' => array(
      'className' => 'SFForm'
    ),
    'Paginator' => array(
      'className' => 'SFPaginator'
    ),
    //'Session',
    'Text',
    'Js',
    'Blocks.Elements',
    'MultiLanguage.MultiLanguage');
  public $components = array(
    'Session' => array(
      'className' => 'SFSession'
    ),
    //'RequestLog.RequestLog',
    'Cookie',
    'RequestHandler',
    'Blocks.Blocks',
    'User.User',
    'MultiLanguage.MultiLanguage',
    'Paginator');
  public $theme = "BaoBiGiay";
  var $jsResponse = array();

  function beforeFilter() {
    parent::beforeFilter();

    $js = array();
    $js['data'] = json_encode(array());
    $js['messages'] = array(
      "error_title" => __("Error!!!"),
      "success_title" => __("Success!!!"),
      "hint_text" => __("Input keyword for searching"),
      "no_results_text" => __("No data"),
      "searching_text" => __("Searching...")
    );

    $this->set('js', $js);

    $this->layout = 'default';

    if ($this->RequestHandler->isAjax()) {
      $this->layout = 'ajax';
    }
  }

  function beforeRender() {
    parent::beforeRender();
    $this->set('controller', $this);
    $this->setHeadTitle();
  }
  function checkCanDo($objData = array()){
    $canDo = true;
    if(!$this->isAdmin()){
      $isCustomer = $this->isCustomer();
      $roleRight = ClassRegistry::init('User.UserRoleRight');
      list($rolesP, $rolesC) = $roleRight->getRightByRole($this->loggedUser->Role);
      $currentPlugin = $this->params['plugin'];
      $currentController = $this->params['controller'].'Controller';
      $currentAction = $this->params['action'];
      $modelName = $this->modelClass;
      $args = $this->passedArgs;
      $currentUserId = $this->loggedUser->User->id;
      if(isset($rolesC[$currentController][$currentAction]['owner']) && $rolesC[$currentController][$currentAction]['owner'] == 1){
        if(empty($objData)){
          $canDo = true;
        }else{
          switch($modelName){
            case 'Calendar':
              if(!isset($objData[$modelName]) || $objData[$modelName]['user_id'] != $currentUserId){
                $canDo = false;
              }
              break;
            case 'Customer':
              if($isCustomer){
                if(!isset($objData[$modelName]) || $objData[$modelName]['customer_user_id'] != $currentUserId){
                  $canDo = false;
                }
              }else{
                if(!isset($objData[$modelName]) || $objData[$modelName]['user_id'] != $currentUserId){
                  $canDo = false;
                }
              }

              break;
            case 'Product':
            case 'Costing':
            case 'PurchaseOrder':
            case 'PurchaseRequest':
            case 'FacsimileMassage':
              if(!isset($objData[$modelName]) || $objData[$modelName]['user_id'] != $currentUserId){
                $canDo = false;
              }
              if($isCustomer){
                $customerId = $this->getCustomerIdByUser($currentUserId);
                if(isset($objData[$modelName]) && $objData[$modelName]['customer_id'] == $customerId) {
                  $canDo = true;
                }
              }
              break;
            case 'WorksSheet':
              if(!isset($objData[$modelName]) || $objData[$modelName]['created_user_id'] != $currentUserId){
                $canDo = false;
              }
              if($isCustomer){
                $customerId = $this->getCustomerIdByUser($currentUserId);
                if(isset($objData[$modelName]) && $objData[$modelName]['customer_id'] == $customerId) {
                  $canDo = true;
                }
              }
              break;
            case 'File':
            case 'Vendor':
            case 'Lead':
              if(!isset($objData[$modelName]) || $objData[$modelName]['user_id'] != $currentUserId){
                $canDo = false;
              }
              break;
          }
        }
      }
    }
    if(!$canDo){
      $this->Session->setFlash(__('You are not authorized to access this page'), 'flash/error');
      $this->redirect('/');
    }
  }
  function listPermission(){
    $roleRight = ClassRegistry::init('User.UserRoleRight');
    return $roleRight->getRightByRole($this->loggedUser->Role);
  }
  function getInitCondition(){
    $conditions = array();
    $modelName = $this->modelClass;
    $conditions[$modelName.'.deleted_time'] = null;
    if(!$this->isAdmin()){
      $roleRight = ClassRegistry::init('User.UserRoleRight');
      list($rolesP, $rolesC) = $roleRight->getRightByRole($this->loggedUser->Role);
      $currentController = $this->params['controller'].'Controller';
      $currentAction = $this->params['action'];
      $currentUserId = $this->loggedUser->User->id;
      $isCustomer = false;
      $customerId = array();
      if(isset($this->loggedUser->Role[USER_ROLE_CUSTOMER])){
        $isCustomer = true;
        $customerId = $this->getCustomerIdByUser($currentUserId);
      }
      if(isset($rolesC[$currentController][$currentAction]['owner']) && $rolesC[$currentController][$currentAction]['owner'] == 1){
        switch($modelName){
          case 'Calendar':
            $conditions[$modelName.'.user_id'] = $currentUserId;
            break;
          case 'Customer':
            if($isCustomer){
              $conditions[$modelName.'.customer_user_id'] = $currentUserId;
            }else{
              $conditions[$modelName.'.user_id'] = $currentUserId;
            }
            break;
          case 'Lead':
          case 'Vendor':
            $conditions[$modelName.'.user_id'] = $currentUserId;
            break;
          case 'Costing':
          case 'Product':
          case 'PurchaseOrder':
          case 'PurchaseRequest':
          case 'FacsimileMassage':
            if($isCustomer){
              $conditions['OR'] = array(
                array($modelName.'.user_id' => $currentUserId),
                array($modelName.'.customer_id' => $customerId),
              );
            }else{
              $conditions[$modelName.'.user_id'] = $currentUserId;
            }
            break;
          case 'WorksSheet':
            if($isCustomer){
              $conditions['OR'] = array(
                array($modelName.'.created_user_id' => $currentUserId),
                array($modelName.'.customer_id' => $customerId),
              );
            }else{
              $conditions[$modelName.'.created_user_id'] = $currentUserId;
            }
            break;
        }
      }
    }
    return $conditions;
  }
  function isAdmin(){
    $isAdmin = false;
    if($this->loggedUser->Admin->id > 0 || isset($this->loggedUser->Role[USER_ROLE_ADMIN])){
      $isAdmin = true;
    }
    return $isAdmin;
  }
  function isCustomer(){
    $isCustomer = false;
    if(isset($this->loggedUser->Role[USER_ROLE_CUSTOMER])){
      $isCustomer = true;
    }
    return $isCustomer;
  }
  function isAccounting(){
    $isAccounting = false;
    if(isset($this->loggedUser->Role[USER_ROLE_ACCOUNTING])){
      $isAccounting = true;
    }
    return $isAccounting;
  }
  function listCustomer(){
    $currentUserId = $this->loggedUser->User->id;
    $model = ClassRegistry::init('Customer');
    if($this->isAdmin()){
      $listCustomer = $model->find("list");
    }elseif($this->isCustomer()){
      $customerId = $this->getCustomerIdByUser($currentUserId);
      $listCustomer = $model->find("list", array('conditions'=> array(
        'Customer.id' =>$customerId
      )));
    }else{
      $listCustomer = $model->find("list", array('conditions'=> array(
        'Customer.user_id' =>$currentUserId
      )));
    }
    return $listCustomer;
  }
  function listProduct($isList=true){
    $currentUserId = $this->loggedUser->User->id;
    $model = ClassRegistry::init('Product');
    if($isList){
      if($this->isAdmin()){
        $listProduct = $model->find("list");
      }elseif($this->isCustomer()){
        $customerId = $this->getCustomerIdByUser($currentUserId);
        $conditions['OR'] = array(
          array('Product.user_id' => $currentUserId),
          array('Product.customer_id' => $customerId),
        );
        $listProduct = $model->find("list", array('conditions'=> $conditions));
      }else{
        $listProduct = $model->find("list", array('conditions'=> array(
          'Product.user_id' =>$currentUserId
        )));
      }
    }else{
      if($this->isAdmin()){
        $listProduct = $model->find("all");
      }elseif($this->isCustomer()){
        $customerId = $this->getCustomerIdByUser($currentUserId);
        $conditions['OR'] = array(
          array('Product.user_id' => $currentUserId),
          array('Product.customer_id' => $customerId),
        );
        $listProduct = $model->find("all", array('conditions'=> $conditions));
      }else{
        $listProduct = $model->find("all", array('conditions'=> array(
          'Product.user_id' =>$currentUserId
        )));
      }
      $listProduct = Hash::combine($listProduct, '{n}.Product.id', '{n}');
    }
    return $listProduct;
  }
  function getCustomerIdByUser($linkedUserId){
    $customerModel = ClassRegistry::init('Customer');
    $customer = $customerModel->find("first", array('conditions' => array(
      'customer_user_id' => $linkedUserId
    )));
    return isset($customer['Customer']['id']) ? $customer['Customer']['id'] : 0;
  }
  //------------------------------

  function setHeadTitle() {
    $this->set('title_for_layout', "Bao Bì Giấy Hoàng Vương");
  }

  function afterFilter() {
    parent::afterFilter();
    if (isset($_SERVER['HTTP_SF_AJAX_HEADER']) && $_SERVER['HTTP_SF_AJAX_HEADER'] == 'sfDialog') {
      unset($this->viewVars['controller']);
      $scripts = isset($this->jsResponse['script']) ? $this->jsResponse['script'] : array();

      $this->jsResponse = array();
      $this->jsResponse['id_display']['sfDialogModel_title'] = isset($this->viewVars['title']) ? $this->viewVars['title'] : '';
      $this->jsResponse['id_display']['sfDialogModel_body'] = $this->render();
      $this->jsResponse['script'][] = '$("#sfDialogModel").modal("show")';
      $this->jsResponse['script'][] = '$("#sfDialogModel").scrollTop(0);';
      foreach ($scripts as $script) {
        $this->jsResponse['script'][] = $script;
      }
      $this->renderJsResponse();
    } elseif (count($this->jsResponse) > 0) {
      $this->renderJsResponse();
    }
  }

  protected function responseJson($data) {
    $this->autoRender = false;
    $this->response->type('json');
    $this->response->body(json_encode($data));
  }

  protected function renderJsResponse() {
    foreach ($this->jsResponse as $key => $value) {
      switch ($key) {
        case 'id_display':
          foreach ($value as $key1 => $value1) {
            $this->jsResponse[$key][$key1] = base64_encode($value1);
          }
        case 'id_append':
          foreach ($value as $key1 => $value1) {
            $this->jsResponse[$key][$key1] = base64_encode($value1);
          }
        case 'modal_dialog':
          foreach ($value as $key1 => $value1) {
            if ($key1 == 'title' || $key1 == 'content') {
              $this->jsResponse[$key][$key1] = base64_encode($value1);
            }
          }
      }
    }
    echo json_encode($this->jsResponse);
    die;
  }

  protected function responseCSV($data, $options = array()) {
    $file_name = "CMS-Translation.csv";
    if (isset($options['file_name'])) {
      $file_name = $options['file_name'];
    }
    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header("Content-Disposition: attachment;filename={$file_name}");
    header('Cache-Control: max-age=0');

    echo $data;
    exit;
  }

  protected function setCookie($options = array(), $cookieKey = 'User') {
    if (empty($this->request->data[$this->modelClass]['remember_me'])) {
      $this->Cookie->delete($cookieKey);
    } else {
      $validProperties = array('domain', 'key', 'name', 'path', 'secure', 'time');
      $defaults = array('name' => 'remember_me');

      $options = array_merge($defaults, $options);
      foreach ($options as $key => $value) {
        if (in_array($key, $validProperties)) {
          $this->Cookie->{$key} = $value;
        }
      }

      $cookieData = array(
        'model_class' => $this->modelClass,
        'email' => $this->request->data[$this->modelClass]['email'],
        'password' => sha1($this->request->data[$this->modelClass]['password'])
      );
      $this->Cookie->write($cookieKey, $cookieData, true, '1 Month');
    }
    unset($this->request->data[$this->modelClass]['remember_me']);
  }

  public function beforeRedirect($url, $status = null, $exit = true) {
    $this->Session->write('SFRedirectParams', array(
      'status' => TRUE,
      'plugin' => $this->params['plugin'],
      'controller' => $this->params['controller'],
      'action' => $this->params['action'],
    ));
  }

}

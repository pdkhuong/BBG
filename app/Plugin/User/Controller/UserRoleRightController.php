<?php

class UserRoleRightController extends AppController {

  var $uses = array('User.UserRole');

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'UserRoleRight';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  private function _listController(){

    $folderPath =  ROOT . '/app/Controller';
    if (is_dir($folderPath)) {
      $controllerFileNames = scandir($folderPath);
      foreach ($controllerFileNames as $controllerFileName) {
        $modelFullPath = $folderPath . '/' . $controllerFileName;
        if (is_file($modelFullPath)) {
          if ($controllerFileName!='AppController.php' && strpos($controllerFileName, 'Controller') !== FALSE) {
            $modelName = substr($controllerFileName, 0, -4);
            $controllerArr[] = $modelName;
          }

        }
      }
    }
    $ret['Controller']  = $controllerArr;
    $ret['UserPluginCotroller']  =  array(
      'UserController',
      'UserRoleAccessController',
      'UserRoleController',
      'UserRoleRightController'
    );
    return $ret;
  }
  public function edit($id) {
    $this->set('role', $this->UserRole->findById($id));
    $listController = $this->_listController();
    $userPluginController = $listController['UserPluginCotroller'];
    $roleRightSelected = array();

    if (empty($this->request->data)) {
      $roleRightDbObj = $this->UserRoleRight->findAllByRoleId($id);
      if($roleRightDbObj){
        foreach($roleRightDbObj as $roleRight){
          $roleRight = $roleRight['UserRoleRight'];
          $roleRightSelected[] = $roleRight['controller'];
        }
      }
    }else{
      $listControllerRequest = $this->request->data;
      $sql = "DELETE FROM {$this->UserRoleRight->useTable} WHERE role_id={$id}";
      $this->UserRoleRight->query($sql);
      if($listControllerRequest){
        foreach($listControllerRequest as $controller => $status){
          $roleRightSelected[] = $controller;
          $data = array();
          if(in_array($controller, $userPluginController)){
            $data['plugin'] = 'User';
          }
          $data['controller'] = $controller;
          $data['role_id'] = $id;
          $this->UserRoleRight->save($data);
          $this->UserRoleRight->clear();
        }
      }
      //$this->Session->setFlash(__('Your data is updated successfully'), 'flash/success');
      $this->redirect(Router::url(array('plugin' =>'User', 'controller' =>'UserRole', 'action' => 'index')));
    }
    $this->set('roleRightSelected', $roleRightSelected);
    $this->set('listController', $listController);
  }
}

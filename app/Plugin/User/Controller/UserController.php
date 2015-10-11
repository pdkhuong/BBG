<?php
App::uses('PasswordHash', 'Lib');
class UserController extends AppController
{

  var $uses = array('User.UserRoleAccess', 'User.UserRole');

  public function beforeFilter()
  {
    parent::beforeFilter();
    $this->modelClass = 'UserModel';
  }

  function beforeRender()
  {
    parent::beforeRender();
  }

  function afterFilter()
  {
    parent::afterFilter();
  }

  public function index()
  {

  }

  public function register(){
    if (empty($this->request->data)) {
      $this->request->data = NULL;
    } else {
      if ($this->UserModel->register($this->request->data)) {
        if (USER_AUTO_ACTIVE == 1) {
          $this->view = 'register_success_non_active';
        } else {
          $this->view = 'register_success_active';
        }
      }
    }
  }
  public function activate($token='token') {
    $userModel = $this->UserModel->findByUserActivationKey($token);
    if(empty($userModel)) {
      $this->set('message',__('The token is not correct'));
    } else {
      if($userModel['UserModel']['user_status'] != USER_INACTIVE || ((time() - strtotime($userModel['UserModel']['user_registered']))/60) > USER_TOKEN_EXPIRE) {
        $this->set('message',__('The token is expired'));
      } else {
        $userModel['UserModel']['user_status'] = USER_ACTIVE;
        $userModel['UserModel']['user_activation_key'] = NULL;
        $this->UserModel->save($userModel, false);
        $this->set('message',__('Your account is activated. Please login to continue.'));
      }
    }
  }

  public function view($id)
  {

    $data = $this->UserModel->findById($id);
    if (!empty($data['UserModel']['deleted_time'])) {
      $this->Session->setFlash(__('This  has been deleted'), 'flash/error');
    }
    $this->set('data', $data);
  }

  public function edit($id = 0)
  {

    if (empty($this->request->data)) {
      $this->request->data = $this->UserModel->findById($id);
    } else {
      if ($this->request->data['UserModel']['password']) {
        $wp_hasher = new PasswordHash(8, true);
        $inputPassword = trim($this->request->data['UserModel']['password']);
        $this->request->data['UserModel']['user_pass'] = $wp_hasher->HashPassword($inputPassword);
        $this->request->data['UserModel']['password_confirmation'] = $inputPassword;
      }
      $this->request->data['UserModel']['display_name'] = $this->request->data['UserModel']['firstname'].' '.$this->request->data['UserModel']['lastname'];
      if ($this->UserModel->save($this->request->data)) {
        $this->UserModel->addRegisteredRole($this->UserModel->getId());
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'search')));
      }
    }
  }

  public function edit_with_role($id = 0)
  {

    $this->view = 'edit_with_role';
    $this->set('roles', Hash::combine($this->UserRole->find('all'), '{n}.UserRole.id', '{n}.UserRole.name'));

    if (empty($this->request->data)) {
      $this->request->data = $this->UserModel->findById($id);
      $roleAccess = $this->UserRoleAccess->findByUserId($id);
      if (!empty($roleAccess)) {
        $this->request->data['UserModel']['role'] = $roleAccess['UserRole']['id'];
      }
    } else {
      if ($this->request->data['UserModel']['password']) {
        $wp_hasher = new PasswordHash(8, true);
        $inputPassword = trim($this->request->data['UserModel']['password']);
        $this->request->data['UserModel']['user_pass'] = $wp_hasher->HashPassword($inputPassword);
        $this->request->data['UserModel']['password_confirmation'] = $inputPassword;
      }

      if ($this->UserModel->save($this->request->data)) {
        $this->UserModel->onlyOneRole($this->UserModel->getId(), $this->request->data['UserModel']['role']);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'search')));
      }
    }
  }

  public function delete($id)
  {
    $this->UserModel->deleteLogic($id);
    return $this->redirect(Router::url(array('plugin' => 'User', 'controller' => 'User', 'action' => 'search')) . '/');
  }

  public function search()
  {
    $this->set('selectedRoles', Hash::combine($this->UserRoleAccess->find('all'), '{n}.UserRoleAccess.role_id', '{n}.UserRole.name', '{n}.UserRoleAccess.user_id'));
    $this->set('displayPaging', true);
    $this->Paginator->settings = array(
    'limit' => 10
    );
    $dataList = $this->Paginator->paginate('UserModel');

    $this->set('dataList', $dataList);
  }

}

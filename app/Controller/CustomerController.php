<?php

class CustomerController extends AppController {
  var $uses = array(
    'Customer',
    'CustomerContact',
    'Product',
    'User.UserModel',
    'User.UserRoleAccess'
  );
  
  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Customer';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  public function view($id=0){
    $data = $this->Customer->findById($id);
    $this->checkCanDo($data);
    $this->set('data', $data);
    $contacts = $this->CustomerContact->findAllByCustomerId($id);
    $this->set('contacts', $contacts);
  }
  public function edit($id = 0) {
    $customerDb = $this->Customer->findById($id);
    $this->checkCanDo($customerDb);
    $listUser = array();
    $currentUserId = $this->loggedUser->User->id;;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser =  $this->UserModel->listUser();
    }
    $this->set('listUser', $listUser);
	  $addedContact = array();
    $contactBeforeAdded = $this->CustomerContact->findAllByCustomerId($id);
    $contactBeforeAdded = Hash::combine($contactBeforeAdded, '{n}.CustomerContact.id', '{n}.CustomerContact');
    if (empty($this->request->data)) {//show on edit
	    $addedContact = $contactBeforeAdded;
      $this->request->data = $customerDb;
    } else {//save
		$create = true;
		if($this->request->data['Customer']['id']) $create = false;
	    $addedContact = isset($this->request->data['CustomerContact'])?$this->request->data['CustomerContact']:array();
      if(!isset($this->request->data['Customer']['user_id'])){
        $this->request->data['Customer']['user_id'] = $currentUserId;
      }
      $this->Customer->set($this->request->data);
      if ($this->Customer->save()) {
	    if($create){ //tạo customer
			$user = array("UserModel"=>[
				'user_login' => $this->request->data['Customer']['name'],
				'user_email' => $this->request->data['Customer']['email'],
				'display_name' => $this->request->data['Customer']['name'],
				'firstname' => $this->request->data['Customer']['name'],
				'lastname' => $this->request->data['Customer']['name'],
				'user_status' => USER_ACTIVE
			]);
			if ($this->request->data['Customer']['password']) {
				$wp_hasher = new PasswordHash(8, true);
				$inputPassword = trim($this->request->data['Customer']['password']);
				$user['UserModel']['password'] = $this->request->data['Customer']['password'];
				$user['UserModel']['user_pass'] = $wp_hasher->HashPassword($inputPassword);
				$user['UserModel']['password_confirmation'] = $inputPassword;
			}
			if($this->UserModel->save($user)){//thêm 1 row vào table wp_users				
				$this->request->data['Customer']['id'] = $this->Customer->getId();
				$this->request->data['Customer']['customer_user_id'] = $this->UserModel->getId();
				$this->Customer->save($this->request->data); // update lại customer_user_id cho customer 
				$userRoleAccessData = array("UserRoleAccess" =>[
					'role_id' => USER_ROLE_CUSTOMER,
					'user_id' => $this->UserModel->getId()
				]);
				$this->UserRoleAccess->save($userRoleAccessData);
			}else{
				//var_dump($this->UserModel->validationErrors);exit;
			}
		}else{ //edit customer
			// hiện tại không cho đổi password và email của table user
		}
        $customerId = $this->Customer->getId();
        $this->_saveContact($customerId, $addedContact, $contactBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
	$this->set('addedContact', $addedContact);
	$this->set("errorObj", $this->Customer->validationErrors);
  }

  public function delete($id) {
    $customerDb = $this->Customer->findById($id);
    if($customerDb){
      $this->checkCanDo($customerDb);
      $this->Customer->deleteLogic($id);
      $this->CustomerContact->deleteAll(array('customer_id' => $id), false);
      $this->Product->deleteAll(array('customer_id' => $id), false);
    }
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
    $condition = $this->getInitCondition();
    $this->set('displayPaging', true);
    $this->Paginator->settings = array(
      'conditions' => $condition,
      'limit' => ITEM_PER_PAGE
    );
    $dataList = $this->Paginator->paginate('Customer');
    $this->set('dataList', $dataList);
  }

  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }
  
  private function _saveContact($customerId, $addedContact, $contactBeforeAdded){
	$idContactAdded = array_keys($addedContact);
	$removedId = array();
	if($contactBeforeAdded){
	foreach($contactBeforeAdded as $pId => $pBefore){
	  if(!in_array($pId, $idContactAdded)){
		$removedId[] = $pId;
	  }
	}
	if($removedId){
	  $strRemovedId = implode(", ", $removedId);
	  $query = "DELETE FROM {$this->CustomerContact->useTable} WHERE id IN ({$strRemovedId})";
	  $this->CustomerContact->query($query);
	}
	}
	foreach($addedContact as $contactId => $contact){
		if(is_numeric($contactId)){
			$contact['id'] = $contactId;			
		}
		$contact['customer_id'] = $customerId;
		$this->CustomerContact->save($contact);
		$this->CustomerContact->clear();
	}
  }

}

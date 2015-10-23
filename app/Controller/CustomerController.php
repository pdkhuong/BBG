<?php

class CustomerController extends AppController {
  var $uses = array(
    'Customer',
    'CustomerContact',
    'User.UserModel'
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

  public function edit($id = 0) {
    $customerDb = $this->Customer->findById($id);
    $listUser = array();
    $currentUserId = 0;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser = Hash::combine($this->UserModel->find("all"), '{n}.UserModel.id', '{n}.UserModel.display_name');
    }else{
      $currentUserId = $this->loggedUser->User->id;
      if($customerDb && $customerDb['Customer']['user_id'] != $currentUserId){
        die("Cannot not access this page");
      }
    }
    $this->set('listUser', $listUser);
	  $addedContact = array();
    $contactBeforeAdded = $this->CustomerContact->findAllByCustomerId($id);
    $contactBeforeAdded = Hash::combine($contactBeforeAdded, '{n}.CustomerContact.id', '{n}.CustomerContact');
    if (empty($this->request->data)) {//show on edit
	    $addedContact = $contactBeforeAdded;
      $this->request->data = $customerDb;
    } else {//save
	    $addedContact = isset($this->request->data['CustomerContact'])?$this->request->data['CustomerContact']:array();
      if(!isset($this->request->data['Customer']['user_id'])){
        $this->request->data['Customer']['user_id'] = $currentUserId;
      }
      $this->Customer->set($this->request->data);
      if ($this->Customer->save()) {
        $customerId = $this->Customer->getId();
        $this->_saveContact($customerId, $addedContact, $contactBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
	$this->set('addedContact', $addedContact);
  }

  public function delete($id) {
    $customerDb = $this->Customer->findById($id);
    $isAdmin = $this->isAdmin();
    if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      if($customerDb && $customerDb['Customer']['user_id'] != $currentUserId){
        die("Cannot not access this page");
      }
    }
    $this->Customer->deleteLogic($id);
	  $this->CustomerContact->deleteAll(array('customer_id' => $id), false);
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
    $condition = array();
    $condition['Customer.deleted_time'] = null;
    $isAdmin = $this->isAdmin();
    if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      $condition['Customer.user_id'] = $currentUserId;
    }
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

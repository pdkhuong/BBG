<?php

class VendorController extends AppController {
  var $uses = array(
    'Vendor',
    'VendorContact',
    'User.UserModel'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Vendor';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    $vendorDb = $this->Vendor->findById($id);
    $listUser = array();
    $currentUserId = 0;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser = Hash::combine($this->UserModel->find("all"), '{n}.UserModel.id', '{n}.UserModel.display_name');
    }else{
      $currentUserId = $this->loggedUser->User->id;
      if($vendorDb && $vendorDb['Vendor']['user_id'] != $currentUserId){
        die("Cannot not access this page");
      }
    }
    $this->set('listUser', $listUser);
	  $addedContact = array();
    $contactBeforeAdded = $this->VendorContact->findAllByVendorId($id);
    $contactBeforeAdded = Hash::combine($contactBeforeAdded, '{n}.VendorContact.id', '{n}.VendorContact');
    if (empty($this->request->data)) {//show on edit
	  $addedContact = $contactBeforeAdded;
      $this->request->data = $vendorDb;
    } else {//save
      if(!isset($this->request->data['Vendor']['user_id'])){
        $this->request->data['Vendor']['user_id'] = $currentUserId;
      }
	    $addedContact = isset($this->request->data['VendorContact'])?$this->request->data['VendorContact']:array();
      $this->Vendor->set($this->request->data);
      if ($this->Vendor->save()) {
        $vendorId = $this->Vendor->getId();
        $this->_saveContact($vendorId, $addedContact, $contactBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
	  $this->set('addedContact', $addedContact);
  }

  public function delete($id) {
    $vendorDb = $this->Vendor->findById($id);
    $isAdmin = $this->isAdmin();
    if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      if($vendorDb && $vendorDb['Vendor']['user_id'] != $currentUserId){
        die("Cannot not access this page");
      }
    }
    $this->Vendor->deleteLogic($id);
	  $this->VendorContact->deleteAll(array('vendor_id' => $id), false);
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
    $condition = array();
    $condition['Vendor.deleted_time'] = null;
    $isAdmin = $this->isAdmin();
    if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      $condition['Vendor.user_id'] = $currentUserId;
    }

    $this->set('displayPaging', true);
    $this->Paginator->settings = array(
      'conditions' => $condition,
      'limit' => ITEM_PER_PAGE
    );
    $dataList = $this->Paginator->paginate('Vendor');
    $this->set('dataList', $dataList);
  }

  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }
  
  private function _saveContact($vendorId, $addedContact, $contactBeforeAdded){
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
	  $query = "DELETE FROM {$this->VendorContact->useTable} WHERE id IN ({$strRemovedId})";
	  $this->VendorContact->query($query);
	}
	}
	foreach($addedContact as $contactId => $contact){
		if(is_numeric($contactId)){
			$contact['id'] = $contactId;			
		}
		$contact['vendor_id'] = $vendorId;
		$this->VendorContact->save($contact);
		$this->VendorContact->clear();
	}
  }

}

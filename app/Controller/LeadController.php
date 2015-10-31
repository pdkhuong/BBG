<?php

class LeadController extends AppController {
  var $uses = array(
    'Lead',
    'LeadContact',
    'User.UserModel'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Lead';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  public function view($id=0){
    $data = $this->Lead->findById($id);
    $this->checkCanDo($data);
    $this->set('data', $data);
    $contacts = $this->LeadContact->findAllByLeadId($id);
    $this->set('contacts', $contacts);
  }
  public function edit($id = 0) {
    $leadDb = $this->Lead->findById($id);
    $this->checkCanDo($leadDb);
    $listUser = array();
    $currentUserId = $this->loggedUser->User->id;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser = Hash::combine($this->UserModel->find("all"), '{n}.UserModel.id', '{n}.UserModel.display_name');
    }
    $this->set('listUser', $listUser);

	  $addedContact = array();
    $contactBeforeAdded = $this->LeadContact->findAllByLeadId($id);
    $contactBeforeAdded = Hash::combine($contactBeforeAdded, '{n}.LeadContact.id', '{n}.LeadContact');
    if (empty($this->request->data)) {//show on edit
	  $addedContact = $contactBeforeAdded;
      $this->request->data = $leadDb;
    } else {//save
      if(!isset($this->request->data['Lead']['user_id'])){
        $this->request->data['Lead']['user_id'] = $currentUserId;
      }
	    $addedContact = isset($this->request->data['LeadContact'])?$this->request->data['LeadContact']:array();
      $this->Lead->set($this->request->data);
      if ($this->Lead->save()) {
	      $leadId = $this->Lead->getId();
		    $this->_saveContact($leadId, $addedContact, $contactBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
	  $this->set('addedContact', $addedContact);
  }

  public function delete($id) {
    $leadDb = $this->Lead->findById($id);
    if($leadDb) {
      $this->checkCanDo($leadDb);
      $this->Lead->deleteLogic($id);
      $this->LeadContact->deleteAll(array('lead_id' => $id), false);
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
    $dataList = $this->Paginator->paginate('Lead');
    $this->set('dataList', $dataList);
  }

  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }
  
  private function _saveContact($leadId, $addedContact, $contactBeforeAdded){
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
	  $query = "DELETE FROM {$this->LeadContact->useTable} WHERE id IN ({$strRemovedId})";
	  $this->LeadContact->query($query);
	}
	}
	foreach($addedContact as $contactId => $contact){
		if(is_numeric($contactId)){
			$contact['id'] = $contactId;			
		}
		$contact['lead_id'] = $leadId;
		$this->LeadContact->save($contact);
		$this->LeadContact->clear();
	}
  }

}

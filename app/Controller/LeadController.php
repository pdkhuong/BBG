<?php

class LeadController extends AppController {
  var $uses = array(
    'Lead',
    'LeadContact',
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

  public function edit($id = 0) {
	$addedContact = array();
    $contactBeforeAdded = $this->LeadContact->findAllByLeadId($id);
    $contactBeforeAdded = Hash::combine($contactBeforeAdded, '{n}.LeadContact.id', '{n}.LeadContact');
	//var_dump($contactBeforeAdded);
    if (empty($this->request->data)) {//show on edit
	  $addedContact = $contactBeforeAdded;
      $this->request->data = $this->Lead->findById($id);
    } else {//save
	  $addedContact = isset($this->request->data['LeadContact'])?$this->request->data['LeadContact']:array();
      $this->Lead->set($this->request->data);
      if ($this->Lead->save()) {
	    $leadId = $this->Lead->getId();
		$this->_saveContact($leadId, $addedContact, $contactBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
	$this->set('addedContact', $addedContact);
  }

  public function delete($id) {
    if ($this->Lead->isInUsed($id)) {
      $this->Session->setFlash(__('Unable to delete your data. It\'s in used'), 'flash/error');
      return $this->redirect($this->referer());
    }
    $this->Lead->deleteLogic($id);
	$this->LeadContact->deleteAll(array('lead_id' => $id), false);

    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
    $condition = array();
    $condition['Lead.deleted_time'] = null;

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

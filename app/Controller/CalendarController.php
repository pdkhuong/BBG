<?php

class CalendarController extends AppController {
  var $uses = array(
    'Calendar',
    'CalendarCustomer',
    'Customer',
    'CalendarLead',
    'Lead',
    'CalendarVendor',
    'Vendor',
    'CalendarUser',
    'User.UserModel'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Calendar';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
	$calendarDb = $this->Calendar->findById($id);
    $currentUserId = 0;
    $isAdmin = $this->isAdmin();
	$listCustomer = $this->Customer->find("list");
	$listLead = $this->Lead->find("list");
	$listVendor = $this->Vendor->find("list");
	$listUser = Hash::combine($this->UserModel->find('all'), '{n}.UserModel.id', '{n}.UserModel.display_name');	    
	$addedCustomer = array();
	$addedLead = array();
	$addedVendor = array();
	$addedUser = array();
	$customerBeforeAdded = array();
	$leadBeforeAdded = array();
	$vendorBeforeAdded = array();
	$userBeforeAdded = array();
	$customerBeforeAddedFull = $this->CalendarCustomer->findAllByCalendarId($id);
	$leadBeforeAddedFull = $this->CalendarLead->findAllByCalendarId($id);
	$vendorBeforeAddedFull = $this->CalendarVendor->findAllByCalendarId($id);
	$userBeforeAddedFull = $this->CalendarUser->findAllByCalendarId($id);
	foreach($customerBeforeAddedFull as $key => $value){
		$value['CalendarCustomer']["name"] = $value['Customer']["name"];
		$customerBeforeAdded[$value['CalendarCustomer']['id']] = $value['CalendarCustomer'];
	}
	foreach($leadBeforeAddedFull as $key => $value){
		$value['CalendarLead']["name"] = $value['Lead']["name"];
		$leadBeforeAdded[$value['CalendarLead']['id']] = $value['CalendarLead'];
	}
	foreach($vendorBeforeAddedFull as $key => $value){
		$value['CalendarVendor']["name"] = $value['Vendor']["name"];
		$vendorBeforeAdded[$value['CalendarVendor']['id']] = $value['CalendarVendor'];
	}
	foreach($userBeforeAddedFull as $key => $value){
		$value['CalendarUser']["name"] = $value['User']["display_name"];
		$userBeforeAdded[$value['CalendarUser']['id']] = $value['CalendarUser'];
	}
	
	if(!$isAdmin){
		$currentUserId = $this->loggedUser->User->id;
		$userBeforeAddedIds = array();
		foreach($userBeforeAdded as $key => $value){
			$userBeforeAddedIds[] = $value['user_id'];
		}
		if(!in_array($currentUserId, $userBeforeAddedIds) && count($userBeforeAddedIds)) die("Cannot not access this page");
    }
    if (empty($this->request->data)) {//show on edit
      $this->request->data = $calendarDb;
	  $addedCustomer = $customerBeforeAdded;
	  $addedLead = $leadBeforeAdded;
	  $addedVendor = $vendorBeforeAdded;
	  $addedUser = $userBeforeAdded;
    } else {//save
      $this->Calendar->set($this->request->data);
      if ($this->Calendar->save()) {
		$calendarId = $this->Calendar->getId();
		$addedCustomer = isset($this->request->data['CalendarCustomer'])?$this->request->data['CalendarCustomer']:array();
		$addedLead = isset($this->request->data['CalendarLead'])?$this->request->data['CalendarLead']:array();
		$addedVendor = isset($this->request->data['CalendarVendor'])?$this->request->data['CalendarVendor']:array();
		$addedUser = isset($this->request->data['CalendarUser'])?$this->request->data['CalendarUser']:array();
        //var_dump($calendarId, $addedCustomer, $customerBeforeAdded);exit;
        $this->_saveCalendarCustomer($calendarId, $addedCustomer, $customerBeforeAdded);
        //var_dump($calendarId, $addedLead, $leadBeforeAdded);exit;
        $this->_saveCalendarLead($calendarId, $addedLead, $leadBeforeAdded);
        $this->_saveCalendarVendor($calendarId, $addedVendor, $vendorBeforeAdded);
        $this->_saveCalendarUser($calendarId, $addedUser, $userBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
	$this->set('addedCustomer', $addedCustomer);
	$this->set('addedLead', $addedLead);
	$this->set('addedVendor', $addedVendor);
	$this->set('addedUser', $addedUser);
	$this->set("listCustomer", $listCustomer);
	$this->set("listLead", $listLead);
	$this->set("listVendor", $listVendor);
	$this->set("listUser", $listUser);
	$this->set("errorObj", $this->Calendar->validationErrors);
  }

  public function delete($id) {
    if ($this->Calendar->isInUsed($id)) {
      $this->Session->setFlash(__('Unable to delete your data. It\'s in used'), 'flash/error');
      return $this->redirect($this->referer());
    }
    $this->Calendar->deleteLogic($id);
	$this->CalendarCustomer->deleteAll(array('calendar_id' => $id), false);
	$this->CalendarLead->deleteAll(array('calendar_id' => $id), false);
	$this->CalendarVendor->deleteAll(array('calendar_id' => $id), false);
	$this->CalendarUser->deleteAll(array('calendar_id' => $id), false);

    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
  }
  public function feed(){
	$conditions = array('from_date >='=> $this->request->data['start'], ' to_date <=' => $this->request->data['end']);
	$isAdmin = $this->isAdmin();
	if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      $conditions['user_id'] = $currentUserId;
    }
	$optionCalendar = array(
							'conditions' => $conditions,
							'joins' => array(
									array('table' => 'calendar_user',
										  'alias' => 'CalendarUser',
										  'type' => 'INNER',
										  'conditions' => array(
												'Calendar.id = CalendarUser.calendar_id')
										)
									),
							'fields' => array('Calendar.*', 'CalendarUser.*'),
							'group' => 'Calendar.id',
							);
	$dataList = $this->Calendar->find('all', $optionCalendar);
	$this->set('dataList', $dataList);
  }
  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }
  
  private function _saveCalendarCustomer($calendarId, $addedCustomer, $customerBeforeAdded){
	//delete customers
	$idCustomerAdded = array_keys($addedCustomer);
	$removedId = array();
	if($customerBeforeAdded){
		foreach($customerBeforeAdded as $cId => $cBefore){
			if(!in_array($cId, $idCustomerAdded)){
				$removedId[] = $cId;
			}
		}
		if($removedId){
		  $strRemovedId = implode(", ", $removedId);
		  $query = "DELETE FROM {$this->CalendarCustomer->useTable} WHERE id IN ({$strRemovedId})";
		  $this->CalendarCustomer->query($query);
		}
	}
	//add customers	  
	foreach($addedCustomer as $customerId => $customer){
		if(!is_numeric($customerId)){
			$customer['customer_id'] = $customer["customer_id"];
			$customer['calendar_id'] = $calendarId;
			$this->CalendarCustomer->save($customer);
			$this->CalendarCustomer->clear();
		} 
	}
  }
  
  private function _saveCalendarLead($calendarId, $addedLead, $leadBeforeAdded){
	//delete leads
	$idLeadAdded = array_keys($addedLead);
	$removedId = array();
	if($leadBeforeAdded){
		foreach($leadBeforeAdded as $cId => $cBefore){
			if(!in_array($cId, $idLeadAdded)){
				$removedId[] = $cId;
			}
		}
		if($removedId){
		  $strRemovedId = implode(", ", $removedId);
		  $query = "DELETE FROM {$this->CalendarLead->useTable} WHERE id IN ({$strRemovedId})";
		  $this->CalendarLead->query($query);
		}
	}
	//add leads	  
	foreach($addedLead as $leadId => $lead){
		if(!is_numeric($leadId)){
			$lead['lead_id'] = $lead["lead_id"];
			$lead['calendar_id'] = $calendarId;
			$this->CalendarLead->save($lead);
			$this->CalendarLead->clear();
		} 
	}
  }
  
  private function _saveCalendarVendor($calendarId, $addedVendor, $vendorBeforeAdded){
	//delete vendors
	$idVendorAdded = array_keys($addedVendor);
	$removedId = array();
	if($vendorBeforeAdded){
		foreach($vendorBeforeAdded as $cId => $cBefore){
			if(!in_array($cId, $idVendorAdded)){
				$removedId[] = $cId;
			}
		}
		if($removedId){
		  $strRemovedId = implode(", ", $removedId);
		  $query = "DELETE FROM {$this->CalendarVendor->useTable} WHERE id IN ({$strRemovedId})";
		  $this->CalendarVendor->query($query);
		}
	}
	//add vendors	  
	foreach($addedVendor as $vendorId => $vendor){
		if(!is_numeric($vendorId)){
			$vendor['vendor_id'] = $vendor["vendor_id"];
			$vendor['calendar_id'] = $calendarId;
			$this->CalendarVendor->save($vendor);
			$this->CalendarVendor->clear();
		} 
	}
  }
  
  private function _saveCalendarUser($calendarId, $addedUser, $userBeforeAdded){
	//delete users
	$idUserAdded = array_keys($addedUser);
	$removedId = array();
	if($userBeforeAdded){
		foreach($userBeforeAdded as $cId => $cBefore){
			if(!in_array($cId, $idUserAdded)){
				$removedId[] = $cId;
			}
		}
		if($removedId){
		  $strRemovedId = implode(", ", $removedId);
		  $query = "DELETE FROM {$this->CalendarUser->useTable} WHERE id IN ({$strRemovedId})";
		  $this->CalendarUser->query($query);
		}
	}
	//add users	  
	foreach($addedUser as $userId => $user){
		if(!is_numeric($userId)){
			$user['user_id'] = $user["user_id"];
			$user['calendar_id'] = $calendarId;
			$this->CalendarUser->save($user);
			$this->CalendarUser->clear();
		} 
	}
  }
}

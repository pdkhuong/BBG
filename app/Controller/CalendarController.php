<?php

class CalendarController extends AppController {
  var $uses = array(
    'Calendar',
    'Customer',
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
		$this->checkCanDo($calendarDb);
    $currentUserId = $this->loggedUser->User->id;;
    $isAdmin = $this->isAdmin();
		$listUser = array();
		$currentUserId = $this->loggedUser->User->id;
		if($isAdmin){
			$listUser = $this->UserModel->listUser();
		}

    if (empty($this->request->data)) {
      $this->request->data = $calendarDb;
    } else {//save
			if(!isset($this->request->data['Calendar']['user_id'])){
				$this->request->data['Calendar']['user_id'] = $currentUserId;
			}
      $this->Calendar->set($this->request->data);
      if ($this->Calendar->save()) {
				$calendarId = $this->Calendar->getId();
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
		$this->set("listUser", $listUser);
		$this->set("errorObj", $this->Calendar->validationErrors);
  }

  public function delete($id) {
		$calendar = $this->Calendar->findById($id);
		if($calendar) {
			$this->checkCanDo($calendar);
			$this->Calendar->deleteLogic($id);
		}
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
							'fields' => array('Calendar.*'),
							'group' => 'Calendar.id',
							);
		$dataList = $this->Calendar->find('all', $optionCalendar);
		$this->set('dataList', $dataList);
  }
  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }
}

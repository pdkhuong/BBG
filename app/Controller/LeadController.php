<?php

class LeadController extends AppController {

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
    if (empty($this->request->data)) {//show on edit
      $this->request->data = $this->Lead->findById($id);
    } else {//save
      $this->Lead->set($this->request->data);
      if ($this->Lead->save()) {
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
  }

  public function delete($id) {
    if ($this->Lead->isInUsed($id)) {
      $this->Session->setFlash(__('Unable to delete your data. It\'s in used'), 'flash/error');
      return $this->redirect($this->referer());
    }
    $this->Lead->deleteLogic($id);

    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
    $condition = array();
    $condition['Lead.deleted_time'] = null;

    $this->set('displayPaging', true);
    $this->Paginator->settings = array(
      'conditions' => $condition,
      'limit' => 10
    );
    $dataList = $this->Paginator->paginate('Lead');
    $this->set('dataList', $dataList);
  }

  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }

}

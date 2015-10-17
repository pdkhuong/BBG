<?php

class SettingsController extends AppController {

  var $uses = array(
    'Settings',
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Settings';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    if (empty($this->request->data)) {
      $this->request->data = $this->Settings->findById($id);
    } else {//save
      $this->Settings->set($this->request->data);
      if ($this->Settings->save()) {
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
  }

  public function delete($id) {
    $this->PurchaseOrderProduct->deleteByProductId($id);
    $this->Product->deleteLogic($id);
    $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = array();
    $dataList = $this->Settings->find("all", array('conditions' => $conditions));
    $this->set('dataList', $dataList);
  }


}

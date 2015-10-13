<?php

class ProductController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Product';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    $listUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit.name');
    $this->set('listUnit', $listUnit);
    if (empty($this->request->data)) {
      $this->request->data = $this->Product->findById($id);
    } else {//save
      $this->Product->set($this->request->data);
      if ($this->Product->save()) {
        //end save event shop
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        //print_r($this->Product->validationErrors);
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
  }

  public function delete($id) {
    $this->Product->deleteLogic($id);
    $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = array();
    $conditions['Product.deleted_time'] = null;
    $dataList = $this->Product->find('all', array('conditions' => $conditions));
    $this->set('dataList', $dataList);
  }


}

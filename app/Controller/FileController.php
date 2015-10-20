<?php

class FileController extends AppController {

  var $uses = array(
    'file',
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'File';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    if (empty($this->request->data)) {
      $this->request->data = $this->File->findById($id);
    } else {//save
      $uploadedData = $this->File->uploadFile($_FILES['file_upload']);
      if($uploadedData && $uploadedData['error']>0){
        $this->Session->setFlash($uploadedData['message'], 'flash/error');
      }else{
        $insertData = $uploadedData;
        $insertData['id'] = $id;
        $postData = $this->request->data['File'];
        if($postData['name']){
          $insertData['name'] = $postData['name'];
        }
        if($postData['description']){
          $insertData['description'] = $postData['description'];
        }
        $this->File->set($insertData);
        if ($this->File->save()) {
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        } else {
          $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
        }
      }

    }
  }

  public function delete($id) {
    $this->File->deleteLogic($id);
    $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = array();
    $conditions['File.deleted_time'] = null;
    $this->set('displayPaging', true);

    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
    );
    try{
      $dataList = $this->Paginator->paginate('File');
    }catch(Exception $e){
      $dataList = array();
    }
    $this->set('dataList', $dataList);
  }


}

<?php

class FileController extends AppController {

  var $uses = array(
    'File',
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
    $fileDataDb = $this->File->findById($id);
    $this->checkCanDo($fileDataDb);
    if (empty($this->request->data)) {
      $this->request->data = $fileDataDb;
    } else {//save
      $isRequireUpload = $fileDataDb ? false : true;
      $fileData = $this->File->uploadFile($_FILES['file_upload'], UPLOAD_BASE_DIR, $isRequireUpload);
      if($fileData && $fileData['error']>0){
        $this->Session->setFlash($fileData['message'], 'flash/error');
      }else{
        if($fileData){
          $this->File->deletePhysicalFile($id);
        }
        $fileData['id'] = $id;
        $fileData['model'] = 'File';
        $fileData['user_id'] = $this->loggedUser->User->id;
        $postData = $this->request->data['File'];
        if($postData['name']){
          $fileData['name'] = $postData['name'];
        }
        if($postData['description']){
          $fileData['description'] = $postData['description'];
        }
        $this->File->set($fileData);
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
    $fileDataDb = $this->File->findById($id);
    if($fileDataDb){
      $this->checkCanDo($fileDataDb);
      $this->File->deletePhysicalFile($id);
      $this->File->delete($id, true, false);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = array();
    $conditions['File.deleted_time'] = null;
    $conditions['File.model'] = 'File';
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

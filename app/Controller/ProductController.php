<?php

class ProductController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit',
    'PurchaseRequestProduct',
    'PurchaseOrderProduct',
    'File',
    'Customer',
    'User.UserModel'
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
  public function view($id=0){
    $data = $this->Product->findById($id);
    $this->checkCanDo($data);
    $paperName = Configure::read("PAPER_NAME");
    $this->set('paperName', $paperName);
    $this->set('data', $data);
  }
  public function edit($id = 0) {
    $productDb = $this->Product->findById($id);
    $this->checkCanDo($productDb);
    $isAdmin = $this->isAdmin();
    $listCustomer = $this->listCustomer();
    $listUser = array();
    $currentUserId = $this->loggedUser->User->id;
    if($isAdmin){
      $listUser = $this->UserModel->listUser();
    }
    $listUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit.name');
    $this->set('listUnit', $listUnit);
    $paperName = Configure::read("PAPER_NAME");
    $this->set('paperName', $paperName);
    if (empty($this->request->data)) {
      $this->request->data = $productDb;
    } else {//save
      $fileData = $this->File->uploadFile($_FILES['file_upload'], UPLOAD_BASE_DIR, false);
      if($fileData && $fileData['error']>0){
        $this->Session->setFlash($fileData['message'], 'flash/error');
      }else{
        if(!isset($this->request->data['Product']['user_id'])){
          $this->request->data['Product']['user_id'] = $currentUserId;
        }
        if($fileData){
          if($productDb){
            $fileData['id'] = $productDb['Product']['file_id'];
            $this->File->deletePhysicalFile($fileData['id']);
          }
          $fileData['model'] = 'Product';
          $fileData['user_id'] = $currentUserId;
          $this->File->save($fileData);
          $fileId = $this->File->getId();
          $this->request->data['Product']['file_id'] = $fileId;
        }

        $this->Product->set($this->request->data);
        if ($this->Product->save()) {
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        } else {
          $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
        }
      }
    }
    $this->set("listCustomer", $listCustomer);
    $this->set('listUser', $listUser);
  }

  public function delete($id) {
    $product = $this->Product->findById($id);
    if($product){
      $this->checkCanDo($product);
      $this->PurchaseOrderProduct->deleteByProductId($id);
      $this->PurchaseRequestProduct->deleteByProductId($id);
      $this->Product->deleteLogic($id);
      $this->File->deletePhysicalFile($product['Product']['file_id']);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = $this->getInitCondition();
    $this->set('displayPaging', true);
    $page = isset($this->request->params['paging']['Product']['page']) ? intval($this->request->params['paging']['Product']['page']) : 1;

    $offset = ($page - 1) * ITEM_PER_PAGE;
    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
      'offset' => $offset,
    );
    try{
      $dataList = $this->Paginator->paginate('Product');
    }catch(Exception $e){
      $dataList = array();
      //$this->redirect(Router::url(array('action' => 'index')));
    }
    $this->set('dataList', $dataList);
  }


}

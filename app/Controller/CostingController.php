<?php

class CostingController extends AppController {

  var $uses = array(
    'Costing',
    'Product',
    'Customer',
    'Settings',
    'User.UserModel'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Costing';
  }
  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  public function edit($id = 0) {
    $costingDb = $this->Costing->findById($id);
    $this->checkCanDo($costingDb);

    $settings = Hash::combine($this->Settings->find("all"), '{n}.Settings.key', '{n}.Settings.val');
    $this->set('settings', $settings);
    $listCustomer = $this->listCustomer();
    $listUser = array();
    $listProduct = $this->listProduct();
    $currentUserId = $this->loggedUser->User->id;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser =  $this->UserModel->listUser();
    }

    $errorObj = array();
    if (empty($this->request->data)) {
      $this->request->data = $costingDb;
    } else {//save
      $customerId = $this->request->data['Costing']['customer_id'];
      $productId = $this->request->data['Costing']['product_id'];
      $customerProduct = $this->Product->find("first", array(
        'conditions' => array(
          'Product.customer_id' => $customerId,
          'Product.id' => $productId
        )
      ));
      $costingByCustomerAndProduct = $this->Costing->find("first", array(
        'conditions' => array(
          'Costing.customer_id' => $customerId,
          'Costing.product_id' => $productId,
          'Costing.id !=' => $id
        )
      ));
      if(empty($customerProduct)){
        $this->Session->setFlash(__('Please add product of this customer'), 'flash/error');
      }elseif($costingByCustomerAndProduct){
        $this->Session->setFlash(__('Customer and Product already exist in costing.'), 'flash/error');
      }else{
        if(!isset($this->request->data['Costing']['user_id'])){
          $this->request->data['Costing']['user_id'] = $currentUserId;
        }
        $this->Costing->set($this->request->data);
        if($this->Costing->validates()){
          $costingRecord = $this->Costing->getCostingRecord($this->request->data);
          $sellingPrice = $costingRecord['sellingPrice'];
          $this->request->data['Costing']['selling_price'] = $sellingPrice;
          $this->Costing->set($this->request->data);
          if ($this->Costing->save()) {
            $productData = array();
            $productData['id'] = $productId;
            $productData['quantity'] = $this->request->data['Costing']['quantity'];
            $productData['price'] = $sellingPrice;
            $this->Product->save($productData, false);
            $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
            return $this->redirect(Router::url(array('action' => 'index')));
          } else {
            $errorObj = $this->Costing->validationErrors;
            $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
          }
        }
      }
    }
    $this->set('errorObj', $errorObj);
    $this->set("listCustomer", $listCustomer);
    $this->set('listUser', $listUser);
    $this->set("listProduct", $listProduct);
  }

  public function delete($id) {
    $costingDb = $this->Costing->findById($id);
    if($costingDb){
      $this->checkCanDo($costingDb);
      $this->Costing->deleteLogic($id);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $listCustomer = $this->listCustomer();
    $customerId = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;
    $keyword = isset($_GET['keyword']) ? strval($_GET['keyword']) : '';
    $conditions = $this->getInitCondition();
    if($customerId){
      $conditions['Costing.customer_id'] = $customerId;
    }
    if($keyword){
      $conditions['OR'] = array(
          array('Product.name LIKE' => '%'.$keyword.'%'),
          array('Product.item_no LIKE' => '%'.$keyword.'%')
      );
    }
    $this->set('displayPaging', true);

    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
    );
    try{
      $dataList = $this->Paginator->paginate('Costing');
    }catch(Exception $e){
      $dataList = array();
    }
    $this->set('dataList', $dataList);
    $this->set('customerId', $customerId);
    $this->set('keyword', $keyword);
    $this->set("listCustomer", $listCustomer);
  }
  function export($id=0){
    $costingDb = $this->Costing->findById($id);
    $this->checkCanDo($costingDb);
    App::uses('ExcelLib', 'Lib');
    $costingRecord = $this->Costing->getCostingRecord($costingDb);
    $data = $costingRecord['excelData'];

    $excel = new ExcelLib();
    $excel->init();
    $excel->writeFromArray($data);
    $excel->PHPExcel->getActiveSheet()->setTitle('Costing');
    $excel->PHPExcel->setActiveSheetIndex(0);
    $excel->send2Browser();

    die();
  }
  function view($id=0){
    $costingDb = $this->Costing->findById($id);
    $this->checkCanDo($costingDb);
    $costingRecord = $this->Costing->getCostingRecord($costingDb);
    $data = $costingRecord['excelData'];
    if($data){
      unset($data[2]);
      unset($data[4]);
      unset($data[6]);
      unset($data[8]);
      unset($data[10]);
      unset($data[55]);
      unset($data[57]);
      unset($data[59]);
      unset($data[60]);
      foreach($data as $iRow => $row){
        foreach($row as $iCol => $col){
          if(is_numeric($col)){
            $col = vnNumberFormat($col,0);
            $data[$iRow][$iCol] = $col;
          }
        }
      }
    }
    $this->set('data', $data);
    //echo "<pre>"; print_r($data); die();
  }



}

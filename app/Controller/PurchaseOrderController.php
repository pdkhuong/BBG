<?php

class PurchaseOrderController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit',
    'PurchaseOrder',
    'PurchaseOrderProduct',
    'Customer',
    'User.UserModel',
    'Costing'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'PurchaseOrder';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  public function view($id=0){
    $data = $this->PurchaseOrder->findById($id);
    $addedProducts = array();
    $this->checkCanDo($data);
    $this->set('data', $data);
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
    $currentPurchaseOrderProducts = $this->PurchaseOrderProduct->findAllByPurchaseOrderId($id);
    if($currentPurchaseOrderProducts){
      $listProductUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
      foreach($currentPurchaseOrderProducts as $currentPO){
        $tmpPO = array();
        $tmpPO['Product'] = $currentPO['Product'];
        $tmpPO['ProductUnit'] = $listProductUnit[$currentPO['Product']['product_unit_id']];
        $tmpPO['numOfProduct'] = $currentPO['PurchaseOrderProduct']['num_item'];

        $costingByCustomerAndProduct = $this->Costing->find("first", array(
          'conditions' => array(
            'Costing.product_id' => $tmpPO['Product']['id'],
          )
        ));
        $price = 0;
        if($costingByCustomerAndProduct){
          $costingRecord = $this->Costing->getCostingRecord($costingByCustomerAndProduct, $tmpPO['numOfProduct']);
          $price = round($costingRecord['sellingPrice']);
        }
        $tmpPO['price'] = $price;
        $addedProducts[$tmpPO['Product']['id']] = $tmpPO;
      }
    }
    $this->set('addedProducts', $addedProducts);
  }
  public function edit($id=0){
    $purchaseOrderDb = $this->PurchaseOrder->findById($id);
    $selectedCustomerId = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;
    $this->checkCanDo($purchaseOrderDb);
    $listUser = array();
    $currentUserId = $this->loggedUser->User->id;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser =  $this->UserModel->listUser();
    }
    $this->set('listUser', $listUser);
    $listCustomer = $this->listCustomer();
    $addedProducts = array();
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
    $errorObj = array();
    $orderNo1 = '';
    $orderNo2 = '';
    $orderNo3 = '';
    if($purchaseOrderDb){//edit load len ban dau
      $currentOrderNo = $purchaseOrderDb['PurchaseOrder']['order_no'];
      $orderNoArr = explode('-', $currentOrderNo);
      $orderNo1 = @$orderNoArr[0];
      $orderNo2 = @$orderNoArr[1];
      $orderNo3 = @$orderNoArr[2];
    }else{//add
      $orderNo3 = $this->PurchaseOrder->getUniqCodeByMonth();
    }
    if($selectedCustomerId){
      $customer = $this->Customer->findById($selectedCustomerId);
      $orderNo1 = substr( $customer['Customer']['code'], 0, 3);
    }
    $listProduct = Hash::combine($this->listProduct(true, $selectedCustomerId), '{n}.Product.id', '{n}');

    if (empty($this->request->data)) {
      $this->request->data = $purchaseOrderDb;
      if($selectedCustomerId){
        $this->request->data['PurchaseOrder']['customer_id'] = $selectedCustomerId;
      }
      $this->request->data['PurchaseOrder']['order_no'] = $orderNo2;
      $currentPurchaseOrderProducts = $this->PurchaseOrderProduct->findAllByPurchaseOrderId($id);
      if($currentPurchaseOrderProducts){
        $listProductUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
        foreach($currentPurchaseOrderProducts as $currentPO){
          $tmpPO = array();
          $tmpPO['Product'] = $currentPO['Product'];
          $tmpPO['ProductUnit'] = $listProductUnit[$currentPO['Product']['product_unit_id']];
          $tmpPO['numOfProduct'] = $currentPO['PurchaseOrderProduct']['num_item'];
          $addedProducts[$tmpPO['Product']['id']] = $tmpPO;
          unset($listProduct[$tmpPO['Product']['id']]);
        }
      }
    } else {
      $errorMsg = '';
      if(isset($this->request->data['Product']['num_item'])){
        $addedProductItemArr  = $this->request->data['Product']['num_item'];
        foreach($addedProductItemArr as $productId => $numOfProduct){
          //luu lai nhung product duoc add
          $addedProducts[$productId] = $listProduct[$productId];
          $addedProducts[$productId]['numOfProduct'] = $numOfProduct;
          //xoa nhung product da duoc add ra khoi listProduct
          unset($listProduct[$productId]);
          if(empty($numOfProduct) || ! is_numeric($numOfProduct)){
            $errorMsg = __('Please input valid number of product');
          }
        }
      }else{
        $errorMsg = __('Please add product');
      }
      if(!isset($this->request->data['PurchaseOrder']['user_id'])){
        $this->request->data['PurchaseOrder']['user_id'] = $currentUserId;
      }
      $orderNo2 = $this->request->data['PurchaseOrder']['order_no'];
      $this->PurchaseOrder->set($this->request->data);
      if(!$errorMsg){
        if ($this->PurchaseOrder->validates()) {
          $this->request->data['PurchaseOrder']['order_no'] = $orderNo1.'-'.$orderNo2.'-'.$orderNo3;
          $this->PurchaseOrder->set($this->request->data);
          $this->PurchaseOrder->save(false);
          $purchaseOrderId = $this->PurchaseOrder->getId();
          $this->_savePurchaseOrderProduct($purchaseOrderId, $addedProducts);
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        } else {
          $errorObj = $this->PurchaseOrder->validationErrors;
          $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
        }
      }else{
        $this->Session->setFlash($errorMsg, 'flash/error');
      }

    }
    $this->set('orderNo1', $orderNo1);
    $this->set('orderNo2', $orderNo2);
    $this->set('orderNo3', $orderNo3);
    $this->set('errorObj', $errorObj);
    $this->set('addedProducts', $addedProducts);
    $this->set('listProduct', $listProduct);
    $this->set("listCustomer", $listCustomer);
  }

  private function _savePurchaseOrderProduct($purchaseOrderId, $addedProducts){
    if($addedProducts){
      $this->PurchaseOrderProduct->deleteByPurchaseOrderId($purchaseOrderId);
      foreach($addedProducts as $productId => $data){
        $insertData = array();
        $insertData['purchase_order_id'] = $purchaseOrderId;
        $insertData['product_id'] = $productId;
        $insertData['num_item'] = $data['numOfProduct'];
        $this->PurchaseOrderProduct->save($insertData);
        $this->PurchaseOrderProduct->clear();
      }
    }
  }


  public function delete($id) {
    $purchaseOrderDb = $this->PurchaseOrder->findById($id);
    if($purchaseOrderDb){
      $this->checkCanDo($purchaseOrderDb);
      $this->PurchaseOrderProduct->deleteByPurchaseOrderId($id);
      $this->PurchaseOrder->deleteLogic($id);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }
  public function index() {
    $listCustomer = $this->listCustomer();
    $customerId = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;
    $orderNo = isset($_GET['order_no']) ? strval($_GET['order_no']) : '';
    $orderDateFrom = isset($_GET['order_date_from']) ? strval($_GET['order_date_from']) : '';
    $orderDateTo = isset($_GET['order_date_to']) ? strval($_GET['order_date_to']) : '';

    $this->set('customerId', $customerId);
    $this->set('orderNo', $orderNo);
    $this->set('orderDateFrom', $orderDateFrom);
    $this->set('orderDateTo', $orderDateTo);

    $conditions = $this->getInitCondition();
    if($customerId){
      $conditions['PurchaseOrder.customer_id'] = $customerId;
    }
    if($orderNo){
      $conditions[] = "PurchaseOrder.order_no LIKE  '%{$orderNo}%'";
    }
    if($orderDateFrom){
      $conditions[] = "PurchaseOrder.order_date >= date('{$orderDateFrom}')";
    }
    if($orderDateTo){
      $conditions[] = "PurchaseOrder.order_date <= date('{$orderDateTo}')";
    }
    $this->set('displayPaging', true);
    $page = isset($this->request->params['paging']['PurchaseOrder']['page']) ? intval($this->request->params['paging']['PurchaseOrder']['page']) : 1;

    $offset = ($page - 1) * ITEM_PER_PAGE;
    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
      'offset' => $offset,
    );
    try{
      $dataList = $this->Paginator->paginate('PurchaseOrder');
    }catch(Exception $e){
      $dataList = array();
      $this->redirect(Router::url(array('action' => 'index')) . '?customer_id='.$customerId.'&order_no='.$orderNo.'&order_date_from='.$orderDateFrom.'&order_date_to='.$orderDateTo);
    }
    $this->set('dataList', $dataList);
    $this->set("listCustomer", $listCustomer);
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
  }

}

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
            'Costing.customer_id' => $data['Customer']['id'],
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
    $this->checkCanDo($purchaseOrderDb);
    $listUser = array();
    $currentUserId = $this->loggedUser->User->id;
    $isAdmin = $this->isAdmin();
    $listProduct = $this->listProduct(false);
    if($isAdmin){
      $listUser =  $this->UserModel->listUser();
    }
    $this->set('listUser', $listUser);
    $listCustomer = $this->listCustomer();
    $addedProducts = array();
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
    $errorObj = array();
    if (empty($this->request->data)) {
      $this->request->data = $purchaseOrderDb;
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
      $this->PurchaseOrder->set($this->request->data);
      if(!$errorMsg){
        if ($this->PurchaseOrder->save()) {
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

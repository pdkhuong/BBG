<?php

class PurchaseRequestController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit',
    'PurchaseRequest',
    'PurchaseRequestProduct',
    'Vendor',
    'User.UserModel'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'PurchaseRequest';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  public function view($id=0){
    $data = $this->PurchaseRequest->findById($id);
    $addedProducts = array();
    $this->checkCanDo($data);
    $this->set('data', $data);
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
    $currentPurchaseOrderProducts = $this->PurchaseRequestProduct->findAllByPurchaseOrderVendorId($id);
    if($currentPurchaseOrderProducts){
      $listProductUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
      foreach($currentPurchaseOrderProducts as $currentPO){
        $tmpPO = array();
        $tmpPO['Product'] = $currentPO['Product'];
        $tmpPO['ProductUnit'] = $listProductUnit[$currentPO['Product']['product_unit_id']];
        $tmpPO['numOfProduct'] = $currentPO['PurchaseRequestProduct']['num_item'];
        $addedProducts[$tmpPO['Product']['id']] = $tmpPO;
      }
    }
    $this->set('addedProducts', $addedProducts);
  }
  public function edit($id=0){
    $PurchaseRequestDb = $this->PurchaseRequest->findById($id);
    $this->checkCanDo($PurchaseRequestDb);
    $listUser = array();
    $currentUserId = $this->loggedUser->User->id;
    $isAdmin = $this->isAdmin();
    $listVendor = array();
    $listProduct = Hash::combine($this->listProduct(), '{n}.Product.id', '{n}');
    if($isAdmin){
      $listUser = $this->UserModel->listUser();
      $listVendor = $this->Vendor->find("list");
    }else{
      $listVendor = $this->Vendor->find("list", array('conditions'=> array(
        'Vendor.user_id' =>$currentUserId
      )));
    }
    $this->set('listUser', $listUser);
    $addedProducts = array();
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
    $errorObj = array();
    if (empty($this->request->data)) {
      $this->request->data = $PurchaseRequestDb;
      $currentPurchaseRequestProducts = $this->PurchaseRequestProduct->findAllByPurchaseOrderVendorId($id);
      if($currentPurchaseRequestProducts){
        $listProductUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
        foreach($currentPurchaseRequestProducts as $currentPO){
          $tmpPO = array();
          $tmpPO['Product'] = $currentPO['Product'];
          $tmpPO['ProductUnit'] = $listProductUnit[$currentPO['Product']['product_unit_id']];
          $tmpPO['numOfProduct'] = $currentPO['PurchaseRequestProduct']['num_item'];
          $addedProducts[$tmpPO['Product']['id']] = $tmpPO;
          unset($listProduct[$tmpPO['Product']['id']]);
        }
      }
    } else {
      $errorMsg = '';
      if(!isset($this->request->data['PurchaseRequest']['user_id'])){
        $this->request->data['PurchaseRequest']['user_id'] = $currentUserId;
      }
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
      $this->PurchaseRequest->set($this->request->data);
      if(!$errorMsg){
        if ($this->PurchaseRequest->save()) {
          $purchaseOrderId = $this->PurchaseRequest->getId();
          $this->_savePurchaseRequestProduct($purchaseOrderId, $addedProducts);
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        } else {
          $errorObj = $this->PurchaseRequest->validationErrors;
          $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
        }
      }else{
        $this->Session->setFlash($errorMsg, 'flash/error');
      }

    }
    $this->set('errorObj', $errorObj);
    $this->set('addedProducts', $addedProducts);
    $this->set('listProduct', $listProduct);
    $this->set("listVendor", $listVendor);
  }

  private function _savePurchaseRequestProduct($purchaseOrderId, $addedProducts){
    if($addedProducts){
      $this->PurchaseRequestProduct->deleteByPurchaseRequestId($purchaseOrderId);
      foreach($addedProducts as $productId => $data){
        $insertData = array();
        $insertData['purchase_order_vendor_id'] = $purchaseOrderId;
        $insertData['product_id'] = $productId;
        $insertData['num_item'] = $data['numOfProduct'];
        $this->PurchaseRequestProduct->save($insertData);
        $this->PurchaseRequestProduct->clear();
      }
    }
  }
  public function delete($id) {
    $purchaseRequestDb = $this->PurchaseRequest->findById($id);
    if($purchaseRequestDb){
      $this->checkCanDo($purchaseRequestDb);
      $this->PurchaseRequestProduct->deleteByPurchaseRequestId($id);
      $this->PurchaseRequest->deleteLogic($id);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }
  public function index() {
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listVendor = $this->Vendor->find("list");
    }else{
      $currentUserId = $this->loggedUser->User->id;
      $listVendor = $this->Vendor->find("list", array('conditions'=> array(
        'Vendor.user_id' =>$currentUserId
      )));
    }

    $vendorId = isset($_GET['vendor_id']) ? intval($_GET['vendor_id']) : 0;
    $orderNo = isset($_GET['order_no']) ? strval($_GET['order_no']) : '';
    $orderDateFrom = isset($_GET['order_date_from']) ? strval($_GET['order_date_from']) : '';
    $orderDateTo = isset($_GET['order_date_to']) ? strval($_GET['order_date_to']) : '';

    $this->set('vendorId', $vendorId);
    $this->set('orderNo', $orderNo);
    $this->set('orderDateFrom', $orderDateFrom);
    $this->set('orderDateTo', $orderDateTo);

    $conditions = $this->getInitCondition();
    if($vendorId){
      $conditions['PurchaseRequest.vendor_id'] = $vendorId;
    }
    if($orderNo){
      $conditions[] = "PurchaseRequest.order_no LIKE  '%{$orderNo}%'";
    }
    if($orderDateFrom){
      $conditions[] = "PurchaseRequest.order_date >= date('{$orderDateFrom}')";
    }
    if($orderDateTo){
      $conditions[] = "PurchaseRequest.order_date <= date('{$orderDateTo}')";
    }
    $this->set('displayPaging', true);
    $page = isset($this->request->params['paging']['PurchaseRequest']['page']) ? intval($this->request->params['paging']['PurchaseRequest']['page']) : 1;

    $offset = ($page - 1) * ITEM_PER_PAGE;
    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
      'offset' => $offset,
    );
    try{
      $dataList = $this->Paginator->paginate('PurchaseRequest');
    }catch(Exception $e){
      $dataList = array();
      //$this->redirect(Router::url(array('action' => 'index')) . '?customer_id='.$customerId.'&order_no='.$orderNo.'&order_date_from='.$orderDateFrom.'&order_date_to='.$orderDateTo);
    }
    $this->set('dataList', $dataList);
    $this->set("listVendor", $listVendor);
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
  }

}

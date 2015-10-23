<?php

class PurchaseOrderVendorController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit',
    'PurchaseOrderVendor',
    'PurchaseOrderVendorProduct',
    'Vendor',
    'User.UserModel'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'PurchaseOrderVendor';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id=0){
    $purchaseOrderVendorDb = $this->PurchaseOrderVendor->findById($id);
    $listUser = array();
    $currentUserId = 0;
    $isAdmin = $this->isAdmin();
    if($isAdmin){
      $listUser = Hash::combine($this->UserModel->find("all"), '{n}.UserModel.id', '{n}.UserModel.display_name');
    }else{
      $currentUserId = $this->loggedUser->User->id;
      if($purchaseOrderVendorDb && $purchaseOrderVendorDb['PurchaseOrderVendor']['user_id'] != $currentUserId){
        die("Cannot not access this page");
      }
    }
    $this->set('listUser', $listUser);
    $listVendor = $this->Vendor->find("list");
    $listProduct = Hash::combine($this->Product->find("all"), '{n}.Product.id', '{n}');
    $addedProducts = array();
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
    $errorObj = array();
    if (empty($this->request->data)) {
      $this->request->data = $purchaseOrderVendorDb;
      $currentPurchaseOrderVendorProducts = $this->PurchaseOrderVendorProduct->findAllByPurchaseOrderVendorId($id);
      if($currentPurchaseOrderVendorProducts){
        $listProductUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
        foreach($currentPurchaseOrderVendorProducts as $currentPO){
          $tmpPO = array();
          $tmpPO['Product'] = $currentPO['Product'];
          $tmpPO['ProductUnit'] = $listProductUnit[$currentPO['Product']['product_unit_id']];
          $tmpPO['numOfProduct'] = $currentPO['PurchaseOrderVendorProduct']['num_item'];
          $addedProducts[$tmpPO['Product']['id']] = $tmpPO;
          unset($listProduct[$tmpPO['Product']['id']]);
        }
      }
    } else {
      $errorMsg = '';
      if(!isset($this->request->data['PurchaseOrderVendor']['user_id'])){
        $this->request->data['PurchaseOrderVendor']['user_id'] = $currentUserId;
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
      $this->PurchaseOrderVendor->set($this->request->data);
      if(!$errorMsg){
        if ($this->PurchaseOrderVendor->save()) {
          $purchaseOrderId = $this->PurchaseOrderVendor->getId();
          $this->_savePurchaseOrderVendorProduct($purchaseOrderId, $addedProducts);
          //end save event shop
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        } else {
          $errorObj = $this->PurchaseOrderVendor->validationErrors;
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
    //echo "<pre>"; print_r($addedProducts);die();
    //echo "<pre>"; print_r($listProduct);die();
  }

  private function _savePurchaseOrderVendorProduct($purchaseOrderId, $addedProducts){
    if($addedProducts){
      $this->PurchaseOrderVendorProduct->deleteByPurchaseOrderVendorId($purchaseOrderId);
      foreach($addedProducts as $productId => $data){
        $insertData = array();
        $insertData['purchase_order_vendor_id'] = $purchaseOrderId;
        $insertData['product_id'] = $productId;
        $insertData['num_item'] = $data['numOfProduct'];
        $this->PurchaseOrderVendorProduct->save($insertData);
        $this->PurchaseOrderVendorProduct->clear();
      }
    }
  }


  public function delete($id) {
    $purchaseOrderVendorDb = $this->PurchaseOrderVendor->findById($id);
    $isAdmin = $this->isAdmin();
    if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      if($purchaseOrderVendorDb && $purchaseOrderVendorDb['PurchaseOrderVendor']['user_id'] != $currentUserId){
        die("Cannot not access this page");
      }
    }
    $this->PurchaseOrderVendorProduct->deleteByPurchaseOrderVendorId($id);
    $this->PurchaseOrderVendor->deleteLogic($id);
    $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }
  public function index() {
    $listVendor = $this->Vendor->find("list");
    $vendorId = isset($_GET['vendor_id']) ? intval($_GET['vendor_id']) : 0;
    $orderNo = isset($_GET['order_no']) ? strval($_GET['order_no']) : '';
    $orderDateFrom = isset($_GET['order_date_from']) ? strval($_GET['order_date_from']) : '';
    $orderDateTo = isset($_GET['order_date_to']) ? strval($_GET['order_date_to']) : '';
    //$receivedDateFrom = isset($_GET['received_date_from']) ? strval($_GET['received_date_from']) : '';
    //$receivedDateTo = isset($_GET['received_date_to']) ? strval($_GET['received_date_to']) : '';

    $this->set('vendorId', $vendorId);
    $this->set('orderNo', $orderNo);
    $this->set('orderDateFrom', $orderDateFrom);
    $this->set('orderDateTo', $orderDateTo);
    //$this->set('receivedDateFrom', $receivedDateFrom);
    //$this->set('receivedDateTo', $receivedDateTo);

    $conditions = array();
    $isAdmin = $this->isAdmin();
    if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      $conditions['PurchaseOrderVendor.user_id'] = $currentUserId;
    }
    $conditions['PurchaseOrderVendor.deleted_time'] = null;
    if($vendorId){
      $conditions['PurchaseOrderVendor.vendor_id'] = $vendorId;
    }
    if($orderNo){
      $conditions[] = "PurchaseOrderVendor.order_no LIKE  '%{$orderNo}%'";
    }
    if($orderDateFrom){
      $conditions[] = "PurchaseOrderVendor.order_date >= date('{$orderDateFrom}')";
    }
    if($orderDateTo){
      $conditions[] = "PurchaseOrderVendor.order_date <= date('{$orderDateTo}')";
    }
    $this->set('displayPaging', true);
    $page = isset($this->request->params['paging']['PurchaseOrderVendor']['page']) ? intval($this->request->params['paging']['PurchaseOrderVendor']['page']) : 1;

    $offset = ($page - 1) * ITEM_PER_PAGE;
    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
      'offset' => $offset,
    );
    try{
      $dataList = $this->Paginator->paginate('PurchaseOrderVendor');
    }catch(Exception $e){
      $dataList = array();
      //$this->redirect(Router::url(array('action' => 'index')) . '?customer_id='.$customerId.'&order_no='.$orderNo.'&order_date_from='.$orderDateFrom.'&order_date_to='.$orderDateTo);
    }
    //echo "<pre>"; print_r($dataList); die();
    $this->set('dataList', $dataList);
    $this->set("listVendor", $listVendor);
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
  }

}

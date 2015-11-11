<?php

class FacsimileMassageController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit',
    'FacsimileMassage',
    'FacsimileMassageProduct',
    'Customer',
    'User.UserModel',
    'Costing'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'FacsimileMassage';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }
  public function edit($id=0){
    $FacsimileMassageDb = $this->FacsimileMassage->findById($id);
    $this->checkCanDo($FacsimileMassageDb);
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
      $this->request->data = $FacsimileMassageDb;
      $currentFacsimileMassageProducts = $this->FacsimileMassageProduct->findAllByFacsimileMassageId($id);
      if($currentFacsimileMassageProducts){
        $listProductUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
        foreach($currentFacsimileMassageProducts as $currentPO){
          $tmpPO = array();
          $tmpPO['Product'] = $currentPO['Product'];
          $tmpPO['ProductUnit'] = $listProductUnit[$currentPO['Product']['product_unit_id']];
          $tmpPO['numOfProduct'] = $currentPO['FacsimileMassageProduct']['num_item'];
          $addedProducts[$tmpPO['Product']['id']] = $tmpPO;
          //unset($listProduct[$tmpPO['Product']['id']]);
        }
      }
    } else {
      echo "<pre>"; print_r($this->request->data); die();
      $errorMsg = '';
      if(isset($this->request->data['Product']['num_item'])){
        $addedProductItemArr  = $this->request->data['Product']['num_item'];
        foreach($addedProductItemArr as $productId => $numOfProduct){
          //luu lai nhung product duoc add
          $addedProducts[$productId] = $listProduct[$productId];
          $addedProducts[$productId]['numOfProduct'] = $numOfProduct;
          //xoa nhung product da duoc add ra khoi listProduct
          //unset($listProduct[$productId]);
          if(empty($numOfProduct) || ! is_numeric($numOfProduct)){
            $errorMsg = __('Please input valid number of product');
          }
        }
      }else{
        $errorMsg = __('Please add product');
      }
      if(!isset($this->request->data['FacsimileMassage']['user_id'])){
        $this->request->data['FacsimileMassage']['user_id'] = $currentUserId;
      }
      $this->FacsimileMassage->set($this->request->data);
      if(!$errorMsg){
        if ($this->FacsimileMassage->save()) {
          $FacsimileMassageId = $this->FacsimileMassage->getId();
          $customerId = $this->request->data['FacsimileMassage']['customer_id'];
          $this->_saveFacsimileMassageProduct($FacsimileMassageId, $addedProducts, $customerId);
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        } else {
          $errorObj = $this->FacsimileMassage->validationErrors;
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

  private function _saveFacsimileMassageProduct($FacsimileMassageId, $addedProducts, $customerId){
    if($addedProducts){
      $this->FacsimileMassageProduct->deleteByFacsimileMassageId($FacsimileMassageId);
      foreach($addedProducts as $productId => $data){
        $costingByCustomerAndProduct = $this->Costing->find("first", array(
          'conditions' => array(
            'Costing.customer_id' => $customerId,
            'Costing.product_id' => $productId,
          )
        ));
        $price = 0;
        if($costingByCustomerAndProduct){
          $costingRecord = $this->Costing->getCostingRecord($costingByCustomerAndProduct, $data['numOfProduct']);
          $price = $costingRecord['sellingPrice'];
        }
        $insertData = array();
        $insertData['facsimile_massage_id'] = $FacsimileMassageId;
        $insertData['product_id'] = $productId;
        $insertData['num_item'] = $data['numOfProduct'];
        $insertData['price'] = $price;
        $this->FacsimileMassageProduct->save($insertData);
        $this->FacsimileMassageProduct->clear();
      }
    }
  }


  public function delete($id) {
    $FacsimileMassageDb = $this->FacsimileMassage->findById($id);
    if($FacsimileMassageDb){
      $this->checkCanDo($FacsimileMassageDb);
      $this->FacsimileMassageProduct->deleteByFacsimileMassageId($id);
      $this->FacsimileMassage->deleteLogic($id);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }
  public function index() {
    $listCustomer = $this->listCustomer();
    $customerId = isset($_GET['customer_id']) ? intval($_GET['customer_id']) : 0;

    $this->set('customerId', $customerId);

    $conditions = $this->getInitCondition();
    if($customerId){
      $conditions['FacsimileMassage.customer_id'] = $customerId;
    }
    $this->set('displayPaging', true);
    $page = isset($this->request->params['paging']['FacsimileMassage']['page']) ? intval($this->request->params['paging']['FacsimileMassage']['page']) : 1;

    $offset = ($page - 1) * ITEM_PER_PAGE;
    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
      'offset' => $offset,
    );
    try{
      $dataList = $this->Paginator->paginate('FacsimileMassage');
    }catch(Exception $e){
      $dataList = array();
      $this->redirect(Router::url(array('action' => 'index')) . '?customer_id='.$customerId.'&order_no='.$orderNo.'&order_date_from='.$orderDateFrom.'&order_date_to='.$orderDateTo);
    }
    $this->set('dataList', $dataList);
    $this->set("listCustomer", $listCustomer);
    $shipType = Configure::read("SHIP_TYPE");
    $this->set('shipType', $shipType);
  }
  public function report($id){
    $dataObj = $this->FacsimileMassage->findById($id);
    if($dataObj){
      $this->checkCanDo($dataObj);
      $this->layout = 'blank';
      App::uses('PdfLib', 'Lib');
      $marginWidth = 50;
      $pdf = new PdfLib(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
      $pdf->SetMargins(0, 0, 0, true);
      $pdf->SetFont('freeserif', '', 10, '', false);
      $logoHeaderPath = WWW_ROOT . 'img/document_header_logo.png';
      $headerHtml = '<label style="text-align:center"><img src="' . $logoHeaderPath . '" /></label><br>';
      $pdf->SetHeaderData($logoHeaderPath, 200, 'custom', $headerHtml);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->setFooterMargin($marginWidth);
      $pdf->Cell(0,1, '', 0,1,'C');
      $pdf->AddPage('P');
      $pageTitle = "BẢNG CHÀO GIÁ BAO BÌ";
      $titleHtml = '<label style="font-size:15px; text-align:center"><u>' . $pageTitle . '</u></label><br>';
      $pdf->setY(40);
      $pdf->writeHTML($titleHtml, true, false, false, false, '');
      $totalPage = $pdf->getAliasNbPages();
      $view = new View($this);
      $view->set('data', $dataObj);
      $view->set('totalPage', $totalPage);
      $productItems = $this->FacsimileMassageProduct->find('all', array(
        'conditions' => array('facsimile_massage_id' => $id),
        //'order' => array('order asc')
      ));
      $view->set('productItems', $productItems);
      $html = $view->render('report_pdf');
      //echo $html; die();
      $pdf->setX(30);
      $pdf->writeHTML($html, true, false, false, false, '');

      $date = reformatDate($dataObj['FacsimileMassage']['created_time'], '\N\g\à\y d \t\h\á\n\g m \n\ă\m Y');
      $pdf->setX(150);
      $pdf->MultiCell(225, 101,$date, 0, 'J', 0, 1, '', '', true, null, true);


      $exportFileName = 'pdf_report_' . date('Y_m_d_H_i_s') . '.pdf';
      $tmpFile = WWW_ROOT . 'files/uploads/tmp/' . $exportFileName;
      $pdf->Output($tmpFile, 'I');

    }
  }

}

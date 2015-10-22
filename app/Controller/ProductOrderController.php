<?php

class ProductOrderController extends AppController {

  var $uses = array(
    'ProductOrder',
    'Customer',
    'Product',
    'ProductOrderProgress',
    'User.UserModel',
    'ProductUnit',
    'Costing'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'ProductOrder';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    $listCustomer = $this->Customer->find("list");
    $listProduct = $this->Product->find("list");
    $errorObj = array();
    $listUser = Hash::combine($this->UserModel->find('all'), '{n}.UserModel.id', '{n}.UserModel.display_name');
    $addedProgress = array();
    $productProgressBeforeAdded = $this->ProductOrderProgress->findAllByProductOrderId($id);
    $productProgressBeforeAdded = Hash::combine($productProgressBeforeAdded, '{n}.ProductOrderProgress.id', '{n}.ProductOrderProgress');
    if (empty($this->request->data)) {
      $addedProgress = $productProgressBeforeAdded;
      $this->request->data = $this->ProductOrder->findById($id);
    } else {//save
      $addedProgress = isset($this->request->data['ProductOrderProgress']) ? $this->request->data['ProductOrderProgress'] : array();
      $this->ProductOrder->set($this->request->data);
      if ($this->ProductOrder->save()) {
        $productOrderId = $this->ProductOrder->getId();
        $this->_saveProductOrderProgress($productOrderId, $addedProgress, $productProgressBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $errorObj = $this->ProductOrder->validationErrors;
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
    $this->set('errorObj', $errorObj);
    $this->set("listCustomer", $listCustomer);
    $this->set("listProduct", $listProduct);
    $this->set('listUser', $listUser);
    $this->set('addedProgress', $addedProgress);
  }
  private function _saveProductOrderProgress($productOrderId, $addedProgress, $productProgressBeforeAdded){
    if($addedProgress){
      $idProgressAdded = array_keys($addedProgress);
      $removedId = array();
      if($productProgressBeforeAdded){
        foreach($productProgressBeforeAdded as $pId => $pBefore){
          if(!in_array($pId, $idProgressAdded)){
            $removedId[] = $pId;
          }
        }
        if($removedId){
          $strRemovedId = implode(", ", $removedId);
          $query = "DELETE FROM {$this->ProductOrderProgress->useTable} WHERE id IN ({$strRemovedId})";
          $this->ProductOrderProgress->query($query);
        }
      }
      foreach($addedProgress as $progressId => $progress){
        if(is_numeric($progressId)){
          $progress['id'] = $progressId;
        }
        $progress['product_order_id'] = $productOrderId;
        $this->ProductOrderProgress->save($progress);
        $this->ProductOrderProgress->clear();
      }
    }



  }
  public function delete($id) {
    $this->ProductOrderProgress->deleteByProductOderId($id);
    $this->ProductOrder->deleteLogic($id);
    $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = array();
    $conditions['ProductOrder.deleted_time'] = null;
    $this->set('displayPaging', true);

    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
    );
    try{
      $dataList = $this->Paginator->paginate('ProductOrder');
      if($dataList){
        foreach($dataList as $k => $data){
          $costingByCustomerAndProduct = $this->Costing->find("first", array(
            'conditions' => array(
              'customer_id' => $data['Customer']['id'],
              'product_id' => $data['OutputProduct']['id'],
            )
          ));
          if($costingByCustomerAndProduct){
            $data['has_costing'] = true;
          }else{
            $data['has_costing'] = false;
          }
          $dataList[$k] = $data;
        }
      }
    }catch(Exception $e){
      $dataList = array();
    }
    $this->set('dataList', $dataList);
  }
  public function report($id){
    $dataObj = $this->ProductOrder->findById($id);
    if($dataObj){
      $costingByCustomerAndProduct = $this->Costing->find("first", array(
        'conditions' => array(
          'customer_id' => $dataObj['Customer']['id'],
          'product_id' => $dataObj['OutputProduct']['id'],
        )
      ));
      if($costingByCustomerAndProduct){
        $listUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit');
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
        $pdf->AddPage('P');
        $pageTitle = "PHIẾU BÁO SẢN XUẤT";
        $titleHtml = '<label style="font-size:15px; text-align:center"><u>' . $pageTitle . '</u></label><br>';
        $pdf->setY(40);
        $pdf->writeHTML($titleHtml, true, false, false, false, '');

        $view = new View($this);
        $view->set('data', $dataObj);
        $view->set('listUnit', $listUnit);
        $orderProgress = $this->ProductOrderProgress->find('all', array(
          'conditions' => array('product_order_id' => $id),
          'order' => array('order asc')
        ));
        $view->set('orderProgress', $orderProgress);
        //---------------------
        $cutting = $costingByCustomerAndProduct['Costing']['paper_cutting'];
        $numProduc = $dataObj['ProductOrder']['num_product'];
        $haoPhi = ($numProduc/$cutting)/50;
        $reportNum = ($numProduc/$cutting) + $haoPhi;
        $view->set('reportNum', $reportNum);
        $view->set('haoPhi', $haoPhi);
        $view->set('cutting', $cutting);
        //--------------------
        //echo "<pre>"; print_r($dataObj); die();
        $html = $view->render('report_pdf');
        //echo $html;die();
        //$pdf->setY(40);
        $pdf->setX(30);
        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->setX(31);
        $note = trim($dataObj['ProductOrder']['special_note']);
        $strText = str_replace("\n","<br>",$note);
        $pdf->MultiCell(205, 10,$strText, 0, 'J', 0, 1, '', '', true, null, true);

        $date = reformatDate($dataObj['ProductOrder']['created_time'], '\N\g\à\y d \t\h\á\n\g m \n\ă\m Y');
        $pdf->setX(130);
        $pdf->MultiCell(205, 10,$date, 0, 'J', 0, 1, '', '', true, null, true);
        //$pdf->Write(0, $date);

        $pdf->setX(31);
        $tabSpace = "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
        $text1 = "Người lập phiếu".$tabSpace."Người duyệt";
        $pdf->MultiCell(205, 35,$text1, 0, 'J', 0, 1, '', '', true, null, true);
        $text2 = "<b>".$dataObj['CreatedUser']['display_name']."&emsp;<b>".$tabSpace.$dataObj['ApprovedUser']['display_name'];
        $pdf->setX(31);
        $pdf->MultiCell(205, 5,$text2, 0, 'J', 0, 1, '', '', true, null, true);

        $exportFileName = 'pdf_report_' . date('Y_m_d_H_i_s') . '.pdf';
        $tmpFile = WWW_ROOT . 'files/uploads/tmp/' . $exportFileName;
        $pdf->Output($tmpFile, 'I');
      }else{

      }

    }
  }


}

<?php

class WorksSheetController extends AppController {

  var $uses = array(
    'WorksSheet',
    'Customer',
    'Product',
    'WorksSheetProgress',
    'User.UserModel',
    'ProductUnit',
    'Costing'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'WorksSheet';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    $worksSheetDb = $this->WorksSheet->findById($id);
    $this->checkCanDo($worksSheetDb);
    $currentUserId = $this->loggedUser->User->id;
    $listCustomer = $this->listCustomer();
    $listProduct = $this->listProduct();
    $isAdmin = $this->isAdmin();
    $errorObj = array();
    $listUser = $this->UserModel->listUser();
    if($worksSheetDb){
      $autoCode = $worksSheetDb['WorksSheet']['auto_code'];
    }else{
      $autoCode = $this->WorksSheet->getUniqCode();
    }
    $addedProgress = array();
    $productProgressBeforeAdded = $this->WorksSheetProgress->findAllByproductOrderId($id);
    $productProgressBeforeAdded = Hash::combine($productProgressBeforeAdded, '{n}.WorksSheetProgress.id', '{n}.WorksSheetProgress');
    if (empty($this->request->data)) {
      $addedProgress = $productProgressBeforeAdded;
      $this->request->data = $worksSheetDb;
    } else {//save
      $addedProgress = isset($this->request->data['WorksSheetProgress']) ? $this->request->data['WorksSheetProgress'] : array();
      if(!isset($this->request->data['WorksSheet']['created_user_id'])){
        $this->request->data['WorksSheet']['created_user_id'] = $currentUserId;
      }
      $this->request->data['WorksSheet']['auto_code'] = $autoCode;
      $this->WorksSheet->set($this->request->data);
      if ($this->WorksSheet->save()) {
        $WorksSheetId = $this->WorksSheet->getId();
        $this->_saveWorksSheetProgress($WorksSheetId, $addedProgress, $productProgressBeforeAdded);
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $errorObj = $this->WorksSheet->validationErrors;
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
    $this->set('errorObj', $errorObj);
    $this->set("listCustomer", $listCustomer);
    $this->set("listProduct", $listProduct);
    $this->set('listUser', $listUser);
    $this->set('isAdmin', $isAdmin);
    $this->set('addedProgress', $addedProgress);
  }
  private function _saveWorksSheetProgress($WorksSheetId, $addedProgress, $productProgressBeforeAdded){
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
          $query = "DELETE FROM {$this->WorksSheetProgress->useTable} WHERE id IN ({$strRemovedId})";
          $this->WorksSheetProgress->query($query);
        }
      }
      foreach($addedProgress as $progressId => $progress){
        if(is_numeric($progressId)){
          $progress['id'] = $progressId;
        }
        $progress['product_order_id'] = $WorksSheetId;
        $this->WorksSheetProgress->save($progress);
        $this->WorksSheetProgress->clear();
      }
    }



  }
  public function delete($id) {
    $worksSheetDb = $this->WorksSheet->findById($id);
    if($worksSheetDb){
      $this->checkCanDo($worksSheetDb);
      $this->WorksSheetProgress->deleteByProductOderId($id);
      $this->WorksSheet->deleteLogic($id);
      $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    }
    return $this->redirect(Router::url(array('action' => 'index')));
  }

  public function index() {
    $conditions = $this->getInitCondition();
    $this->set('displayPaging', true);

    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'limit' => ITEM_PER_PAGE,
    );
    try{
      $dataList = $this->Paginator->paginate('WorksSheet');
    }catch(Exception $e){
      $dataList = array();
    }
    $this->set('dataList', $dataList);
  }
  public function report($id){
    $dataObj = $this->WorksSheet->findById($id);
    if($dataObj){
      $this->checkCanDo($dataObj);
      $costingByCustomerAndProduct = $this->Costing->find("first", array(
        'conditions' => array(
          'Costing.customer_id' => $dataObj['Customer']['id'],
          'Costing.product_id' => $dataObj['OutputProduct']['id'],
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
        $orderProgress = $this->WorksSheetProgress->find('all', array(
          'conditions' => array('product_order_id' => $id),
          'order' => array('order asc')
        ));
        $view->set('orderProgress', $orderProgress);
        //---------------------
        $cutting = $costingByCustomerAndProduct['Costing']['paper_cutting'];
        $numProduc = $dataObj['WorksSheet']['num_product'];
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
        $note = trim($dataObj['WorksSheet']['special_note']);
        $strText = str_replace("\n","<br>",$note);
        $pdf->MultiCell(205, 10,$strText, 0, 'J', 0, 1, '', '', true, null, true);

        $date = reformatDate($dataObj['WorksSheet']['created_time'], '\N\g\à\y d \t\h\á\n\g m \n\ă\m Y');
        $pdf->setX(130);
        $pdf->MultiCell(205, 10,$date, 0, 'J', 0, 1, '', '', true, null, true);
        //$pdf->Write(0, $date);

        $pdf->setX(31);
        $tabSpace = "&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;";
        $text1 = "Người lập phiếu".$tabSpace."Người duyệt";
        $pdf->MultiCell(205, 35,$text1, 0, 'J', 0, 1, '', '', true, null, true);
        $text2 = "<b>".$dataObj['CreatedUser']['display_name']."<b>".$tabSpace.$dataObj['ApprovedUser']['display_name'];
        //$pdf->setX(31);
        //$pdf->MultiCell(205, 5,$text2, 0, 'J', 0, 1, '', '', true, null, true);

        $exportFileName = 'pdf_report_' . date('Y_m_d_H_i_s') . '.pdf';
        $tmpFile = WWW_ROOT . 'files/uploads/tmp/' . $exportFileName;
        header("Content-type: application/pdf");
        $pdf->Output($tmpFile, 'I');
      }else{

      }

    }
  }


}

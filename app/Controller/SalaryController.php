<?php

class SalaryController extends AppController {

  var $uses = array(
    'Salary',
    'User',
    'Customer'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Salary';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id=0){
    $listCustomer = $this->Customer->find("list");
    $errorObj = array();
    if (empty($this->request->data)) {
      $this->request->data = $this->Salary->findById($id);
    } else {
      $currentUserId = $this->loggedUser->User->id;
      $this->request->data['user_id'] = $currentUserId;
      $this->Salary->set($this->request->data);
      if ($this->Salary->save()) {
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        $this->redirect(Router::url(array('action' => 'index')));
      } else {
        $errorObj = $this->Salary->validationErrors;
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }

    }
    $this->set('errorObj', $errorObj);
    $this->set("listCustomer", $listCustomer);
  }



  public function delete($id) {
    $this->Salary->deleteLogic($id);
    $this->Session->setFlash(__('Your data is deleted successfully'), 'flash/success');
    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }
  public function index() {
    $currentUserId = $this->loggedUser->User->id;
    $dateFrom = isset($_GET['date_from']) ? strval($_GET['date_from']) : date('Y-m-01');
    $dateTo = isset($_GET['date_to']) ? strval($_GET['date_to']) : date('Y-m-d', time());

    $this->set('dateFrom', $dateFrom);
    $this->set('dateTo', $dateTo);

    $conditions = array();
    $conditions['Salary.deleted_time'] = null;
    $conditions['Salary.user_id'] = $currentUserId;
    if($dateFrom){
      $conditions[] = "Salary.date >= date('{$dateFrom}')";
    }
    if($dateTo){
      $conditions[] = "Salary.date <= date('{$dateTo}')";
    }
    $dataList = $this->Salary->find("all", array(
      'conditions' => $conditions
    ));
    $sumAmount = 0;
    $sumEntilement = 0;
    $sumAmount2 = 0;
    $sumEntilement2 = 0;
    if($dataList){

      foreach($dataList as $key => $data){
        $amount = $data['Salary']['amount'];
        $markUp = $data['Salary']['mark_up'];
        $entilement = ($amount * $markUp/100)/(1+$markUp/100);
        $data['Salary']['entilement'] = $entilement;
        $dataList[$key] = $data;
        $sumAmount += $amount;
        $sumEntilement += $entilement;
      }
      if($sumAmount<=100000000){
        $sumAmount2 = $sumAmount * 0.03;
      }elseif($sumAmount <= 200000000){
        $sumAmount2 = $sumAmount * 0.025 + 500000;
      }elseif($sumAmount <= 300000000){
        $sumAmount2 = $sumAmount * 0.02 + 2000000;
      }else{
        $sumAmount2 = $sumAmount * 0.015+4000000;
      }
      if($sumEntilement<=10000000){
        $sumEntilement2 = $sumEntilement * 0.05;
      }elseif($sumEntilement <= 20000000){
        $sumEntilement2 = $sumEntilement * 0.045+100000;
      }else{
        $sumEntilement2 = $sumEntilement * 0.03+600000;
      }
    }
    //die();
    //echo "<pre>"; print_r($dataList); die();
    $this->set("sumAmount", $sumAmount);
    $this->set("sumEntilement", $sumEntilement);

    $this->set("sumAmount2", $sumAmount2);
    $this->set("sumEntilement2", $sumEntilement2);

    $this->set('dataList', $dataList);
  }

}

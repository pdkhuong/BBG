<?php

class SalaryController extends AppController {

  var $uses = array(
    'Salary',
    'User.UserModel',
    'Customer',
    'Settings'
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
    $settings = Hash::combine($this->Settings->find("all"), '{n}.Settings.key', '{n}.Settings.val');
    $currentUserId = $this->loggedUser->User->id;
    $isAdmin = $this->isAdmin();
    $isAccounting = $this->isAccounting();
    $listUser = array();
    $userId = isset($_GET['user_id']) ? intval($_GET['user_id']) : $currentUserId;
    $dateFrom = isset($_GET['date_from']) ? strval($_GET['date_from']) : date('Y-m-01');
    $dateTo = isset($_GET['date_to']) ? strval($_GET['date_to']) : date('Y-m-d', time());
    if($isAdmin || $isAccounting){
      $listUser = $this->UserModel->listUser();
    }else{
      if($userId!=$currentUserId){
        $this->Session->setFlash(__('You are not authorized to access this page'), 'flash/error');
        $this->redirect('/');
      }
    }
    $this->set('dateFrom', $dateFrom);
    $this->set('dateTo', $dateTo);
    $this->set('listUser', $listUser);
    $this->set('userId', $userId);

    $conditions = array();
    $conditions['Salary.deleted_time'] = null;
    $conditions['Salary.user_id'] = $userId;
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
      $doanhSo1 = $settings['salary_doanhso_1'];
      $doanhSo2 = $settings['salary_doanhso_2'];
      $doanhSo3 = $settings['salary_doanhso_3'];

      $hoahong1 = $settings['salary_hoahong_1'];
      $hoahong2 = $settings['salary_hoahong_2'];
      $hoahong3 = $settings['salary_hoahong_3'];
      $hoahong4 = $settings['salary_hoahong_4'];

      $siengnang1 = $settings['salary_siengnang_1'];
      $siengnang2 = $settings['salary_siengnang_2'];
      $siengnang3 = $settings['salary_siengnang_3'];

      $entilementDoanhSo1 = $settings['entilement_doanhso_1'];
      $entilementDoanhSo2 = $settings['entilement_doanhso_2'];
      $entilementHoaHong1 = $settings['entilement_hoahong_1'];
      $entilementHoaHong2 = $settings['entilement_hoahong_2'];
      $entilementHoaHong3 = $settings['entilement_hoahong_3'];
      $entilementSiengNang1 = $settings['entilement_siengnang_1'];
      $entilementSiengNang2 = $settings['entilement_siengnang_2'];


      if($sumAmount<=$doanhSo1){
        $sumAmount2 = $sumAmount * $hoahong1;
      }elseif($sumAmount <= $doanhSo2){
        $sumAmount2 = $sumAmount * $hoahong2 + $siengnang1;
      }elseif($sumAmount <= $doanhSo3){
        $sumAmount2 = $sumAmount * $hoahong3 + $siengnang2;
      }else{
        $sumAmount2 = $sumAmount * $hoahong4+$siengnang3;
      }
      if($sumEntilement<=$entilementDoanhSo1){
        $sumEntilement2 = $sumEntilement * $entilementHoaHong1;
      }elseif($sumEntilement <= $entilementDoanhSo2){
        $sumEntilement2 = $sumEntilement * $entilementHoaHong2+$entilementSiengNang1;
      }else{
        $sumEntilement2 = $sumEntilement * $entilementHoaHong3+$entilementSiengNang2;
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

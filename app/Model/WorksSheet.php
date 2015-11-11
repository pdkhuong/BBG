<?php

App::uses('AppModel', 'Model');

class WorksSheet extends AppModel {

  var $useTable = 'product_order';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id',
    ),
    'Product' => array (
      'className' => 'Product',
      'foreignKey' => 'product_id',
    ),
    'User' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'user_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'customer_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select customer',
        'allowEmpty' => false,
      ),
    ),
    'product_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select product',
        'allowEmpty' => false,
      ),
    ),
    'auto_code' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 60,
        ),
        'message' => 'Please enter a text no larger than 60 characters long',
        'allowEmpty' => false,
      ),
      'unique_ws_auto_code' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'auto_code',
          ),
        ),
        'message' => 'Order No. already exists',
      ),
    ),
    'delivery_date' => array(
      "date"      => array(
        "rule"      => "date",
        "message"   => "Please Enter a valid date",
      ),
    ),
    'delivery_location' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'difference_percent' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid difference percent',
        'allowEmpty' => false,
      ),
    ),
    'special_note' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    ),
    'user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select created user',
        'allowEmpty' => false,
      ),
    ),
  );
  function getUniqCode(){
    $conditions = array();
    $conditions[] = 'YEAR(WorksSheet.created_time)=YEAR(CURDATE()) AND MONTH(WorksSheet.created_time)=MONTH(CURDATE())';
    $totalByMonth = $this->find('count', array(
      'conditions' =>$conditions
    ));
    $totalByMonth = $totalByMonth+1;
    $str = $totalByMonth;
    if($totalByMonth<10){
      $str = '00'.$totalByMonth;
    }elseif($totalByMonth<100){
      $str = '0'.$totalByMonth;
    }
    $str = 'WS'.date('ym', time()).$str;
    return $str;
  }
}

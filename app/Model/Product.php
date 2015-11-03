<?php

App::uses('AppModel', 'Model');

class Product extends AppModel {

  var $useTable = 'product';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'ProductUnit' => array (
      'className' => 'ProductUnit',
      'foreignKey' => 'product_unit_id',
    ),
    'File' => array (
      'className' => 'File',
      'foreignKey' => 'file_id',
    ),
    'User' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'user_id',
    ),
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select user',
        'allowEmpty' => false,
      ),
    ),
    'customer_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select customer',
        'allowEmpty' => false,
      ),
    ),
    'item_no' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 6,
        ),
        'message' => 'Please enter a text no larger than 6 characters long',
        'allowEmpty' => false,
      ),
      'unique_item_no' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'item_no',
          ),
        ),
        'message' => 'Item No. already exists',
      ),
      'last_number' => array(
        'rule' => 'checkLastNumber',
        'message' => 'Last character must be a number'
      )
    ),
    'name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'specification' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid price',
        'allowEmpty' => true,
      ),
    ),
    'product_unit_id' =>  array (
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please choose product unit',
        'allowEmpty' => false,
      ),
    ),
    'file_id' =>  array (
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please choose product unit',
        'allowEmpty' => true,
      ),
    ),
  );
  public function checkLastNumber($check) {
    $ret = false;
    if(isset($check['item_no'])){
      $itemNo = $check['item_no'];
      $lastChar = substr($itemNo, -1);
      if(is_numeric($lastChar)){
        $ret = true;
      }
    }
    return $ret;
  }
}

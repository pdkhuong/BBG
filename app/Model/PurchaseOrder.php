<?php

App::uses('AppModel', 'Model');

class PurchaseOrder extends AppModel {

  var $useTable = 'purchase_order';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id',
    ),
    'User' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'user_id',
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
    'order_no' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 60,
        ),
        'message' => 'Please enter a text no larger than 60 characters long',
        'allowEmpty' => false,
      ),
      'unique_order_no' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'order_no',
          ),
        ),
        'message' => 'Order No. already exists',
      ),
    ),
    'customer_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid price',
        'allowEmpty' => false,
      ),
    ),
    'buyer_name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'term' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'order_date' => array(
      "date"      => array(
        "rule"      => "date",
        "message"   => "Please Enter a valid date",
      ),
    ),
    'received_date' => array(
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        "message"   => "Please Enter a valid date",
      ),
    ),
    'term' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'ship_via' =>  array (
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please choose ship type',
        'allowEmpty' => false,
      ),
    ),
  );
}

<?php

App::uses('AppModel', 'Model');

class ProductOrder extends AppModel {

  var $useTable = 'product_order';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id',
    ),
    'InputProduct' => array (
      'className' => 'Product',
      'foreignKey' => 'input_product_id',
    ),
    'OutputProduct' => array (
      'className' => 'Product',
      'foreignKey' => 'output_product_id',
    ),
    'CreatedUser' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'created_user_id',
    ),
    'ApprovedUser' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'approved_user_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'output_product_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select output product',
        'allowEmpty' => false,
      ),
    ),
    'input_product_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select input product',
        'allowEmpty' => false,
      ),
    ),
    'num_product' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number product',
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
    'output_product_note' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
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
    'created_user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select created user',
        'allowEmpty' => false,
      ),
    ),
    'approved_user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select approved user',
        'allowEmpty' => false,
      ),
    ),
  );
}

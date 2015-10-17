<?php

App::uses('AppModel', 'Model');

class Costing extends AppModel {

  var $useTable = 'costing';
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


  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'key' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 100,
        ),
        'message' => 'Please enter a text no larger than 100 characters long',
        'allowEmpty' => false,
      ),
      'unique_key' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'key',
          ),
        ),
        'message' => 'Key already exists',
      ),
    ),
    'val' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    ),
    'name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    )
  );
}

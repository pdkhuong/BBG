<?php

App::uses('AppModel', 'Model');

class Product extends AppModel {

  var $useTable = 'product';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'ProductUnit' =>
      array (
        'className' => 'ProductUnit',
        'foreignKey' => 'product_unit_id',
      ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'item_no' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 60,
        ),
        'message' => 'Please enter a text no larger than 60 characters long',
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
        'allowEmpty' => false,
      ),
    ),
    'product_unit_id' =>  array (
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please choose product unit',
        'allowEmpty' => false,
      ),
    ),
  );
}
<?php

App::uses('AppModel', 'Model');

class FacsimileMassageProduct extends AppModel {

  var $useTable = 'facsimile_massage_product';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'Product' =>
    array (
      'className' => 'Product',
      'foreignKey' => 'product_id',
    ),
    'FacsimileMassage' =>
    array (
      'className' => 'FacsimileMassage',
      'foreignKey' => 'facsimile_massage_id',
    ),
  );

  var $actsAs = array ('MultiLanguage.MultiLanguage');
  var $validate = array (
    'product_id' =>  array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
      ),
    ),
    'facsimile_massage_id' => array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
      ),
    ),
    'num_item' => array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
      ),
    ),
    'price' => array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
      ),
    ),
  );
  public function deleteByFacsimileMassageId($facsimileMassageId){
    $query = "DELETE FROM {$this->useTable} WHERE facsimile_massage_id={$facsimileMassageId}";
    $this->query($query);
  }
  public function deleteByProductId($productId){
    $query = "DELETE FROM {$this->useTable} WHERE product_id={$productId}";
    $this->query($query);
  }
}

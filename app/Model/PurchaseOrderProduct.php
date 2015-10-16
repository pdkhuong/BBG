<?php

App::uses('AppModel', 'Model');

class PurchaseOrderProduct extends AppModel {

  var $useTable = 'purchase_order_product';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'Product' =>
    array (
      'className' => 'Product',
      'foreignKey' => 'product_id',
    ),
    'PurchaseOrder' =>
    array (
      'className' => 'PurchaseOrder',
      'foreignKey' => 'purchase_order_id',
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
    'purchase_order_id' => array (
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
  );
  public function deleteByPurchaseOderId($purchaseOrderId){
    $query = "DELETE FROM {$this->useTable} WHERE purchase_order_id={$purchaseOrderId}";
    $this->query($query);
  }
  public function deleteByProductrId($productId){
    $query = "DELETE FROM {$this->useTable} WHERE product_id={$productId}";
    $this->query($query);
  }
}

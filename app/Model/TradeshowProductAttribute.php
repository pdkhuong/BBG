<?php

App::uses('AppModel', 'Model');

class TradeshowProductAttribute extends AppModel {

  var $useTable = 'tradeshow_product_attribute';
  var $multiLanguage = array ('columns' => array ('value'));

  public $belongsTo = array (
    'TradeshowAttribute' => 
    array (
      'className' => 'TradeshowAttribute',
      'foreignKey' => 'attribute_id',
    ),
    'TradeshowProduct' => 
    array (
      'className' => 'TradeshowProduct',
      'foreignKey' => 'product_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'product_id' => 
    array (
      'notNull' => 
      array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'numeric' => 
      array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
      ),
    ),
    'attribute_id' => 
    array (
      'notNull' => 
      array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'numeric' => 
      array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
      ),
    ),
  );
}

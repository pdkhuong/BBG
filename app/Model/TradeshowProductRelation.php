<?php

App::uses('AppModel', 'Model');

class TradeshowProductRelation extends AppModel {

  var $useTable = 'tradeshow_product_relation';
  var $multiLanguage = null;

  public $belongsTo = array (
    'TradeshowProduct' => 
    array (
      'className' => 'TradeshowProduct',
      'foreignKey' => 'product_relation_id',
    ),
    'TradeshowProductProduct' => 
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
    'product_relation_id' => 
    array (
      'numeric' => 
      array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
        'allowEmpty' => true,
      ),
    ),
    'type' => 
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
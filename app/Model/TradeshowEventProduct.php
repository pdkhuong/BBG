<?php

App::uses('AppModel', 'Model');

class TradeshowEventProduct extends AppModel {

  var $useTable = 'tradeshow_event_product';
  var $multiLanguage = null;

  public $belongsTo = array (
    'TradeshowProduct' => 
    array (
      'className' => 'TradeshowProduct',
      'foreignKey' => 'product_id',
    ),
    'TradeshowEvent' => 
    array (
      'className' => 'TradeshowEvent',
      'foreignKey' => 'event_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'event_id' => 
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
  );
}
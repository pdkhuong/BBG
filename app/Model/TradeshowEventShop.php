<?php

App::uses('AppModel', 'Model');

class TradeshowEventShop extends AppModel {

  var $useTable = 'tradeshow_event_shop';
  var $multiLanguage = null;

  public $belongsTo = array (
    'TradeshowShop' => 
    array (
      'className' => 'TradeshowShop',
      'foreignKey' => 'shop_id',
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
    'shop_id' => 
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
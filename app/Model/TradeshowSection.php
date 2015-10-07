<?php

App::uses('AppModel', 'Model');

class TradeshowSection extends AppModel {

  var $useTable = 'tradeshow_section';
  var $multiLanguage = null;

  public $belongsTo = array (
    'TradeshowShop' => 
    array (
      'className' => 'TradeshowShop',
      'foreignKey' => 'shop_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
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
    'name' => 
    array (
      'notNull' => 
      array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
    ),
  );
}
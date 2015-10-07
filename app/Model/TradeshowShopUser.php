<?php

App::uses('AppModel', 'Model');

class TradeshowShopUser extends AppModel {

  var $useTable = 'tradeshow_shop_user';
  var $multiLanguage = null;

  public $belongsTo = array (
    'User' => 
    array (
      'className' => 'User',
      'foreignKey' => 'user_id',
    ),
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
    'user_id' => 
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
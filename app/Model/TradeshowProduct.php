<?php

App::uses('AppModel', 'Model');

class TradeshowProduct extends AppModel {

  var $useTable = 'tradeshow_product';
  var $multiLanguage = array ('columns' => array ('name'));

  public $belongsTo = array (
    'TradeshowShop' => 
    array (
      'className' => 'TradeshowShop',
      'foreignKey' => 'shop_id',
    ),
    'TradeshowCategory' =>
      array (
        'className' => 'TradeshowCategory',
        'foreignKey' => 'category_id',
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
      'size' => 
      array (
        'rule' => 
        array (
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
      ),
    ),
  );
}

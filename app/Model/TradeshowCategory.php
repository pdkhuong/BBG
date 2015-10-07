<?php

App::uses('AppModel', 'Model');

class TradeshowCategory extends AppModel {

  var $useTable = 'tradeshow_category';
  var $multiLanguage = array ('columns' => array ('name'));

  public $belongsTo = array (
    'TradeshowCategoryParent' => 
    array (
      'className' => 'TradeshowCategory',
      'foreignKey' => 'parent_id',
    ),
    'TradeshowShop' => 
    array (
      'className' => 'TradeshowShop',
      'foreignKey' => 'shop_id',
    ),
  );

  public $actsAs = array('SFTree', 'MultiLanguage.MultiLanguage');
  var $validate = array (
    'shop_id' => 
    array (
      'numeric' => 
      array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
        'allowEmpty' => true,
      ),
    ),
    'parent_id' => 
    array (
      'numeric' => 
      array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid number',
        'allowEmpty' => true,
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
    'order' => 
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

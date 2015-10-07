<?php

App::uses('AppModel', 'Model');

class TradeshowCategoryAttributeValue extends AppModel {

  var $useTable = 'tradeshow_category_attribute_value';
  var $multiLanguage = array ('columns' => array ('value'));

  public $belongsTo = array (
    'TradeshowAttribute' => 
    array (
      'className' => 'TradeshowAttribute',
      'foreignKey' => 'attribute_id',
    ),
    'TradeshowCategory' =>
    array (
      'className' => 'TradeshowCategory',
      'foreignKey' => 'category_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'category_id' =>
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

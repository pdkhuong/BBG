<?php

App::uses('AppModel', 'Model');

class TradeshowCategoryAttribute extends AppModel {

  var $useTable = 'tradeshow_category_attribute';
  var $multiLanguage = array ('columns' => array ('value'));

  public $belongsTo = array (
    'TradeshowCategory' => 
    array (
      'className' => 'TradeshowCategory',
      'foreignKey' => 'category_id',
    ),
    'TradeshowAttribute' => 
    array (
      'className' => 'TradeshowAttribute',
      'foreignKey' => 'attribute_id',
    ),
  );

  var $actsAs = array ('MultiLanguage.MultiLanguage');
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

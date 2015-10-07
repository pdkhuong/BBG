<?php

App::uses('AppModel', 'Model');

class TradeshowEvent extends AppModel {
  var $useTable = 'tradeshow_event';
  var $multiLanguage = array ('columns' => array ('name'));
  public $actsAs = array('MultiLanguage.MultiLanguage', 'File.File');
  var $validate = array (
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
    'from_date' => 
    array (
      'datetime' => 
      array (
        'rule' => 
        array (
          0 => 'datetime',
          1 => 'ymd',
        ),
        'message' => 'Please enter a valid date format',
        'allowEmpty' => true,
      ),
    ),
    'to_date' => 
    array (
      'datetime' => 
      array (
        'rule' => 
        array (
          0 => 'datetime',
          1 => 'ymd',
        ),
        'message' => 'Please enter a valid date format',
        'allowEmpty' => true,
      ),
    ),
    'status' => 
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

<?php

App::uses('AppModel', 'Model');

class Calendar extends AppModel {

  var $useTable = 'calendar';
  var $multiLanguage = null;
  public $belongsTo = array (
    'User' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'user_id',
    ),
  );
  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select user',
        'allowEmpty' => false,
      ),
    ),
    'name' =>array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
      'size' => array (
        'rule' => array (
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
      ),
    ),
	'from_date' => array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
	),
	'to_date' => array (
      'notNull' => array (
        'rule' => 'notEmpty',
        'required' => true,
        'message' => 'This field cannot be left blank',
      ),
	),
  );
}
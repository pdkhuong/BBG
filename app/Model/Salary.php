<?php

App::uses('AppModel', 'Model');

class Salary extends AppModel {

  var $useTable = 'salary';
  var $multiLanguage = null;
  public $belongsTo = array (
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id',
    ),
    'User' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'user_id',
    ),
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'customer_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select customer',
        'allowEmpty' => false,
      ),
    ),
    'user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select user',
        'allowEmpty' => false,
      ),
    ),
    'amount' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid amount',
        'allowEmpty' => false,
      ),
    ),
    'mark_up' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid mark up',
        'allowEmpty' => false,
      ),
    ),
    'date' => array(
      "date"      => array(
        "rule"      => "date",
        "message"   => "Please Enter a valid date",
      ),
    ),

  );
}
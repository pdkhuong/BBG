<?php

App::uses('AppModel', 'Model');

class FacsimileMassage extends AppModel {

  var $useTable = 'facsimile_massage';
  var $multiLanguage = array ();

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
    'user_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select user',
        'allowEmpty' => false,
      ),
    ),
    'customer_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid price',
        'allowEmpty' => false,
      ),
    ),
    'name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'attn' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'num_color' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid num color',
        'allowEmpty' => false,
      ),
    ),
  );
}

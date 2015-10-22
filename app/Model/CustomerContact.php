<?php

App::uses('AppModel', 'Model');

class CustomerContact extends AppModel {

  var $useTable = 'customer_contact';
  public $belongsTo = array (
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id'
    ),
  );
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array ();
}
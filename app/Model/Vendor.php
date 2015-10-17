<?php

App::uses('AppModel', 'Model');

class Vendor extends AppModel {

  var $useTable = 'Vendor';
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
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
	'email' => array(
        'rule' => array('email', true),
        'message' => 'Please supply a valid email address.'
    ),
	'phone' => array(
        'rule' => '/^[0-9]{10,11}$/i',
		'message' => 'Please supply a valid phone number.'
    ),
	'fax' => array(
        'rule' => '/^[0-9]{10,11}$/i',
		'message' => 'Please supply a valid fax number.'
    ),
  );
}
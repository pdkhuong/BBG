<?php

App::uses('AppModel', 'Model');

class CalendarCustomer extends AppModel {

  var $useTable = 'calendar_customer';
  public $belongsTo = array (
    'Calendar' => array (
      'className' => 'Calendar',
      'foreignKey' => 'calendar_id'
    ),
	'Customer' => array(
		'className' => 'Customer',
		'foreignKey' => 'customer_id'
	),
  );
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array ();
}
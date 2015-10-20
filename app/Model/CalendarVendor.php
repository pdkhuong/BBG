<?php

App::uses('AppModel', 'Model');

class CalendarVendor extends AppModel {

  var $useTable = 'calendar_vendor';
  public $belongsTo = array (
    'Calendar' => array (
      'className' => 'Calendar',
      'foreignKey' => 'calendar_id'
    ),
	'Vendor' => array(
		'className' => 'Vendor',
		'foreignKey' => 'vendor_id'
	),
  );
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array ();
}
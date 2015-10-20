<?php

App::uses('AppModel', 'Model');

class CalendarLead extends AppModel {

  var $useTable = 'calendar_lead';
  public $belongsTo = array (
    'Calendar' => array (
      'className' => 'Calendar',
      'foreignKey' => 'calendar_id'
    ),
	'Lead' => array(
		'className' => 'Lead',
		'foreignKey' => 'lead_id'
	),
  );
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array ();
}
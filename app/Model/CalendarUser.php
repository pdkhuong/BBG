<?php

App::uses('AppModel', 'Model');

class CalendarUser extends AppModel {

  var $useTable = 'calendar_user';
  public $belongsTo = array (
    'Calendar' => array (
      'className' => 'Calendar',
      'foreignKey' => 'calendar_id'
    ),
	'User' => array(
		'className' => 'User.UserModel',
		'foreignKey' => 'user_id'
	),
  );
  var $multiLanguage = null;
  var $validate = array ();
}
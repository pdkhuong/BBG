<?php

App::uses('AppModel', 'Model');

class LeadContact extends AppModel {

  var $useTable = 'lead_contact';
  public $belongsTo = array (
    'Lead' => array (
      'className' => 'Lead',
      'foreignKey' => 'lead_id'
    ),
  );
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array ();
}
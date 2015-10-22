<?php

App::uses('AppModel', 'Model');

class VendorContact extends AppModel {

  var $useTable = 'vendor_contact';
  public $belongsTo = array (
    'Vendor' => array (
      'className' => 'Vendor',
      'foreignKey' => 'vendor_id'
    ),
  );
  var $multiLanguage = null;

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array ();
}
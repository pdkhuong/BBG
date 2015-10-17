<?php

App::uses('AppModel', 'Model');

class Settings extends AppModel {

  var $useTable = 'settings';
  var $multiLanguage = array ();

  public $belongsTo = array ();

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'key' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 100,
        ),
        'message' => 'Please enter a text no larger than 100 characters long',
        'allowEmpty' => false,
      ),
      'unique_key' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'key',
          ),
        ),
        'message' => 'Key already exists',
      ),
    ),
    'val' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    ),
    'name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    )
  );
  function getValueByKey($key){
    $ret = null;
    $data = $this->findByKey($key);
    if(isset($data['val'])){
      $ret = $data['val'];
    }
    return $ret;
  }
}

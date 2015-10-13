<?php

App::uses('AppModel', 'Model');

class ProductUnit extends AppModel {

  var $useTable = 'product_unit';
  var $multiLanguage = array ();

  public $belongsTo = array (
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 60,
        ),
        'message' => 'Please enter a text no larger than 60 characters long',
        'allowEmpty' => false,
      ),
      'unique_name' => array(
        'rule' => array(
          0 => 'checkUnique',
          1 => array(
            0 => 'name',
          ),
        ),
        'message' => 'Item No. already exists',
      ),
    ),
  );
}

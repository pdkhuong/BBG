<?php

App::uses('AppModel', 'Model');

class WorksSheetProgress extends AppModel {

  var $useTable = 'product_order_progress';
  var $multiLanguage = array ();

  public $belongsTo = array (
    'WorksSheet' => array (
      'className' => 'WorksSheet',
      'foreignKey' => 'product_order_id',
    )
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'product_order_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select output product',
        'allowEmpty' => false,
      ),
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
    ),
    'location' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    ),
    'order' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid order',
        'allowEmpty' => false,
      ),
    ),
  );
  public function deleteByProductOderId($WorksSheetId){
    $query = "DELETE FROM {$this->useTable} WHERE product_order_id={$WorksSheetId}";
    $this->query($query);
  }
}

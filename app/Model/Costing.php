<?php

App::uses('AppModel', 'Model');

class Costing extends AppModel {

  var $useTable = 'costing';
  var $multiLanguage = array ();
  public $belongsTo = array (
    'Customer' => array (
      'className' => 'Customer',
      'foreignKey' => 'customer_id',
    ),
    'Product' => array (
      'className' => 'Product',
      'foreignKey' => 'product_id',
    ),
  );
  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'customer_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select customer',
        'allowEmpty' => false,
      ),
    ),
    'product_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select product',
        'allowEmpty' => false,
      ),
    ),
    'person_ic' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => false,
      )
    ),
    'spec_length' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid specification length',
        'allowEmpty' => false,
      ),
    ),
    'spec_width' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid specification width',
        'allowEmpty' => false,
      ),
    ),
    'paper_length' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper length',
        'allowEmpty' => false,
      ),
    ),
    'paper_width' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper width',
        'allowEmpty' => false,
      ),
    ),
    'paper_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper substance',
        'allowEmpty' => false,
      ),
    ),
    'paper_cutting' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper cutting',
        'allowEmpty' => false,
      ),
    ),
    'paper_price_ton' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper price per ton',
        'allowEmpty' => false,
      ),
    ),
    'paper_price_ram' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper price per ram',
        'allowEmpty' => false,
      ),
    ),
    'printing_color' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing color',
        'allowEmpty' => false,
      ),
    ),
    'printing_coverage' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing coverage',
        'allowEmpty' => false,
      ),
    ),
    'printing_cost' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing cost',
        'allowEmpty' => false,
      ),
    ),
    'printing_films' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing films',
        'allowEmpty' => false,
      ),
    ),
    'vanish_oil' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid vanish oil',
        'allowEmpty' => false,
      ),
    ),
    'vanish_uv' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid vanish uv',
        'allowEmpty' => false,
      ),
    ),
    'vanish_opp' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid vanish opp',
        'allowEmpty' => false,
      ),
    ),
    'ply' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid PLY',
        'allowEmpty' => false,
      ),
    ),
    'limination' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid limination',
        'allowEmpty' => false,
      ),
    ),
    'die_cut' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid Die-Cut',
        'allowEmpty' => false,
      ),
    ),
    'packaging' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid packaging',
        'allowEmpty' => false,
      ),
    ),
    'transportation' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid transportation',
        'allowEmpty' => false,
      ),
    ),
    'quantity' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid quantity',
        'allowEmpty' => false,
      ),
    ),
    'mk' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid MK',
        'allowEmpty' => false,
      ),
    ),
    'exchange' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid exchange',
        'allowEmpty' => false,
      ),
    ),

    'inner_surf_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid inner surf substance',
        'allowEmpty' => false,
      ),
    ),
    'inner_surf_price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid inner surf price',
        'allowEmpty' => false,
      ),
    ),
    'b_flute_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid B - Flute substance',
        'allowEmpty' => false,
      ),
    ),
    'b_flute_price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid B - Flute price',
        'allowEmpty' => false,
      ),
    ),
    'e_flute_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid E - Flute substance',
        'allowEmpty' => false,
      ),
    ),
    'e_flute_price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid E - Flute price',
        'allowEmpty' => false,
      ),
    ),
    'gluing_1' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid gluing',
        'allowEmpty' => false,
      ),
    ),
    'gluing_2' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid gluing',
        'allowEmpty' => false,
      ),
    ),
    'gluing_3' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid gluing',
        'allowEmpty' => false,
      ),
    ),
  );
  /*
  public function beforeValidate($options=array()){
    $gluingArr = Configure::read("COSTING_GLUING");
    foreach($gluingArr as $gluingId => $gluingValue){
      $gluingAlias = "gluing_".$gluingValue;
      $this->validator()->add($gluingAlias, array(
          'numeric' => array (
            'rule' => 'numeric',
            'message' => 'Please enter a valid Gluing',
            'allowEmpty' => false,
          ),
        )
      );
    }
    return true;
  }*/
}

<?php

class AjaxController extends AppController {

  var $uses = array(
    'Product',
    'Costing'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->autoRender = false;
  }

  function beforeRender() {
    parent::beforeRender();

  }

  function afterFilter() {
    parent::afterFilter();
  }
  function index(){
    die();
  }
  function getProduct(){
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $ret = array();
    if($productId){
      $this->Product->recursive = -1;
      $ret = $this->Product->findById($productId);
    }
    return json_encode($ret);
    die();
  }
  function getCosting(){
    $productId = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $ret = array();
    if($productId){
      $this->Costing->recursive = -1;
      $ret = $this->Costing->findByProductId($productId);
    }
    return json_encode($ret);
    die();
  }


}

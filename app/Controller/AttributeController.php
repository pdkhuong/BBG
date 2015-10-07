<?php

class AttributeController extends AppController {

  public $uses = array('TradeshowAttribute');

  public function index($shopId = 1) {
    $listAttributes = $this->TradeshowAttribute->find('all', array('conditions' => array('TradeshowAttribute.shop_id' => $shopId), 'order' => array('TradeshowAttribute.order ASC')));
    $this->set('listAttributes',$listAttributes);
  }

  public function edit($id=0, $shopId=1) {

    $attributeType = Configure::read('TRADESHOW_ATTRIBUTE_TYPE');
    $listAttrType = array();
    foreach($attributeType as $key => $val) {
      $listAttrType[$key] = $val['name'];
    }
    $this->set('listAttrType',$listAttrType);

    if (empty($this->request->data)) {
      $this->request->data = $this->TradeshowAttribute->findByIdEdit($id);
    } else {
      $this->request->data['TradeshowAttribute']['id'] = $id;
      $this->request->data['TradeshowAttribute']['shop_id'] = $shopId;
      $this->TradeshowAttribute->set($this->request->data);

      if (!$this->TradeshowAttribute->save()) {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      } else {
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('controller' => 'Attribute', 'action' => 'index')));
      }
    }
  }

  public function delete($id) {
    $this->TradeshowAttribute->delete($id);
    $this->TradeshowAttribute->query('UPDATE tradeshow_category_attribute SET deleted_time = "'.date('Y-m-d H:i:s').'" WHERE attribute_id = '.$id);
    $this->TradeshowAttribute->query('UPDATE tradeshow_product_attribute SET deleted_time = "'.date('Y-m-d H:i:s').'" WHERE attribute_id = '.$id);
    return $this->redirect(Router::url(array('controller' => 'Attribute', 'action' => 'index')));
  }

}

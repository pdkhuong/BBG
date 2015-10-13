<?php

class ProductController extends AppController {

  var $uses = array(
    'Product',
    'ProductUnit'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Product';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    $listUnit = Hash::combine($this->ProductUnit->find('all'), '{n}.ProductUnit.id', '{n}.ProductUnit.name');
    $this->set('listUnit', $listUnit);
    if (empty($this->request->data)) {
      $this->request->data = $this->Product->findById($id);
    } else {//save
      $this->Product->set($this->request->data);
      if ($this->Product->save()) {
        //end save event shop
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
        //print_r($this->Product->validationErrors);
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      }
    }
  }

  public function delete($id) {
    if ($this->TradeshowEvent->isInUsed($id)) {
      $this->Session->setFlash(__('Unable to delete your data. It\'s in used'), 'flash/error');
      return $this->redirect($this->referer());
    }
    $this->TradeshowEvent->deleteLogic($id);

    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index() {
    $conditions = array();
    $conditions['Product.deleted_time'] = null;
    $dataList = $this->Product->find('all', array('conditions' => $conditions));
    $this->set('dataList', $dataList);
  }

  public function addProduct($eventId) {
    /*$this->set('displayPaging', true);
    $this->Paginator->settings = array(
      'conditions' => array('TradeshowProduct.deleted_time' => null),
      'limit' => 10,
      'order' => array(
        'TradeshowProduct.id' => 'desc'
      )
    );*/
    if (empty($this->request->data)) {
      $listProduct = $this->TradeshowProduct->find("all");
      //$listProduct = $this->Paginator->paginate('TradeshowProduct');
      $eventProduct = $this->TradeshowEventProduct->findAllByEventId($eventId);
      $this->set('listProduct', $listProduct);
      $ownProducts = Hash::combine($eventProduct, '{n}.TradeshowEventProduct.product_id', '{n}.TradeshowEventProduct.event_id');
      $this->set('ownProducts', $ownProducts);
    } else {
      $productIds = $this->request->data['TradeshowProduct']['id'];
      $this->_deleteAllProductEvent($eventId, array_keys($productIds));
      if ($productIds) {
        foreach ($productIds as $productId => $flag) {
          try {
            $eventProductDb = $this->TradeshowEventProduct->findByProductIdAndEventId($productId, $eventId);
            if (!$eventProductDb) {
              $saveData = array('product_id' => $productId, 'event_id' => $eventId);
              $this->TradeshowEventProduct->save($saveData);
              $this->TradeshowEventProduct->clear();
            }
          } catch (Exception $ex) {

          }
        }
      }
      $this->Session->setFlash(__('Products add to event successfully'), 'flash/success');
      $currentLink = Router::url(array('action' => 'addProduct', $eventId));
      $this->redirect($currentLink);
    }
  }
  private function _deleteAllProductEvent($eventId, $notInProductConditions) {
    $query = 'UPDATE tradeshow_event_product SET deleted_time = "'.date('Y-m-d H:i:s').'" WHERE event_id = '.$eventId;
    if($notInProductConditions){
      $strCondition = "(".implode(", ", $notInProductConditions).")";
      $query .= " AND product_id NOT IN ".$strCondition;
    }
    $this->TradeshowEventProduct->query($query);
    $this->TradeshowEventProduct->clear();
  }

  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }

}

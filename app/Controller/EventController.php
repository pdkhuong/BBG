<?php

class EventController extends AppController {

  var $uses = array(
    'TradeshowEventShop',
    'TradeshowProduct',
    'TradeshowEventProduct'
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'TradeshowEvent';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  public function edit($id = 0) {
    if (empty($this->request->data)) {//show on edit
      $this->request->data = $this->TradeshowEvent->findById($id);
      if ($this->request->data) {
        $this->request->data['TradeshowEvent']['from_date'] = $this->_formatDate($this->request->data['TradeshowEvent']['from_date'], 'Y-m-d');
        $this->request->data['TradeshowEvent']['to_date'] = $this->_formatDate($this->request->data['TradeshowEvent']['to_date'], 'Y-m-d');
      }
    } else {//save
      $this->request->data['TradeshowEvent']['status'] = EVENT_STATUS_NEW;
      if ($this->request->data['TradeshowEvent']['txt_from_date']) {
        $this->request->data['TradeshowEvent']['from_date'] = $this->_formatDate($this->request->data['TradeshowEvent']['txt_from_date'], 'Y-m-d H:i:s');
      }
      if ($this->request->data['TradeshowEvent']['txt_to_date']) {
        $this->request->data['TradeshowEvent']['to_date'] = $this->_formatDate($this->request->data['TradeshowEvent']['txt_to_date'], 'Y-m-d H:i:s');
      }
      $this->TradeshowEvent->set($this->request->data);
      if ($this->TradeshowEvent->save()) {
        //save event_shop
        try {
          $eventId = $this->TradeshowEvent->getID();
          $shopId = SHOP_DEFAULT_ID;
          $eventShopDb = $this->TradeshowEventShop->findByEventIdAndShopId($eventId, $shopId);
          if (!$eventShopDb) {
            $eventShopData = array('event_id' => $eventId, 'shop_id' => SHOP_DEFAULT_ID);
            $this->TradeshowEventShop->save($eventShopData, false);
          }
        } catch (Exception $ex) {

        }
        //end save event shop
        $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        return $this->redirect(Router::url(array('action' => 'index')));
      } else {
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
    $condition = array();
    $condition['TradeshowEvent.deleted_time'] = null;

    $this->set('displayPaging', true);
    $this->Paginator->settings = array(
      'conditions' => $condition,
      'limit' => 10
    );
    $dataList = $this->Paginator->paginate('TradeshowEvent');
    if ($dataList) {
      foreach ($dataList as $key => $data) {
        $dataList[$key]['TradeshowEvent']['from_date'] = $this->_formatDate($data['TradeshowEvent']['from_date'], 'Y-m-d');
        $dataList[$key]['TradeshowEvent']['to_date'] = $this->_formatDate($data['TradeshowEvent']['to_date'], 'Y-m-d');
      }
    }
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

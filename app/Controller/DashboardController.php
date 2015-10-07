<?php

class DashboardController extends AppController {

  /**
   * This controller does not use a model
   *
   * @var array
   */
  public $uses = array('TradeshowEvent');

  public function beforeFilter() {
    parent::beforeFilter();
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  /**
   * Displays a view
   *
   */
  public function display() {
    try {
      $eventFinish = $this->TradeshowEvent->find('first',array('conditions' => array('to_date < "'.date('Y-m-d').'"'), 'order' => array('to_date DESC')));
      if(empty($eventFinish)) {
        $limit = 5;
      } else {
        $limit = 4;
      }

      $this->TradeshowEvent->virtualFields = array(
        'openingStatus' => 'IF(from_date > "'.date('Y-m-d').'",1,0)'
      );
      $eventNews = $this->TradeshowEvent->find('all',array('conditions' => array('to_date > "'.date('Y-m-d').'"'), 'order' => array('from_date ASC'), 'limit' => $limit, 'page' => 1));

      $this->set('eventFinish',$eventFinish);
      $this->set('eventNews',$eventNews);

      $this->render('display');
    } catch (MissingViewException $e) {
      if (Configure::read('debug')) {
        throw $e;
      }
      throw new NotFoundException();
    }
  }

  public function index() {

  }

}

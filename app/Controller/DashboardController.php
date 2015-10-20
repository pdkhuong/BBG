<?php

class DashboardController extends AppController {

  /**
   * This controller does not use a model
   *
   * @var array
   */
  public $uses = array('Calendar','ProductOrder');

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
	define('TIMEZONE', 'Asia/Bangkok');
	date_default_timezone_set(TIMEZONE);
    $now = date("Y-m-d");
    $optionCalendar = array(
							'limit' => 10,
							'order' => array('from_date' => 'asc'),
							'conditions' => array('from_date >=' => $now)
							);
	 
	$calendar = $this->Calendar->find('all', $optionCalendar);
	foreach($calendar as $key =>$value){
		$calendar[$key]['Calendar']['from_date'] = $this->_formatDate($calendar[$key]['Calendar']['from_date'], 'd-m-Y H:i');
		$calendar[$key]['Calendar']['to_date'] = $this->_formatDate($calendar[$key]['Calendar']['to_date'], 'd-m-Y H:i');
	}
	
    $optionProductOrder = array(
							'limit' => 10,
							'order' => array('delivery_date' => 'asc'),
							'conditions' => array('delivery_date >=' => $now)
							);
	 
	$productOrder = $this->ProductOrder->find('all', $optionProductOrder);
	foreach($productOrder as $key =>$value){
		$productOrder[$key]['ProductOrder']['delivery_date'] = $this->_formatDate($productOrder[$key]['ProductOrder']['delivery_date'], 'd-m-Y');
	}
	
	$this->set('calendar', $calendar);
	$this->set('productOrder', $productOrder);
	//var_dump($productOrder);
  }

  public function index() {

  }
  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }

}

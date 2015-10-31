<?php

class DashboardController extends AppController {

  /**
   * This controller does not use a model
   *
   * @var array
   */
  public $uses = array('Calendar', 'CalendarUser', 'WorksSheet');

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
	$conditions = array('from_date >=' => $now);
	$isAdmin = $this->isAdmin();
	if(!$isAdmin){
      $currentUserId = $this->loggedUser->User->id;
      $conditions['user_id'] = $currentUserId;
    }
    $optionCalendar = array(
							'limit' => 10,
							'order' => array('from_date' => 'asc'),
							'conditions' => $conditions,
							'joins' => array(
									array('table' => 'calendar_user',
										  'alias' => 'CalendarUser',
										  'type' => 'INNER',
										  'conditions' => array(
												'Calendar.id = CalendarUser.calendar_id')
										)
									),
							'fields' => array('Calendar.*', 'CalendarUser.*'),
							'group' => 'Calendar.id',
							);
	 
	$calendar = $this->Calendar->find('all', $optionCalendar);
	foreach($calendar as $key =>$value){
		$calendar[$key]['Calendar']['from_date'] = $this->_formatDate($calendar[$key]['Calendar']['from_date'], 'd-m-Y H:i');
		$calendar[$key]['Calendar']['to_date'] = $this->_formatDate($calendar[$key]['Calendar']['to_date'], 'd-m-Y H:i');
	}
	
    $optionWorksSheet = array(
							'limit' => 10,
							'order' => array('delivery_date' => 'asc'),
							'conditions' => array('delivery_date >=' => $now)
							);
	 
	$WorksSheet = $this->WorksSheet->find('all', $optionWorksSheet);
	foreach($WorksSheet as $key =>$value){
		$WorksSheet[$key]['WorksSheet']['delivery_date'] = $this->_formatDate($WorksSheet[$key]['WorksSheet']['delivery_date'], 'd-m-Y');
	}
	
	$this->set('calendar', $calendar);
	$this->set('WorksSheet', $WorksSheet);
	//var_dump($productOrder);
  }

  public function index() {

  }
  private function _formatDate($date, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($date));
  }

}

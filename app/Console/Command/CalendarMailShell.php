<?php
	App::uses('CakeEmail', 'Network/Email');
	class CalendarMailShell extends AppShell{
		var $uses = array(
			'Calendar',
			'CalendarCustomer',
			'CalendarLead',
			'CalendarVendor',
			'CalendarUser',
		  );
		public function main(){
			define('TIMEZONE', 'Asia/Bangkok');
			date_default_timezone_set(TIMEZONE);
			$now = date("Y-m-d H:i:s");
			$tomorrow = date("Y-m-d H:i:s", time()+ EVENT_REMIDER_TIMER); 
			$optionCalendar = array(
							'order' => array('from_date' => 'asc'),
							'conditions' => array('from_date >=' => $now, 'to_date <=' => $tomorrow,)
							);			
			$events = $this->Calendar->find("all", $optionCalendar);
						
			foreach($events as $key => $event){
				$content["id"] = $event["Calendar"]["id"];
				$content["name"] = $event["Calendar"]["name"];
				$content["description"] = $event["Calendar"]["description"];
				$content["from_date"] = $this->_formatDate($events[$key]["Calendar"]["from_date"], "d-m-Y H:i");
				$content["to_date"] = $this->_formatDate($events[$key]["Calendar"]["to_date"], "d-m-Y H:i");
				
				$id = $event["Calendar"]["id"];
				$customers = $this->CalendarCustomer->findAllByCalendarId($id);
				$leads = $this->CalendarLead->findAllByCalendarId($id);
				$vendors = $this->CalendarVendor->findAllByCalendarId($id);
				$users = $this->CalendarUser->findAllByCalendarId($id);
				
				foreach($customers as $customer){
					$content["customers"][] = $customer["Customer"]["name"];
				}
				foreach($leads as $lead){
					$content["leads"][] = $lead["Lead"]["name"];
				}
				foreach($vendors as $vendor){
					$content["vendors"][] = $vendor["Vendor"]["name"];
				}
				foreach($users as $user){
					$content["users"][] = $user["User"]["display_name"];
				}
				foreach($users as $user){
					$content["receive_name"] = $user["User"]["display_name"];
					$Email = new CakeEmail('noreply');
					$noreplyConf = $Email->config();					
					$Email->template('calendar_remider');
					$Email->emailFormat('html');
					$Email->viewVars(array('emailContent' => $content));
					$Email->from($noreplyConf['from']);
					$Email->to($user["User"]["user_email"]);
					$Email->subject(__('Calendar Reminder'));					
					//var_dump($Email);exit;
					$Email->send();
				}
			}
			//echo EVENT_REMIDER_TIMER;
		}
		
		private function _formatDate($date, $format = 'Y-m-d H:i:s') {
			return date($format, strtotime($date));
		}
	}
?>
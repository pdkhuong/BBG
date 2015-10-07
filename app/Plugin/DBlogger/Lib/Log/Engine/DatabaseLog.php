<?php

App::uses('ClassRegistry', 'Utility');
App::uses('CakeLogInterface', 'Log');

class DatabaseLog implements CakeLogInterface {

  /**
   * Model name placeholder
   */
  var $model = null;

  /**
   * Model object placeholder
   */
  var $Log = null;

  /**
   * Contruct the model class
   */
  function __construct($options = array()) {
    $this->model = isset($options['model']) ? $options['model'] : 'DBlogger.LogModel';
    $this->Log = ClassRegistry::init($this->model);
  }

  public function write($type, $message) {
    $data = array();
    $data['ip'] = env('REMOTE_ADDR');
    $data['hostname'] = env('HTTP_HOST');
    $data['uri'] = env('REQUEST_URI');
    $data['refer'] = env('HTTP_REFERER');
    $data['type'] = $type;
    $data['message'] = $message;
    $data = $this->Log->addTimeToData($data);
    $data = $this->Log->addLoggedUserToData($data);
    $this->Log->save($data, array('callbacks' => false));
  }

}

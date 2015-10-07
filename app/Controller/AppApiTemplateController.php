<?php

App::uses('AppApiController', 'Controller');

class AppApiTemplateController extends AppApiController {

  var $uses = array(
    'AppTemplate.AppTemplateTheme'
  );

  public function data() {
    $json_response = $this->_getTemplateData();
    return $this->responseJson($json_response);
  }

  private function _getTemplateData() {
    $data = array();

    try {
      $options = array('fields' => array('json_data'), 'conditions' => array('activated' => '1'));
      $data = $this->AppTemplateTheme->find('first', $options);
    } catch (Exception $ex) {
      debug($ex);
    }

    if (!empty($data)) {
      $data = json_decode($data['AppTemplateTheme']['json_data']);
    }

    return $data;
  }

}

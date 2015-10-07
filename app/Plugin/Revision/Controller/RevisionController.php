<?php

App::uses('Revisions', 'Revision.Model');

class RevisionController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'Revisions';
  }

    public $helpers = array(
        'RevisionHelper'    => array(
            'className' => 'Revision'
        )
    );


  public function index($id = null) {
      $this->Paginator->settings = array(
          'limit' => 10,
          'order' => array('Revisions.created_time' => 'desc')
      );
      if ($this->request['url']) {
          $url = array();
          foreach ($this->request['url'] as $key=>$value){
              array_push($url, $key."=".$value);
          }
          $this->Session->write('currentUrl', $this->request->here."?".implode("&",$url));
          $this->Paginator->settings['conditions'] = $this->request['url'];
        $data = $this->Paginator->paginate("Revisions");
        $this->set('dataFirst', $this->Revisions->find("first", array('order'=>array('created_time'=>'desc'))));
        $this->set(array('dataList','flag'), array($data, 1));
      } elseif (intval($id)){
          $data = $this->Revisions->findById($id)['Revisions'];
          unset($data['id']);
          $this->Revisions->save($data);
          $this->redirect($this->Session->read('currentUrl'));
      } else {
          $data = $this->Paginator->paginate("Revisions");
          $this->set(array('dataList', 'flag'), array($data, 0));
      }
  }

}

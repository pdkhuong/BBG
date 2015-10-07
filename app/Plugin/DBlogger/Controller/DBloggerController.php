<?php

App::uses('LogModel', 'DBlogger.Model');

class DBloggerController extends AppController {

      public function beforeFilter() {
        parent::beforeFilter();
        $this->modelClass = 'LogModel';
      }

      public function index(    ) {
        if($this->request['url']) {
            $conditions = array();
            if(!empty($this->request['url']['user_id']) and intval($this->request['url']['user_id'])) {
                $conditions["user_id"] = intval($this->request['url']['user_id']);
            }
            if(!empty($this->request['url']['message'])){
                $conditions["message LIKE"] = "%{$this->request['url']['message']}%";
            }
            if(!empty($this->request['url']['type'])){
                $conditions["type"] = $this->request['url']['type'];
            }
            $this->Paginator->settings = array(
                'conditions'    => $conditions,
                'limit'         => 10,
                'order'         => array('LogModel.id' => 'desc')
            );
            $dataList = $this->Paginator->paginate('LogModel');
            $this->set('dataList', $dataList);
        } else {
            $this->Paginator->settings = array(
                'limit'         => 10,
                'order'         => array('LogModel.id' => 'desc')
            );
            $dataList = $this->Paginator->paginate('LogModel');
            $this->set('dataList', $dataList);
        }

      }

      public function detail($id) {
        $this->set('logs', $this->LogModel->findById($id));
      }

      public function keep($row) {
        $row = intval($row);
        $this->LogModel->query("TRUNCATE TABLE logs_tmp");
        $this->LogModel->query("INSERT INTO logs_tmp (id) SELECT id FROM logs ORDER BY created_time DESC LIMIT $row");
        $this->LogModel->query("DELETE FROM logs WHERE id NOT IN (SELECT id FROM logs_tmp)");
        $this->redirect(Router::url(array('plugin' => 'DBlogger', 'controller' => 'DBlogger', 'action' => 'index')));
      }

}

<?php

class RequestLogController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'RequestLogModel';
  }

  public function index() {
//    load all plugins
    $loaded_plugins = CakePlugin::loaded();
    $this->set('plugins', array_combine(array_values($loaded_plugins), $loaded_plugins));

    $this->Paginator->settings = array(
      'limit' => 10,
      'order' => array('RequestLogModel.id' => 'desc')
    );
    if ($this->request['url']) {
      $this->request->data['RequestLogModel'] = $this->request->query;
      $this->RequestLogModel->set($this->request->data);
      $conditions = array();
      foreach ($this->request['url'] as $key => $temp) {
        if (!empty($temp) and ( $key == "plugin")) {
          $conditions[$key] = $temp;
        } elseif (!empty($temp) and intval($temp)) {
          $conditions[$key] = intval($temp);
        } elseif (!empty($temp)) {
          $conditions[$key . " LIKE "] = "%$temp%";
        }
      }
      $this->Paginator->settings = array(
        'conditions' => $conditions,
        'limit' => 10,
        'order' => array('RequestLogModel.id' => 'desc')
      );
    }
    $dataList = $this->Paginator->paginate('RequestLogModel');
    $this->set('dataList', $dataList);
  }

  public function detail($id = null) {
    $this->autoRender = false;
    $data = $this->RequestLogModel->findById($id);
    $this->set('data', $data);

    $this->render();
    return $this->response;
  }

  public function keep($row) {
    $row = intval($row);
    $this->RequestLogModel->query("TRUNCATE TABLE request_log_tmp");
    $this->RequestLogModel->query("INSERT INTO request_log_tmp (id) SELECT id FROM request_log ORDER BY created_time DESC LIMIT $row");
    $this->RequestLogModel->query("DELETE FROM request_log WHERE id NOT IN (SELECT id FROM request_log_tmp)");
    $this->redirect(Router::url(array('plugin' => 'RequestLog', 'controller' => 'RequestLog', 'action' => 'index')));
  }

  public function config() {
    if ($this->request->isAjax()) {
      $output = array(
        'status' => true,
        'messages' => 'Data saved!!!'
      );

      if (!empty($this->request->data)) {
        $data = $this->request->data;

        $rl_configs = array(
          'config' => isset($data['Config']) ? $data['Config'] : array(),
          'system' => array(
          ),
          'plugins' => array(
          )
        );

        if (isset($data['Plugin'])) {
          foreach ($data['Plugin'] as $rl_pid => $plugin) {
            if (empty($plugin)) {
              continue;
            }
            if (!isset($rl_configs['plugins'][$plugin])) {
              $rl_configs['plugins'][$plugin] = array();
            }
            if (isset($data['Controller'][$rl_pid])) {
              $controller = $data['Controller'][$rl_pid];
              if (!isset($rl_configs['plugins'][$plugin][$controller])) {
                $rl_configs['plugins'][$plugin][$controller] = array();
              }
              if (isset($data['Actions'][$rl_pid]) && !empty($data['Actions'][$rl_pid])) {
                $actions = explode(',', $data['Actions'][$rl_pid]);
                $action_list = array();
                foreach ($actions as $action) {
                  if (!in_array($action, $action_list)) {
                    array_push($action_list, $action);
                  }
                }
                $rl_configs['plugins'][$plugin][$controller] = array_values($action_list);
              }
              unset($data['Controller'][$rl_pid]);
            }
          }
        }

        if (isset($data['Controller'])) {
          foreach ($data['Controller'] as $rl_cid => $controller) {
            if (!isset($rl_configs['system'][$controller])) {
              $rl_configs['system'][$controller] = array();
            }
            if (isset($data['Actions'][$rl_cid]) && !empty($data['Actions'][$rl_cid])) {
              $actions = explode(',', $data['Actions'][$rl_cid]);
              $action_list = array();
              foreach ($actions as $action) {
                if (!in_array($action, $action_list)) {
                  array_push($action_list, $action);
                }
              }
              $rl_configs['system'][$controller] = array_values($action_list);
            }
          }
        }

        if (!@ file_put_contents(WWW_ROOT . REQUEST_LOG_FILENAME, serialize($rl_configs))) {
          $output['status'] = false;
          $output['messages'] = 'Can not create the configuration file';
        }

        $output['configs'] = $rl_configs;
        $output['data'] = $data;
      }

      $this->response->body(json_encode($output));
      return $this->response;
    } else {
      $js = array();
      $js['controllers'] = $this->_getControllers();

      $rl_configs = array();
      if (is_file(WWW_ROOT . REQUEST_LOG_FILENAME)) {
        $config_content = file_get_contents(WWW_ROOT . REQUEST_LOG_FILENAME);
        $js['rl_configs'] = unserialize($config_content);
      }

      if (is_array(Configure::read('Js'))) {
        $js = Hash::merge($js, Configure::read('Js'));
      }

      Configure::write('Js', $js);
    }
  }

  private function _getControllers() {
    $output = array(
      'system' => array(),
      'plugins' => array()
    );
    $aCtrlClasses = App::objects('controller');
    $system_controllers = array();
    foreach ($aCtrlClasses as $controller) {
      if ($controller != 'AppController') {
        // Load the controller
        App::import('Controller', str_replace('Controller', '', $controller));

        // Load its methods / actions
        $aMethods = get_class_methods($controller);


        foreach ($aMethods as $idx => $method) {

          if ($method{0} == '_') {
            unset($aMethods[$idx]);
          }
        }

        // Load the ApplicationController (if there is one)
        App::import('Controller', 'AppController');
        $parentActions = get_class_methods('AppController');

        $system_controllers[$controller] = array_diff($aMethods, $parentActions);
      }
    }
    $output['system'] = $system_controllers;


    $plugins = CakePlugin:: loaded();
    foreach ($plugins as $plugin) {
      $aCtrlClasses = App::objects("{$plugin}.controller");
      $plugin_controllers = array();
      foreach ($aCtrlClasses as $controller) {
        if ($controller != "{$plugin}AppController") {
          // Load the controller
          $real_controller = "{$plugin}.$controller";
          App::import('Controller', str_replace('Controller', '', $real_controller));

          // Load its methods / actions
          $aMethods = get_class_methods($controller);
          foreach ($aMethods as $idx => $method) {
            if ($method{0} == '_') {
              unset($aMethods[$idx]);
            }
          }

          // Load the ApplicationController (if there is one)
          App::import('Controller', "{$plugin}.{$plugin}AppController");
          $parentActions = get_class_methods("{$plugin}AppController");
          if (is_null($parentActions)) {
            $parentActions = get_class_methods("AppController");
          }

          $plugin_controllers[$controller] = array_diff($aMethods, $parentActions);
        }
      }
      $output['plugins'][$plugin] = $plugin_controllers;
    }
    return $output;
  }

}

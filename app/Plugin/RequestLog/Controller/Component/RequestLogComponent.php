<?php

App::uses('Component', 'Controller');

class RequestLogComponent extends Component {

  public function initialize(Controller $controller) {
    $flag = true;
    if (!REQUEST_LOG_FULL) {

//      $classController = get_class($controller);
      /* Verify exclude controller */
//      $accController = null;
//      $userExcludeController = Configure::read('REQUEST_LOG_EXCLUDE_CONTROLLER');
//      if (!empty($controller->plugin)) {
//        if (isset($userExcludeController['plugin'][$controller->plugin])) {
//          $accPlugin = $userExcludeController['plugin'][$controller->plugin];
//          if (count($accPlugin) == 0) {
//            return true;
//          }
//          if (isset($accPlugin[$classController])) {
//            $accController = $accPlugin[$classController];
//          }
//        }
//      } else {
//        if (isset($userExcludeController['controller'][$classController])) {
//          $accController = $userExcludeController['controller'][$classController];
//        }
//      }
//
//      if (!is_null($accController)) {
//        if (count($accController) == 0) {
//          return true;
//        }
//        if (isset($accController[$controller->action])) {
//          return true;
//        }
//      }
      /* End of Verify exclude controller */
      $params = $controller->params;
      $params['controller'] = $params['controller'] . 'Controller';
      $requestLogConfigs = array();
      $logfile = WWW_ROOT . REQUEST_LOG_FILENAME;

      if (is_file($logfile)) {
        $config_content = file_get_contents(WWW_ROOT . REQUEST_LOG_FILENAME);
        $requestLogConfigs = unserialize($config_content);
        if (!empty($params['plugin'])) {
          $plugins = $requestLogConfigs['plugins'];

          if (isset($plugins[$params['plugin']])) {
            if (count($plugins[$params['plugin']]) > 0) {
              $controllers = $plugins[$params['plugin']];
              if (isset($controllers[$params['controller']])) {
                if (count($controllers[$params['controller']]) > 0) {
                  $actions = $controllers[$params['controller']];

                  if (!in_array($params['action'], $actions)) {
                    $flag = false;
                  }
                }
              } else {
                $flag = false;
              }
            }
          } else {
            $flag = false;
          }
        } else {
          $controllers = $requestLogConfigs['system'];
          if (isset($controllers[$params['controller']])) {
            if (count($controllers[$params['controller']]) > 0) {
              $actions = $controllers[$params['controller']];
              if (!in_array($params['action'], $actions)) {
                $flag = false;
              }
            }
          } else {
            $flag = false;
          }
        }
      }
    }

    if ($flag) {
      $rl_configs = array();
      if (is_file(WWW_ROOT . REQUEST_LOG_FILENAME)) {
        $config_content = file_get_contents(WWW_ROOT . REQUEST_LOG_FILENAME);
        $rl_configs = unserialize($config_content);
      }

      App::uses('RequestLogModel', 'RequestLog.Model');
      $requestLog = new RequestLogModel();

      $input = file_get_contents('php://input');

      $data = array();
      $data['ip'] = env('REMOTE_ADDR');
      $data['hostname'] = env('HTTP_HOST');
      $data['uri'] = env('REQUEST_URI');
      $data['refer'] = env('HTTP_REFERER');
      $data['plugin'] = $controller->plugin;
      $data['controller'] = get_class($controller);
      $data['action'] = $controller->action;
      if (isset($rl_configs['config']['get_data']) && $rl_configs['config']['get_data'] == 1) {
        $data['get_data'] = empty($controller->request->query) ? null : json_encode($controller->request->query);
      }
      if (isset($rl_configs['config']['post_data']) && $rl_configs['config']['post_data'] == 1) {
        $data['post_data'] = empty($controller->request->data) ? null : json_encode($controller->request->data);
      }
      if (isset($rl_configs['config']['raw_data']) && $rl_configs['config']['raw_data'] == 1) {
        $data['raw_data'] = empty($input) ? null : $input;
      }
      if (isset($rl_configs['config']['file_data']) && $rl_configs['config']['file_data'] == 1) {
        $data['file_data'] = empty($_FILES) ? null : json_encode($_FILES);
      }
      if (isset($rl_configs['config']['server_data']) && $rl_configs['config']['server_data'] == 1) {
        $data['server_data'] = json_encode($_SERVER);
      }
      $data = $requestLog->addTimeToData($data);
      $data = $requestLog->addLoggedUserToData($data);

      $requestLog->save($data, array('callbacks' => false));
    }
  }

}

<?php

App::uses('FileLib', 'File.Lib');
App::uses('UploadHandler', 'File.Lib');
App::uses('UtilLib', 'Lib');

class FileController extends AppController {

  var $uses = array('File.File', 'File.FileModel', 'MultilanguageFileModel', 'File.FileCategory', 'File.FileCategoryFile');
  public $components = array('Paginator');
  private $_defaultParams = array(
    'id'=>'',
    'categoryCode' => '',
    'selectedItemViewType' => 'thumbnail',
    'listItemViewType' => 'thumbnail',
    'limitFileNumber' => 100,
    'limitFileSize' => 100,
    'extensions' => array('pdf', 'jpg', 'png', 'gif'),
    'filterName' => '',
    'jsCallback' => '',
    'lang' => '',
    'inputName' => FALSE,
    'inputDesc' => FALSE,
    'inputOrder' => FALSE,
    'isMultiLang' => FALSE,
    'canUpload' => FALSE,
    'selectedFiles' => '',
  );

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'File';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  private function _parseParams($params) {
    $params = array_merge($this->_defaultParams, $params);
    foreach ($params as $key => $value) {
      if (is_bool($value)) {
        $params[$key] = $value ? 1 : 0;
      }
      if(!isset($params['id']) || !$params['id']){
        $params['id'] = md5(time()).rand(0, 999);
      }
    }
    return $params;
  }

  public function list_files() {
    $params = $this->_parseParams($this->params['url']);
    $files = $this->_listFiles($params['extensions'], $params['selectedFiles'], $params['limitFileSize'], $params['filterName']);
    $this->set('files', $files);
    $this->set('params', $params);
    $listViewTemplate = FileLib::getFormTemplate($params['listItemViewType'], 'list');
    $itemInListTemplate = FileLib::getFormTemplate($params['listItemViewType'], 'item');
    $this->set("itemInListTemplate", $itemInListTemplate);
    $this->view = $listViewTemplate;
    //add debug
    $this->_debug($this->params);
    $this->_debug($params);
    $this->_debug($files);
    $stringQuery = $this->File->getDataSource()->getLog(false, false);
    $this->_debug($stringQuery);
    
  }

  public function filter_files() {
    //$params = $this->params['data'] ? $this->params['data'] : $this->params['url'];
    $params = $this->_parseParams($this->params['url']);
    $files = $this->_listFiles($params['extensions'], $params['selectedFiles'], $params['limitFileSize'], $params['filterName']);
    $this->set('files', $files);
    $this->set('params', $params);
    $listViewTemplate = FileLib::getFormTemplate($params['listItemViewType'], 'filter');
    $itemInListTemplate = FileLib::getFormTemplate($params['listItemViewType'], 'item');
    $this->set("itemInListTemplate", $itemInListTemplate);
    $view = new View($this);
    $html = $view->render($listViewTemplate);
    $pageCount = isset($this->params['paging']['File']['pageCount']) ? intval($this->params['paging']['File']['pageCount']) : 1;
    $this->responseJson(array('status' => 200, 'html' => $html, 'pageCount' => $pageCount, 'listViewTemplate' => $listViewTemplate));
    //add debug
    
    $this->_debug($this->params);
    $this->_debug($params);
    $this->_debug($files);
    $stringQuery = $this->File->getDataSource()->getLog(false, false);
    $this->_debug($stringQuery);
    
    
  }
  private function _debug($out) {
    if (isset($_GET['debug'])) {
      echo "<pre>";
      print_r($out);
      echo "<br>";
    }
  }
  public function get_element() {
    $params = $this->_parseParams($this->data['File']);
    $fileId = intval($params['fileId']);
    $file = $this->File->findById($fileId);
    $file = $file['File'];
    $this->set('file', $file);
    $this->set('params', $params);
    $this->set("readOnly", TRUE);
    $this->set('selectedFileLangs', array());
    $view = new View($this);
    $selectedItemTemplate = FileLib::getFormTemplate($params['selectedItemViewType'], 'item', $params['lang']);
    $html = $view->element('File.' . $selectedItemTemplate);
    return $this->responseJson(array('status' => 200, 'html' => $html));
  }

  private function _listFiles($extensions, $selectedFiles, $limitFileSize, $filterFilename, $enablePaging = TRUE) {
    if (count($selectedFiles) == 1 && empty($selectedFiles[0])) {
      $selectedFiles = array();
    }
    if (empty($extensions)) {
      return array();
    }
    $conditions = array(
      'File.size <=' => $limitFileSize * 1024 * 1024,
      'File.file_type' => $extensions,
    );
    if (!empty($filterFilename)) {
      $conditions['File.filename LIKE ? '] = '%' . UtilLib::mysqlEscapeString($filterFilename) . '%';
    }
    if (!empty($selectedFiles)) {
      $conditions['NOT'] = array(
        'File.id' => $selectedFiles
      );
    }

    if (!$enablePaging) {
      $files = $this->File->find('all', array(
        'conditions' => $conditions,
        'order' => array(
          'File.filename' => 'ASC'
        ),
      ));

      return $files;
    }

    $this->Paginator->settings = array(
      'conditions' => $conditions,
      'order' => array(
        'File.filename' => 'ASC'
      ),
      'limit' => Configure::read('AMU.limit_paging_choose_file'),
    );
    try {
      $files = $this->Paginator->paginate('File');
    } catch (NotFoundException $e) {
      $files = array();
    }

    return $files;
  }

  public function manage() {
    $filter_string = @$this->params['url']['filter_string'];
    $order_by = @$this->params['url']['order_by'];
    $order_type = @$this->params['url']['order_type'];

    $order_by = strtolower($order_by);
    $order_type = strtolower($order_type);
    $order_type = ($order_type == "desc" ? "desc" : "asc");

    $file_schema = $this->File->schema();

    $order_configs = array();
    if (isset($file_schema[$order_by])) {
      $order_configs['File.' . $order_by] = $order_type;
    } else {
      $order_by = 'updated_time';
      $order_type = 'desc';
      $order_configs['File.updated_time'] = $order_type;
    }

    try {
      if (!empty($filter_string)) {
        $this->Paginator->settings = array(
          'conditions' => array(
            'OR' => array(
              'File.name LIKE ? ' => '%' . UtilLib::mysqlEscapeString($filter_string) . '%',
              'File.filename LIKE ? ' => '%' . UtilLib::mysqlEscapeString($filter_string) . '%',
              'File.file_type LIKE ? ' => '%' . UtilLib::mysqlEscapeString($filter_string) . '%',
            )
          ),
          'order' => $order_configs,
          'limit' => Configure::read('AMU.limit_paging'),
          'filter_string' => $filter_string,
        );
      } else {
        $this->Paginator->settings = array(
          'order' => $order_configs,
          'limit' => Configure::read('AMU.limit_paging'),
        );
      }
      $this->Paginator->settings['order_by'] = $order_by;
      $this->Paginator->settings['order_type'] = $order_type;

      $files = $this->Paginator->paginate('File');
    } catch (NotFoundException $e) {
      $files = array();
    }
    $this->set('order_by', $order_by);
    $this->set('order_type', $order_type);
    $this->set('filter_string', $filter_string);
    $this->set('files', $files);
  }

  /**
   * Delete one file by id
   * @param $file_id
   */
  public function destroy($file_id) {
    $file_record = $this->File->findById($file_id);
    if (empty($file_record)) {
      $this->Session->setFlash(__('File parameter is missing'), 'flash/error');
      $this->redirect($this->referer());
    }
    $result = $this->File->deleteFile($file_record);
    //show messages
    foreach ($result['errors'] as $message) {
      $this->Session->setFlash(__($message), 'flash/error');
    }
    foreach ($result['messages'] as $message) {
      $this->Session->setFlash(__($message), 'flash/success');
    }
    $this->redirect($this->referer());
  }

  public function edit($id = 0) {
    $this->set('title', __('Edit File'));

    if (empty($this->request->data)) {
      $this->request->data = $this->File->findById($id);
    } else {
      $this->File->set($this->request->data);
      if ($this->File->validates()) {
        if (!$this->File->save()) {
          $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
        } else {
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('plugin' => 'File', 'controller' => 'File', 'action' => 'view')) . '/' . $this->File->id);
        }
      }
    }
  }
  public function ajax_upload() {
    $upload_file = (isset($_FILES['qqfile']) ? $_FILES['qqfile'] : NULL);

    $allowed_extensions_server_setting = FileLib::getAllowedExtensionsFile(NULL, NULL);
    $allowed_extensions_request = @$this->params['url']['allowed_extensions'];
    if (empty($allowed_extensions_request)) {
      $allowed_extensions_request = array();
    }
    $allowed_extensions = array_intersect($allowed_extensions_server_setting, $allowed_extensions_request);

    $limit_size = @$this->params['url']['limit_size'];
    $limit_size = intval($limit_size) * 1024 * 1024;
    $limit_size_server_setting = FileLib::getLimitFileSize(NULL, NULL);
    $limit_size = ($limit_size > $limit_size_server_setting ? $limit_size_server_setting : $limit_size);

    $uploader = new UploadHandler($allowed_extensions, $limit_size, $upload_file);
    $result = $uploader->checkSetting();
    if (!empty($result)) {
      $result['error'] = __($result['error']);
      return $this->responseJson($result);
    }

    $result = $uploader->handleUpload(NULL, NULL);

    if (isset($result['success']) && $result['success'] == TRUE) {
      $this->File->create();
      $file_id = $this->File->saveUploadFile($result['values']);
      if (empty($file_id)) {
        $result = array(
          'success' => FALSE,
          'error' => __('Failed upload'),
        );
        return $this->responseJson($result);
      } else {
        $file = $this->File->findById($file_id);
        $result['values']['fileURL'] = FileLib::getUrlFile($file['File']['path']);
        $result['values']['fileid'] = $file_id;
        unset($result['values']['file_path']);
      }
    } else {
      $result['error'] = __($result['error']);
    }

    return $this->responseJson($result);
  }
}

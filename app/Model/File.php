<?php

App::uses('AppModel', 'Model');

class File extends AppModel {

  var $useTable = 'file';
  var $multiLanguage = array ();

  public $belongsTo = array (
  );

  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'name' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 200,
        ),
        'message' => 'Please enter a text no larger than 200 characters long',
        'allowEmpty' => true,
      )
    ),
    'description' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => true,
      )
    ),
    'original_filename' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    ),
    'file_path' => array(
      'size' => array(
        'rule' => array(
          0 => 'maxLength',
          1 => 255,
        ),
        'message' => 'Please enter a text no larger than 255 characters long',
        'allowEmpty' => false,
      )
    ),
  );
  function uploadFile($fileObj, $dirUpload=UPLOAD_BASE_DIR, $require = true){
    $data = array();
    if($fileObj){
      $allowExtension = Configure::read("UPLOAD_EXTENSION");
      $fileName = uniqid() . '_' . time();
      if ($fileObj["error"] > 0) {
        if ($fileObj["error"] == 1) {
          $data['error'] = 1;
          $data['message'] = __('File too big');
        }elseif ($require && $fileObj["error"] == 4) {
          $data['error'] = 4;
          $data['message'] = __('Please upload file');
        }
      } else {
        $extension = substr($fileObj["name"], strrpos($fileObj["name"], '.')+1);
        $extension = strtolower($extension);
        if(in_array($extension, $allowExtension)){
          $uploadFile = $dirUpload . '/' . $fileName . '.' . $extension;
          if (!file_exists($dirUpload)) {
            mkdirs($dirUpload);
          }
          if (move_uploaded_file($fileObj["tmp_name"], $uploadFile)) {
            $data['error'] = 0;
            $data['file_path'] = $uploadFile;
            $data['original_filename'] = $fileObj['name'];
            $data['name'] = str_replace('.'.$extension,'',$fileObj['name']);
            $data['message'] = "";
          }else{
            $data['error'] = 9;
            $data['message'] = __('Cannot upload');
          }
        }else{
          $data['error'] = 10;
          $data['message'] = __('File not allow to upload. Supported file type ('. implode(",", $allowExtension).')');
        }

      }
    }
    return $data;
  }
  function deletePhysicalFile($fileId){
    $fileDb = $this->findById($fileId);
    if($fileDb && file_exists($fileDb['File']['file_path']) && is_file($fileDb['File']['file_path'])){
      unlink($fileDb['File']['file_path']);
    }
  }
  function mkdirs($dir, $mode = 0777, $recursive = true) {
    if (is_null($dir) || $dir === "") {
      return FALSE;
    }
    if (is_dir($dir) || $dir === "/") {
      return TRUE;
    }
    if (mkdirs(dirname($dir), $mode, $recursive)) {
      return mkdir($dir, $mode);
    }
    return FALSE;
  }
}

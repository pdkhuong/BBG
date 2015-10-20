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
  function getFileExtension($mimeType){
    $allowExtension = Configure::read("UPLOAD_EXTENSION");
    $extension = '';
    foreach($allowExtension as $ext){
      if($ext['mime'] == $mimeType){
        $extension = $ext['ext'];
      }
    }
    return $extension;
  }
  function uploadFile($fileObj, $dirUpload=UPLOAD_BASE_DIR){
    $data = array();
    if($fileObj){
      $fileName = uniqid() . '_' . time();
      if ($fileObj["error"] > 0) {
        if ($fileObj["error"] == 1) {
          $data['error'] = 1;
          $data['message'] = __('File too big');
        }elseif ($fileObj["error"] == 4) {
          $data['error'] = 4;
          $data['message'] = __('Please upload file');
        }
      } else {
        $mimeType = mime_content_type($fileObj["tmp_name"]);
        $extension = $this->getFileExtension($mimeType);
        if($extension){
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
          $data['message'] = __('Fine not allow to upload');
        }

      }
    }
    return $data;
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

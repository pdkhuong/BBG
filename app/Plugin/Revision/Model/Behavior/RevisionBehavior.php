<?php

/**
 * Revision behavior
 *
 * @package Revision
 * @subpackage Revision.models.behaviors
 */
App::uses('Revisions', 'Revision.Model');

class RevisionBehavior extends ModelBehavior {

  /**
   * Settings array
   *
   * @var array
   */
  public $settings = array();
  public $dataModel = array();
  public $dataLanguage = array();

  /**
   * Setup the behavior
   *
   * @param Model $Model
   * @param array $settings
   * @return void
   */
  function setup(Model $model, $config = array()) {

  }

  public function beforeFind(Model $Model, $query) {
    return $query;
  }

  public function afterFind(Model $Model, $results, $primary = false) {
    return $results;
  }

  public function beforeValidate(\Model $model, $options = array()) {
    parent::beforeValidate($model, $options);
    return true;
  }

  public function afterValidate(\Model $model) {
    parent::afterValidate($model);
  }

  public function beforeSave(\Model $model, $options = array()) {
    if($model->getID() > 0) {
      $data = $model->find('all', array('recursive' => -1, 'multiLanguageIsUsed' => false, 'conditions' => array(get_class($model) . '.id = ' . $model->getID())));
      if(isset($data[0][get_class($model)])) {
        $this->dataModel = $data[0][get_class($model)];
      }

      if(isset($model->multiLanguage['columns']) && count($model->multiLanguage['columns']) > 0) {
        App::uses('MultiLanguageModel','MultiLanguage.Model');
        $multiLanguage = new MultiLanguageModel();
        $multiLanguage->setMainModel($model);
        $this->dataLanguage = $multiLanguage->getData($model->getID());
      }
    }
    parent::beforeSave($model, $options);
    return true;
  }

  public function afterSave(\Model $model, $created, $options = array()) {
    parent::afterSave($model, $created, $options);

    if(!isset($model->data)) {
      return true;
    }

    $diffData = array();
    $diffLanguage = array();

    foreach($this->dataModel as $key => $val) {
      if(in_array($key,$model->getReservedColumns()) || !isset($model->data[get_class($model)][$key])) {
        continue;
      }

      if($val != $model->data[get_class($model)][$key]) {
        $diffData[$key]['old'] = $val;
        $diffData[$key]['new'] = $model->data[get_class($model)][$key];
      }
    }

    if(isset($model->multiLanguage['columns']) && count($model->multiLanguage['columns']) > 0) {
      App::uses('MultiLanguageModel','MultiLanguage.Model');
      $multiLanguage = new MultiLanguageModel();
      $multiLanguage->setMainModel($model);
      $dataLanguage = $multiLanguage->getData($model->getID());

      if(!isset($dataLanguage['data'])) {
        $dataLanguage['data'] = array();
      }
      if(!isset($this->dataLanguage['data'])) {
        $this->dataLanguage['data'] = array();
      }

      foreach($this->dataLanguage['data'] as $column => $data) {
        foreach ($data as $lang => $val) {
          if(isset($dataLanguage['data'][$column][$lang]) && $dataLanguage['data'][$column][$lang] != $val) {
            $diffLanguage[$column][$lang]['old'] = $val;
            $diffLanguage[$column][$lang]['new'] = $dataLanguage['data'][$column][$lang];
          }
        }
      }
    }

    if(count($diffData) > 0 || count($diffLanguage) > 0) {
      App::uses('Revisions','Revision.Model');
      $revision = new Revisions();

      $data = array();
      $data['object_id'] = $model->getID();
      $data['model'] = is_null($model->plugin) ? '' : $model->plugin.'.';
      $data['model'] .= $model->name;
      $data['data'] = json_encode($model->data[get_class($model)]);
      if(isset($this->dataLanguage['data'])) {
        $data['multilanguage'] = json_encode($this->dataLanguage['data']);
      }
      if(count($diffData) > 0) {
        $data['diff_data'] = json_encode($diffData);
      }
      if(count($diffLanguage) > 0) {
        $data['diff_multilanguage'] = json_encode($diffLanguage);
      }
      $data = $revision->addTimeToData($data);
      $data = $revision->addLoggedUserToData($data);
      $revision->save($data, array('validate' => false, 'callbacks' => false));
    }

  }

  public function beforeDelete(\Model $model, $cascade = true) {
    parent::beforeDelete($model);
    return true;
  }

  public function afterDelete(\Model $model) {
    parent::afterDelete($model);
  }

  public function onError(\Model $model, $error) {
    parent::onError($model, $error);
  }

}

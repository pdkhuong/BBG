<?php

/**
 * MultiLanguage Controller
 *
 * @package MultiLanguage
 * @subpackage MultiLanguage.controllers
 */
App::uses('MultiLanguageModel', 'MultiLanguage.Model');

class MultiLanguageController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'MultiLanguageModel';
  }

  /**
   * Change the language
   *
   * @param string $lang
   * @return void
   */
  public function change($lang) {
    $list = Configure::read('MultiLanguage.list');
    $fallback = Configure::read('MultiLanguage.fallback');
    if(isset($list[$lang]) || isset($fallback[$lang])) {
      $this->Session->write('Config.language', $lang);
    }
    return $this->redirect($this->referer());
  }

  public function deleteImage($path, $lang) {
    $path = base64_decode($path);
    $file = Configure::read('MultiLanguage.directory') . DS . $lang . DS . $path;
    if (is_file($file)) {
      unlink($file);
    }
    die;
  }

  public function updateCMS($selectedLang = 'eng', $keyword_dt = '') {
    $this->MultiLanguageModel->useTable = false;

    $languages = $this->getCMSLanguages(false, array($selectedLang));

    if (!empty($this->request->data)) {
      foreach ($this->request->data['languagesEdited'] as $lang => $data) {
        $file = ROOT . '/app/Locale/' . $lang . '/LC_MESSAGES/default.po';
        $str = '';
        foreach ($data as $key => $val) {
          $key = base64_decode($key);
          $val = trim($val);
          $str .= "msgid   \"$key\"\nmsgstr  \"$val\"\n\n";
        }
        file_put_contents($file, $str);
      }
      $keyword_dt = isset($this->request->data['MultiLanguageModel']['keyword_dt']) ? $this->request->data['MultiLanguageModel']['keyword_dt'] : "";

      $this->Session->setFlash(__('CMS translation was saved successfully'), 'flash/success');
      return $this->redirect(Router::url(array('plugin' => 'MultiLanguage', 'controller' => 'MultiLanguage', 'action' => 'updateCms', $selectedLang, $keyword_dt)));
    }

    $this->set('keyword_dt', $keyword_dt);
    $this->set('languages', $languages);
    $this->set('selectedLang', $selectedLang);
  }

  public function exportCMS() {
    $list = array_merge(Configure::read('MultiLanguage.fallback'), Configure::read('MultiLanguage.list'));
    App::uses('ExcelLib', 'Lib');
    $excel = new ExcelLib();
    $excel->init();

    $data = array();

    //save
    $mapping = array();
    foreach (Configure::read('MultiLanguage.app_mapping_list') as $key => $val) {
      $mapping[$val] = strtoupper($key);
    }

    $header[] = 'Key';
    foreach (array_keys($list) as $lang) {
      $header[] = $mapping[$lang];
    }
    $data[] = $header;

    $languages = $this->getCMSLanguages();

    foreach ($languages as $key => $language) {
      $row = array();
      $row[] = $key;
      foreach ($language as $val) {
        $row[] = $val;
      }
      $data[] = $row;
    }

    $excel->writeFromArray($data);
    $excel->send2Browser(array('filename' => sprintf("cms-translation-%s.xls", date("Ymd", time()))));
  }

  public function importCms() {
    $this->MultiLanguageModel->useTable = false;
    $listLanguage = array_keys(array_merge(Configure::read('MultiLanguage.fallback'), Configure::read('MultiLanguage.list')));
    $msgError = '';

    if (isset($this->request->params['form']['MultilanguageImportCms'])) {
      if (isset($this->request->params['form']['MultilanguageImportCms']['tmp_name']) && is_file($this->request->params['form']['MultilanguageImportCms']['tmp_name'])) {
        if (($handle = fopen($this->request->params['form']['MultilanguageImportCms']['tmp_name'], "r")) !== FALSE) {
          App::uses('ExcelLib', 'Lib');
          $excel = new ExcelLib();
          $excel->initFromFile($this->request->params['form']['MultilanguageImportCms']['tmp_name']);
          $listData = $excel->getAllRowsCurrentSheet();
          if (count($listData) > 0) {

            $mapping = Configure::read('MultiLanguage.app_mapping_list');
            for ($ii = 1; $ii < count($listData[0]); $ii++) {
              $listData[0][$ii] = isset($mapping[strtolower($listData[0][$ii])]) ? $mapping[strtolower($listData[0][$ii])] : $listData[0][$ii];
            }

            $data = $listData[0];
            if ($data[0] != 'Key' || count(array_intersect($listLanguage, $data)) != count($listLanguage)) {
              $msgError = __('The header of Excel file shoud be in format') . ': Key';
              foreach ($listLanguage as $lang) {
                $msgError .= ', ' . $lang;
              }
            } else {
              $listLanguage = $data;
              $listKey = $this->getCMSLanguages(true);
              $numField = count($listLanguage);

              for ($row = 1; $row < count($listData); $row++) {
                $data = $listData[$row];
                $num = count($data);
                if ($num != $numField || !isset($listKey[$data[0]])) {
                  $msgError .= __('Cannot import line %s', $row) . "<br />";
                } else {
                  for ($c = 1; $c < $num; $c++) {
                    $listKey[$data[0]][$listLanguage[$c]] = $data[$c];
                  }
                }
              }

              $dataSave = array();
              foreach ($listKey as $key => $translates) {
                foreach ($translates as $lang => $text) {
                  $dataSave[$lang][$key] = trim($text);
                }
              }

              foreach ($dataSave as $lang => $data) {
                $file = ROOT . '/app/Locale/' . $lang . '/LC_MESSAGES/default.po';
                $str = '';
                foreach ($data as $key => $val) {
                  $str .= "msgid   \"$key\"\nmsgstr  \"$val\"\n\n";
                }
                file_put_contents($file, $str);
              }
            }
            fclose($handle);
          }
        } else {
          $msgError = __('Cannot open the uploaded file');
        }
      } else {
        $msgError = __('Cannot open the uploaded file');
      }

      if (empty($msgError)) {
        $this->Session->setFlash(__('Import successfully'), 'flash/success');
        $this->redirect(array('plugin' => 'MultiLanguage', 'controller' => 'MultiLanguage', 'action' => 'updateCms'));
      } else {
        $this->Session->setFlash($msgError, 'flash/error');
      }
    }
  }

  private function getCMSLanguages($emptyDefault = false, $selectedLang = array()) {
    $languages = array();
    $listLanguage = array_keys(Configure::read('MultiLanguage.fallback') + Configure::read('MultiLanguage.list'));

    $root = ROOT . '/app/Locale/';
    $str = file_get_contents($root . 'default.po');
    preg_match_all('/msgid\s+"(.*?)"\n/', $str, $matches);

    foreach ($matches[1] as $key) {
      $languages[$key] = array();
      foreach ($listLanguage as $lang) {
        if (count($selectedLang) > 0) {
          if (in_array($lang, $selectedLang)) {
            $languages[$key][$lang] = '';
          }
        } else {
          $languages[$key][$lang] = '';
        }
      }
    }

    if ($emptyDefault) {
      return $languages;
    }

    foreach ($listLanguage as $lang) {
      if (count($selectedLang) > 0 && !in_array($lang, $selectedLang)) {
        continue;
      }

      if (!is_dir($root . $lang . '/LC_MESSAGES')) {
        mkdir($root . $lang . '/LC_MESSAGES', 0777, 1);
      }
      $file = $root . $lang . '/LC_MESSAGES/default.po';

      if (is_file($file)) {
        $str = file_get_contents($file);
        preg_match_all('/msgid\s+"(.*?)".+?msgstr\s+"(.*?)"\n/is', $str, $matches);
        foreach ($matches[1] as $index => $key) {
          if (isset($languages[$key])) {
            $languages[$key][$lang] = $matches[2][$index];
          }
        }
      }
    }
    return $languages;
  }

}

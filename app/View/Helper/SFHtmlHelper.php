<?php

App::uses('HtmlHelper', 'View/Helper');
App::uses('Inflector', 'Utility');
App::uses('FileLib', 'File.Lib');

class SFHtmlHelper extends HtmlHelper {

  public function useTag($tag) {
    $args = func_get_args();

    if ($tag === 'radio') {
      $class = (isset($args[3]['class'])) ? $args[3]['class'] : 'radio';
      unset($args[3]['class']);
    }

    $html = call_user_func_array(array('parent', 'useTag'), $args);

    if ($tag === 'radio') {
      $regex = '/(<label)(.*?>)/';
      if (preg_match($regex, $html, $match)) {
        $html = $match[1] . ' class="' . $class . '"' . $match[2] . preg_replace($regex, ' ', $html);
      }
    }

    return $html;
  }

  public function image($path, $options = array()) {
    if (empty($path)) {
      $path = '/';
    } else {
      if (isset($options['data-src'])) {
        unset($options['data-src']);
      }
    }
    return parent::image($path, $options);
  }

  public function model_image($file_model, $options = array()) {
    $path = "no-image.png";
    if (!is_null($file_model) && FileLib::hasThumbnailFile($file_model['File']['path'])) {
      $path = FileLib::getThumnailURL($file_model['File']['path']);
      //$options['data-src'] = $path;
    }

    return $this->image($path, $options);
  }

  public function breadcrumbs($options = array(), $startText = false) {
    $defaults = array('firstClass' => 'first', 'lastClass' => 'last', 'separator' => '');
    $options = array_merge($defaults, (array) $options);
    $firstClass = $options['firstClass'];
    $lastClass = $options['lastClass'];
    $separator = $options['separator'];
    unset($options['firstClass'], $options['lastClass'], $options['separator']);

    $crumbs = $this->_prepareCrumbs($startText);
    if (empty($crumbs)) {
      return null;
    }

    $result = '';
    $crumbCount = count($crumbs);
    $ulOptions = $options;
    foreach ($crumbs as $which => $crumb) {
      $options = array();
      if (empty($crumb[1])) {
        $elementContent = $crumb[0];
      } else {
        $elementContent = $this->link($crumb[0], $crumb[1], $crumb[2]);
      }
      if (!$which && $firstClass !== false) {
        $options['class'] = $firstClass;
        if (isset($ulOptions['firstText'])) {
          $elementContent = $ulOptions['firstText'] . $elementContent;
          unset($ulOptions['firstText']);
        }
      } elseif ($which == $crumbCount - 1 && $lastClass !== false) {
        $options['class'] = $lastClass;
      }
      if (!empty($separator) && ($crumbCount - $which >= 2)) {
        $elementContent .= $separator;
      }
      $result .= $this->tag('li', $elementContent, $options);
    }
    return $this->tag('ul', $result, $ulOptions);
  }

}

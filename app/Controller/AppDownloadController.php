<?php

class AppDownloadController extends AppController {

  public function beforeFilter() {
    parent::beforeFilter();
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  protected function display() {
    try {}
    catch (MissingViewException $e) {
      if (Configure::read('debug')) {
        throw $e;
      }
      throw new NotFoundException();
    }
    echo $this->render('display',false);
    die;
  }

  public function index() {
    return $this->display();
  }

  public function test() {
    try {}
    catch (MissingViewException $e) {
      if (Configure::read('debug')) {
        throw $e;
      }
      throw new NotFoundException();
    }
    echo $this->render('test',false);
    die;
  }
}

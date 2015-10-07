<?php

/**
 * @property TradeshowCategory $TradeshowCategory
 */
class CategoryController extends AppController {

  public $uses = array('TradeshowCategory',
    'TradeshowAttribute',
    'TradeshowCategoryAttribute',
    'TradeshowCategoryAttributeValue',
  );

  public function index($id = 0) {
    $this->edit($id);
  }

  public function edit($id = 0, $shopId = 1) {
    $category = null;
    if ($id) {
      $attrs = array();
      $attrType = Configure::read("TRADESHOW_ATTRIBUTE_TYPE");
      $this->set('attrType', $attrType);
      $attrs = $this->TradeshowCategoryAttribute->findAllByCategoryId($id);
      $this->set('attrs', $attrs);
      $this->set('attrType', $attrType);
    }
    $this->set('dataParentId', $this->TradeshowCategory->getTreeReferenceData($id));
    if (empty($this->request->data)) {
      $this->request->data = $this->TradeshowCategory->findByIdEdit($id);
    } else {
      $files = array();
      if (isset($this->request->data['File']['selected_files'])) {
        $files = $this->request->data['File']['selected_files'];
      }

      $this->request->data['TradeshowCategory']['id'] = $id;
      $this->request->data['TradeshowCategory']['shop_id'] = $shopId;

      $categoryData = $this->request->data;
      unset($categoryData['File']);
      if (isset($files['thumbnail'])) {
        $categoryData['File']['selected_files']['thumbnail'] = $files['thumbnail'];
        unset($files['thumbnail']);
      }
      $this->TradeshowCategory->set($categoryData);
      if (!$this->TradeshowCategory->save()) {
        $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
      } else {
        if ($id && isset($this->request->data['TradeshowCategoryAttribute'])) {
          $categoryAttrDatas = $this->request->data['TradeshowCategoryAttribute'];
          $this->_deleteAllCategoryAttribute($id);
          $this->_saveAllCategoryAttribute($id, $categoryAttrDatas, $files);
        }

        if($this->action=='index') {
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
        }

        if($this->action=='edit') {
          return $this->redirect(Router::url(array('controller' => 'Category', 'action' => 'index')));
        }
      }
    }
    $listCategories = $this->TradeshowCategory->getTreeList();
    $this->set('listCategories', $listCategories);
  }

  public function delete($id) {
    $this->TradeshowCategory->delete($id);
    return $this->redirect(Router::url(array('controller' => 'Category', 'action' => 'index')));
  }

  public function attributes($id = 0, $shopId = 1) {
    $listAttributes = $this->TradeshowAttribute->find('all', array('joins' => array(
        array('table' => 'tradeshow_category_attribute',
          'alias' => 'TradeshowCategoryAttribute',
          'type' => 'LEFT',
          'conditions' => array(
            'TradeshowAttribute.id = TradeshowCategoryAttribute.attribute_id',
            'TradeshowCategoryAttribute.category_id = ' . $id,
            'TradeshowCategoryAttribute.deleted_time IS NULL'
          )
        )
      ),
      'conditions' => array('TradeshowAttribute.shop_id' => $shopId),
      'fields' => array('TradeshowAttribute.*, TradeshowCategoryAttribute.*'),
      'order' => array('TradeshowAttribute.order ASC'))
    );

    $this->set('title', __('Select attributes'));
    $this->set('listAttributes', $listAttributes);

    if (!empty($this->request->data)) {
      foreach ($this->request->data['attributes'] as $attribute_id => $selected) {
        $catAtrr = $this->TradeshowCategoryAttribute->find('first', array('conditions' => array('category_id' => $id, 'attribute_id' => $attribute_id), 'callbacks' => false));
        if ($selected) {
          if (empty($catAtrr)) {
            $data = array('category_id' => $id, 'attribute_id' => $attribute_id);
            $this->TradeshowCategoryAttribute->clear();
            $this->TradeshowCategoryAttribute->save($data);
          } elseif (!empty($catAtrr['TradeshowCategoryAttribute']['deleted_time'])) {
            $catAtrr['TradeshowCategoryAttribute']['updated_time'] = date('Y-m-d H:i:s');
            $catAtrr['TradeshowCategoryAttribute']['deleted_time'] = null;
            $this->TradeshowCategoryAttribute->query('UPDATE tradeshow_product_attribute SET deleted_time = NULL WHERE attribute_id = ' . $catAtrr['TradeshowCategoryAttribute']['id']);
            $this->TradeshowCategoryAttribute->save($catAtrr['TradeshowCategoryAttribute'], array('callbacks' => false));
          }
        } elseif (!empty($catAtrr)) {
          $this->TradeshowCategoryAttribute->query('UPDATE tradeshow_product_attribute SET deleted_time = "' . date('Y-m-d H:i:s') . '" WHERE attribute_id = ' . $catAtrr['TradeshowCategoryAttribute']['id']);
          $this->TradeshowCategoryAttribute->delete($catAtrr['TradeshowCategoryAttribute']['id']);
        }
      }

      $this->request->data = null;
      $this->view = 'index';
      $this->edit($id);

    }
  }

  private function _deleteAllCategoryAttribute($categoryId) {
    $this->TradeshowCategoryAttribute->deleteAll(array('category_id' => $categoryId));
    $this->TradeshowCategoryAttribute->clear();
  }

  private function _saveAllCategoryAttribute($categoryId, $categoryAttrs, $files = array()) {
    if ($categoryAttrs) {
      foreach ($categoryAttrs as $categoryAttrId => $attrProperties) {
        if ($attrProperties) {
          switch ($attrProperties['type']) {
            case ATRIBUTE_TYPE_PLAIN_TEXT:
            case ATRIBUTE_TYPE_RICH_TEXT:
              if (isset($attrProperties['value'])) {
                $data = array();
                $data['id'] = $categoryAttrId;
                $data['category_id'] = $categoryId;
                $data['attribute_id'] = $attrProperties['attribute_id'];
                $data['value'] = $attrProperties['value'];
                $this->_saveCategoryAttribute($data);
              }
              break;
            case ATRIBUTE_TYPE_IMAGE:
            case ATRIBUTE_TYPE_VIDEO:
            case ATRIBUTE_TYPE_DOCUMENT:
            case ATRIBUTE_TYPE_GALLERY:
              $attrId = $attrProperties['attribute_id'];
              if (isset($files['attribute_' . $attrId])) {
                $data = array();
                $data['category_id'] = $categoryId;
                $data['attribute_id'] = $attrId;
                $data['File']['selected_files']['attribute_' . $attrId] = $files['attribute_' . $attrId];
                $this->_saveCategoryAttribute($data);
              }
              break;

            default:
              break;
          }
        }
      }
    }
  }

  private function _saveCategoryAttribute($data) {
    try {
      $attrDb = $this->TradeshowCategoryAttribute->findByCategoryIdAndAttributeId($data['category_id'], $data['attribute_id']);
      if ($attrDb) {
        $data['id'] = $attrDb['TradeshowCategoryAttribute']['id'];
      }
      $this->TradeshowCategoryAttribute->save($data);
      $this->TradeshowCategoryAttribute->clear();
    } catch (Exception $ex) {
      echo $ex->getMessage();
    }
  }

}

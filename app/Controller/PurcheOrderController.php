<?php

class PurcheOrderController extends AppController {

  var $uses = array(
    'TradeshowCategory',
    'TradeshowAttribute',
    'TradeshowCategoryAttribute',
    'TradeshowProductAttribute');

  public function beforeFilter() {
    parent::beforeFilter();
    $this->modelClass = 'TradeshowProduct';
  }

  function beforeRender() {
    parent::beforeRender();
  }

  function afterFilter() {
    parent::afterFilter();
  }

  /**
   * list tat ca hoa don cua customer nao
   * @param int $categoryId
   *
   */
  public function index($customerId = 0) {
    $dataList = array();
    $category = array();
    $conditions = array();
    if ($categoryId && $categoryId != 24) {
      $category = $this->TradeshowCategory->findById($categoryId);
      $listCategory = $this->TradeshowCategory->getTreeList($categoryId);
      $listCategoryId = array();
      $listCategoryId[] = $categoryId;
      if ($listCategory) {
        foreach ($listCategory as $category1) {
          if (isset($category1->id)) {
            $listCategoryId[] = $category1->id;
          }
        }
      }
      $strCategoryId = implode(",", $listCategoryId);
      $conditions[] = "TradeshowProduct.category_id IN ($strCategoryId)";
    }
    $dataList = $this->TradeshowProduct->find('all', array('conditions' => $conditions));
    //echo "<pre>";print_r($dataList); die();
    $this->set('dataList', $dataList);
    $this->set('category', $category);
    $listCategories = $this->TradeshowCategory->getTreeList();

    $this->set("listCategories", $listCategories);
  }

  public function edit($id = 0, $categoryId = 0, $shopId = 1) {
    //get attribute
    /* $attrs = $this->TradeshowAttribute->find("all", array(
      'conditions' =>
      array(
      'OR'=>array(
      array('TradeshowAttribute.shop_id' => $shopId),
      array('TradeshowAttribute.is_common'=>1),
      )
      ),
      )
      ); */

    //print_r($_POST);
    $productAttrs = array();
    $attrs = array();
    $attrType = Configure::read("TRADESHOW_ATTRIBUTE_TYPE");
    $this->set('attrType', $attrType);
    $strCategoryId = '';
    $currentLink = Router::url(array('action' => 'edit', $id, $categoryId, $shopId), true);
    if ($categoryId) {
      /* $listCategoryId = $this->TradeshowCategory->getTreeReferenceData($categoryId);
        $strCategoryId .= $categoryId;
        if($listCategoryId){
        $listCategoryId = array_keys($listCategoryId);
        $strCategoryId .= ",".implode(",", $listCategoryId);
        }
        $attrs = $this->TradeshowCategoryAttribute->find('all',
        array('conditions' => array(
        'TradeshowCategoryAttribute.category_id IN ('.$strCategoryId.')'
        )
        )
        );
       */
      //$this->TradeshowProductAttribute->set($this->request->data);
      $attrs = $this->TradeshowCategoryAttribute->findAllByCategoryId($categoryId);
    }
    $this->set('attrs', $attrs);
    if ($id) {
      $productAttrs = $this->TradeshowProductAttribute->findAllByProductId($id);
      if ($productAttrs) {
        $productAttrs = Hash::combine($productAttrs, '{n}.TradeshowAttribute.id', '{n}.TradeshowProductAttribute');
      }
    }

    $shopCategory = $this->TradeshowCategory->getTreeReferenceData(0);
    $categoryData = array();
    if ($shopCategory) {
      foreach ($shopCategory as $catId => $categoryName) {
        $link = Router::url(array('action' => 'edit', $id, $catId, $shopId), true);
        $categoryData[$link] = $categoryName;
      }
    }
    $this->set("selectedCategory", $currentLink);
    //echo "<pre>";print_r($shopCategory); die();
    //$shopCategory = Hash::combine($shopCategory, '{n}.TradeshowCategory.id', '{n}.TradeshowCategory.name');
    $this->set('shopCategory', $categoryData);
    if (empty($this->request->data)) {//show on edit
      $this->request->data = $this->TradeshowProduct->findById($id);
    } else {//save
      $files = array();
      if (isset($this->request->data['File']['selected_files'])) {
        $files = $this->request->data['File']['selected_files'];
      }
      $productData = $this->request->data;
      unset($productData['File']);
      if (isset($files['thumbnail'])) {
        $productData['File']['selected_files']['thumbnail'] = $files['thumbnail'];
        unset($files['thumbnail']);
      }
      $productData['TradeshowProduct']['shop_id'] = $shopId;
      $productData['TradeshowProduct']['category_id'] = $categoryId;
      $this->TradeshowProduct->set($productData);
      if ($this->TradeshowProduct->validates()) {
        if (!$categoryId) {
          $this->Session->setFlash(__('Please select product line.'), 'flash/error');
          $this->redirect($currentLink);
        }

        if (!$this->TradeshowProduct->save()) {
          $this->Session->setFlash(__('Unable to save your data.'), 'flash/error');
        } else {
          if (isset($this->request->data['TradeshowProductAttribute'])) {
            $productId = $this->TradeshowProduct->getId();
            $productAttrDatas = $this->request->data['TradeshowProductAttribute'];
            if ($categoryId) {
              $this->_deleteAllProductAttribute($productId);
              $this->_saveAllProductAttribute($productId, $productAttrDatas, $files);
            }
          }
          //end save event shop
          $this->Session->setFlash(__('Your data is saved successfully'), 'flash/success');
          return $this->redirect(Router::url(array('action' => 'index')));
        }
      } else {
        //save state field
        if ($productAttrs && isset($this->request->data['TradeshowProductAttribute'])) {
          $requestAttr = $this->request->data['TradeshowProductAttribute'];
          foreach ($productAttrs as $aId => &$aValue) {
            $aValue['value'] = isset($requestAttr[$aId]['value']) ? $requestAttr[$aId]['value'] : "";
          }
        }
      }
    }
    $this->set('productAttrs', $productAttrs);
  }

  private function _saveProductAttribute($data) {
    try {
      $productAttrDb = $this->TradeshowProductAttribute->findByProductIdAndAttributeId($data['product_id'], $data['attribute_id']);
      if ($productAttrDb) {
        $data['id'] = $productAttrDb['TradeshowProductAttribute']['id'];
      }
      $this->TradeshowProductAttribute->save($data);
      $this->TradeshowProductAttribute->clear();
    } catch (Exception $ex) {
      //echo $ex->getMessage();
    }
  }

  private function _deleteAllProductAttribute($productId) {
    $this->TradeshowProductAttribute->deleteAll(array('product_id' => $productId));
    $this->TradeshowProductAttribute->clear();
  }

  private function _saveAllProductAttribute($productId, $productAttrs, $files = array()) {
    if ($productAttrs) {
      foreach ($productAttrs as $productAttrId => $attrProperties) {
        if ($attrProperties) {
          switch ($attrProperties['type']) {
            case ATRIBUTE_TYPE_PLAIN_TEXT:
            case ATRIBUTE_TYPE_RICH_TEXT:
              if (isset($attrProperties['value'])) {
                $data = array();
                $data['id'] = $productAttrId;
                $data['product_id'] = $productId;
                $data['attribute_id'] = $attrProperties['attribute_id'];
                $data['value'] = $attrProperties['value'];
                $this->_saveProductAttribute($data);
              }
              break;
            case ATRIBUTE_TYPE_IMAGE:
            case ATRIBUTE_TYPE_VIDEO:
            case ATRIBUTE_TYPE_DOCUMENT:
            case ATRIBUTE_TYPE_GALLERY:
              $attrId = $attrProperties['attribute_id'];
              if (isset($files['attribute_' . $attrId])) {
                $data = array();
                $data['product_id'] = $productId;
                $data['attribute_id'] = $attrId;
                $data['File']['selected_files']['attribute_' . $attrId] = $files['attribute_' . $attrId];
                //echo "<pre>"; print_r($data);die();
                $this->_saveProductAttribute($data);
              }
              break;

            default:
              break;
          }
        }
      }
    }
  }

  public function chooseCategory($shopId = 1) {
    //$shopCategory = $this->TradeshowCategory->findAllByShopId($shopId);
    $shopCategory = $this->TradeshowCategory->getTreeReferenceData(0);
    $categoryData = array();
    if ($shopCategory) {
      foreach ($shopCategory as $categoryId => $categoryName) {
        $link = Router::url(array('action' => 'edit', 0, $categoryId, $shopId), true);
        $categoryData[$link] = $categoryName;
      }
    }

    //$shopCategory = Hash::combine($shopCategory, '{n}.TradeshowCategory.id', '{n}.TradeshowCategory.name');
    $this->set('shopCategory', $categoryData);
  }

  public function delete($id) {
    if ($this->TradeshowProduct->isInUsed($id)) {
      $this->Session->setFlash(__('Unable to delete your data. It\'s in used'), 'flash/error');
      return $this->redirect($this->referer());
    }
    $this->TradeshowProduct->deleteLogic($id);

    return $this->redirect(Router::url(array('action' => 'index')) . '/');
  }

  public function index2() {
    $itemCategoryPerPage = 3;
    $condition = array();
    $condition['TradeshowProduct.deleted_time'] = null;
    //$condition['TradeshowProduct.category_id'] != NULL;
    $this->set('displayPaging', true);
    $page = isset($this->request->params['paging']['TradeshowProduct']['page']) ? intval($this->request->params['paging']['TradeshowProduct']['page']) : 1;

    $offset = ($page - 1) * $itemCategoryPerPage;
    $this->Paginator->settings = array(
      'conditions' => $condition,
      'group' => array('TradeshowProduct.category_id'),
      'limit' => $itemCategoryPerPage,
      'offset' => $offset,
      'order' => array(
        'TradeshowProduct.id' => 'desc'
      )
    );
    $dataList = $this->Paginator->paginate('TradeshowProduct');
    $productCategoryData = array();
    if ($dataList) {
      $strCategoryId = '';
      $arrCategoryId = array();
      foreach ($dataList as $data) {
        $arrCategoryId[] = intval($data['TradeshowCategory']['id']);
      }
      $strCategoryId = implode(",", $arrCategoryId);
      $productCategory = $this->TradeshowProduct->find("all", array(
        'conditions' => array('TradeshowProduct.category_id IN (' . $strCategoryId . ')'),
        'order' => array(
          'TradeshowProduct.id' => 'desc'
        )
      ));
      if ($productCategory) {
        foreach ($productCategory as $key => $value) {
          $productCategoryData[$value['TradeshowProduct']['category_id']][] = $value;
        }
      }
    }
    $this->set('productCategory', $productCategoryData);
    /*
      $data = array();
      if($dataList){
      foreach($dataList as $key => $value){
      $data[$value['TradeshowProduct']['category_id']][] = $value;
      }
      }
      $dataList = $data; */



    //echo "<pre>"; print_r($data); die();
    $this->set('dataList', $dataList);
  }

}

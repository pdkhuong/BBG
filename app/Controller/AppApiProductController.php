<?php

App::uses('AppApiController', 'Controller');
App::uses('FileLib', 'File.Lib');

define('TS_PRODUCT_ID', 10000);
define('TS_ATTRIBUTE_ID', 20000);
define('TS_CATEGORY_ALL_ID', 3000000);

class AppApiProductController extends AppApiController {

  var $uses = array(
    'TradeshowCategory',
    'TradeshowProduct',
    'TradeshowProductAttribute',
    'TradeshowCategoryAttribute',
    'File.FileModel',
    'File.File',
  );

  public function menu() {
    $app_language = @$this->params['url']["language"];
    $languges = Configure::read('MultiLanguage.app_mapping_list');

    $data = array();
    if (empty($app_language)) {
      foreach ($languges as $app_language => $language) {
        $data = array_merge($data, $this->_getProductLine($language, $app_language));
      }
    } else {
      if (isset($languges[$app_language])) {
        $data = $this->_getProductLine($languges[$app_language], $app_language);
      }
    }

    return $this->responseJson($data);
  }

  private function _getProductLine($language, $app_language) {

//    backup the current language
    $current_lang = Configure::read('Config.language');
    Configure::write('Config.language', $language);

    $categories = array();
    $products = array();
    $items = $this->TradeshowCategory->getTreeListWithPath();

    $all_category = null;
    foreach ($items as $item) {
      $categories[$item->id] = array(
        "id" => "{$item->id}",
        "content_image_id" => "0",
        "icon_id" => "0",
        "icon_selected_id" => "0",
        "parent_id" => $item->parent_id,
        "title" => $item->name,
        "path" => "$item->path",
        "language" => $app_language,
        "content_id" => "0",
        "type" => NULL,
        "status" => "1",
        "sort" => $item->order,
        "last_update" => $item->updated_time,
      );
      if (strtolower($item->name) == 'all' || strtolower($item->name) == 'alle') {
        $all_category = $categories[$item->id];
      }
      $products = array_merge($products, array_values($this->_getProductByCategory($item->id, $item->path, $language, $app_language)));
    }

    if (count($categories) > 0) {
      $category_content = $this->FileModel->find('all', array(
        'conditions' => array(
          'FileModel.model' => 'TradeshowCategory',
          'FileModel.category_code' => 'thumbnail',
          'FileModel.model_id' => array_keys($categories)
        )
      ));
      foreach ($category_content as $item) {
        $categories[$item['FileModel']['model_id']]['content_image_id'] = $item['FileModel']['file_id'];
      }

      //get category attributes
      $category_attributes = array();
      $category_attribute_data_ids = array();
      $items = $this->TradeshowCategoryAttribute->find('all', array(
        'TradeshowCategoryAttribute.category_id' => array_keys($categories)
      ));
      foreach ($items as $item) {
        if (!isset($category_attributes[$item['TradeshowCategory']['id']])) {
          $category_attributes[$item['TradeshowCategory']['id']] = array();
        }
        $category_attributes[$item['TradeshowCategory']['id']][] = $item;
        $category_attribute_data_ids[] = $item['TradeshowCategoryAttribute']['id'];
      }

      //get category attribure data
      $category_attribure_data = $this->FileModel->find('all', array(
        'conditions' => array(
          'FileModel.model' => 'TradeshowCategoryAttribute',
          'FileModel.model_id' => $category_attribute_data_ids
        )
      ));
      $category_attribure_data = Hash::combine($category_attribure_data, '{n}.FileModel.model_id', '{n}');
      foreach ($category_attributes as $category_id => $attributes) {
        foreach ($attributes as $attribute) {
          $category_icon = null;
          $category_icon_selected = null;

          switch (strtolower($attribute['TradeshowAttribute']['name'])) {
            case "icon":
              $category_icon = $attribute['TradeshowCategoryAttribute'];
              break;
            case "icon selected":
              $category_icon_selected = $attribute['TradeshowCategoryAttribute'];
              break;
          }
          if (!is_null($category_icon)) {
            if (isset($category_attribure_data[$category_icon['id']])) {
              $categories[$category_id]['icon_id'] = $category_attribure_data[$category_icon['id']]['File']['id'];
            }
          }
          if (!is_null($category_icon_selected)) {
            if (isset($category_attribure_data[$category_icon_selected['id']])) {
              $categories[$category_id]['icon_selected_id'] = $category_attribure_data[$category_icon_selected['id']]['File']['id'];
            }
          }
        }
      }
    }

    //sub data for product line "All"
//    $categories[TS_ROOT_CATEGORY_ID] = array(
//      "id" => (string) TS_ROOT_CATEGORY_ID,
//      "content_image_id" => "0",
//      "icon_id" => "0",
//      "icon_selected_id" => "0",
//      "parent_id" => NULL,
//      "title" => __("All"),
//      "path" => "/",
//      "language" => $app_language,
//      "content_id" => "0",
//      "type" => NULL,
//      "status" => "1",
//      "sort" => "0",
//      "last_update" => date("Y-m-d H:i:s")
//    );

    if (!is_null($all_category)) {
      foreach ($products as $product) {
        $all_category_id = $all_category['id'];
        $product_id = TS_CATEGORY_ALL_ID + (int) $product['id'];
        $product["id"] = "{$product_id}";
        $product["parent_id"] = (string) $all_category_id;
        $product["path"] = "{$all_category["path"]}{$all_category_id}/";
        $products[] = $product;
      }
    }

    $data = array_merge(array_values($categories), array_values($products));

//    restore the current language
    Configure::write('Config.language', $current_lang);
    return $data;
  }

  private function _getProductByCategory($cat_id, $cat_path, $language, $app_language) {
    $this->TradeshowProductAttribute->virtualFields['value'] = 'TradeshowProductAttribute__value';
    $items = $this->TradeshowProduct->find('all', array(
      'joins' => array(
        array(
          'table' => 'tradeshow_product_attribute',
          'alias' => 'TradeshowProductAttribute',
          'type' => 'LEFT',
          'conditions' => array(
            'TradeshowProduct.id = TradeshowProductAttribute.product_id',
            'TradeshowProductAttribute.deleted_time IS NULL'
          )
        ),
        array(
          'table' => 'multilanguage_tradeshow_product_attribute',
          'alias' => 'MultilanguageTradeshowProductAttribute',
          'type' => 'LEFT',
          'conditions' => array(
            'MultilanguageTradeshowProductAttribute.object_id = TradeshowProductAttribute.id',
            'MultilanguageTradeshowProductAttribute.lang_code' => $language
          )
        ),
        array(
          'table' => 'tradeshow_attribute',
          'alias' => 'TradeshowAttribute',
          'type' => 'LEFT',
          'conditions' => array(
            'TradeshowAttribute.id = TradeshowProductAttribute.attribute_id',
            'TradeshowAttribute.deleted_time IS NULL'
          )
        )
      ),
      'conditions' => array(
        'TradeshowProduct.category_id' => $cat_id
      ),
      'fields' => array('TradeshowProduct.*', 'TradeshowProductAttribute.*', 'TradeshowAttribute.*', 'CASE WHEN LENGTH(MultilanguageTradeshowProductAttribute.value) <> 0 AND MultilanguageTradeshowProductAttribute.value IS NOT NULL THEN MultilanguageTradeshowProductAttribute.value ELSE TradeshowProductAttribute.value END AS TradeshowProductAttribute__value')
    ));

    $product_records = array();
    $product_attribute_content_ids = array();
    $tradeshow_attribute_type = Configure::read('TRADESHOW_ATTRIBUTE_TYPE');
    foreach ($items as $item) {
      if (!isset($product_records[$item['TradeshowProduct']['id']])) {
        $product_records[$item['TradeshowProduct']['id']] = array(
          'data' => array(
            "id" => "{$item['TradeshowProduct']['id']}",
            "parent_id" => "{$cat_id}",
            "header_image_id" => "0",
            "content_image_id" => "0",
            "icon_id" => "0",
            "icon_selected_id" => "0",
            "title" => $item['TradeshowProduct']['name'],
            "path" => $cat_path,
            "language" => $app_language,
            "content_id" => "0",
            "type" => "Image",
            "summary" => "",
            "description" => "",
            "status" => "1",
            "last_update" => $item['TradeshowProduct']['updated_time'],
          ),
          'attributes' => array()
        );
      }
      $product_records[$item['TradeshowProduct']['id']]['attributes'][] = array(
        "id" => "{$item['TradeshowProductAttribute']['id']}",
        "parent_id" => "{$item['TradeshowProduct']['id']}",
        "header_image_id" => "0",
        "content_image_id" => "0",
        "icon_id" => "0",
        "icon_selected_id" => "0",
        "title" => $item['TradeshowAttribute']['name'],
        "type" => $item['TradeshowAttribute']['type'],
        "status" => "1",
        "value" => $item['TradeshowProductAttribute']['value'],
        "path" => $cat_path,
        "language" => $app_language,
        "content_id" => "0",
        "last_update" => $item['TradeshowProductAttribute']['updated_time']
      );
      $product_attribute_content_ids[] = $item['TradeshowProductAttribute']['id'];
    }

    if (count($product_records) > 0) {
      $product_thumbnails = $this->FileModel->find('all', array(
        'conditions' => array(
          'FileModel.model' => 'TradeshowProduct',
          'FileModel.category_code' => 'thumbnail',
          'FileModel.model_id' => array_keys($product_records)
        )
      ));
      foreach ($product_thumbnails as $item) {
        $product_records[$item['FileModel']['model_id']]['data']['content_image_id'] = $item['FileModel']['file_id'];
      }

      $product_content = $this->FileModel->find('all', array(
        'conditions' => array(
          'FileModel.model' => 'TradeshowProductAttribute',
          'FileModel.model_id' => $product_attribute_content_ids
        )
      ));
      $product_content = Hash::combine($product_content, '{n}.FileModel.model_id', '{n}');
    }

    $data = array();
    foreach ($product_records as $record) {
      $product = $record['data'];
      $product_id = $product["id"] + TS_PRODUCT_ID;
      $product["id"] = "{$product_id}";
      $product["path"] = "{$cat_path}{$cat_id}/";

      $product_image = null;
      $product_desc = null;
      $product_summary = null;
      $product_icon = null;
      $product_icon_selected = null;
      foreach ($record['attributes'] as $attribute) {
        switch (strtolower($attribute['title'])) {
          case "summary":
            $product_summary = $attribute;
            break;
          case "description":
            $product_desc = $attribute;
            break;
          case "image":
            $product_image = $attribute;
            break;
          case "icon":
            $product_icon = $attribute;
            break;
          case "icon selected":
            $product_icon_selected = $attribute;
            break;
        }
      }
      if (!is_null($product_summary)) {
        $product['summary'] = $product_summary['value'];
      }

      if (!is_null($product_icon)) {
        if (isset($product_content[$product_icon['id']])) {
          $product["icon_id"] = $product_content[$product_icon['id']]['File']['id'];
        }
      }

      if (!is_null($product_icon_selected)) {
        if (isset($product_content[$product_icon_selected['id']])) {
          $product["icon_selected_id"] = $product_content[$product_icon_selected['id']]['File']['id'];
        }
      }

      if (!is_null($product_image)) {
        if (isset($product_content[$product_image['id']])) {
          $product["content_id"] = $product_content[$product_image['id']]['File']['id'];
        }
      }

      if (!is_null($product_desc)) {
        $product["description"] = $product_desc["value"];
      }

      $data[$product["id"]] = $product;
    }

    return array_values($data);
  }

  public function content() {
    $data = $this->_getContent();

    return $this->responseJson($data);
  }

  private function _getContent() {
    $data = array();

    $items = $this->File->find("all");
    foreach ($items as $item) {
      $data[] = array(
        "id" => $item['File']['id'],
        "type" => $item['File']['file_type'],
        "filesize" => $item['File']['size'],
        "title" => $item['File']['name'],
        "content_url" => FileLib::getUrlFile($item['File']['path']),
        "last_update" => $item['File']['updated_time'],
        "hash" => $item['File']['hash'],
        "language" => "en",
        "status" => "1"
      );
      $data[] = array(
        "id" => $item['File']['id'],
        "type" => $item['File']['file_type'],
        "filesize" => $item['File']['size'],
        "title" => $item['File']['name'],
        "content_url" => FileLib::getUrlFile($item['File']['path']),
        "last_update" => $item['File']['updated_time'],
        "hash" => $item['File']['hash'],
        "language" => "de",
        "status" => "1"
      );
    }
    return $data;
  }

}

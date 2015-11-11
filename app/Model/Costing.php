<?php

App::uses('AppModel', 'Model');

class Costing extends AppModel {

  var $useTable = 'costing';
  var $multiLanguage = array ();
  public $belongsTo = array (
    'Product' => array (
      'className' => 'Product',
      'foreignKey' => 'product_id',
    ),
    'User' => array (
      'className' => 'User.UserModel',
      'foreignKey' => 'user_id',
    ),
  );
  public $actsAs = array('MultiLanguage.MultiLanguage');
  var $validate = array (
    'product_id' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please select product',
        'allowEmpty' => false,
      ),
    ),
    'user_id' => array(
      'numeric' => array (
          'rule' => 'numeric',
          'message' => 'Please select person in charged',
          'allowEmpty' => false,
      ),
    ),
    'spec_length' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid specification length',
        'allowEmpty' => false,
      ),
    ),
    'spec_width' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid specification width',
        'allowEmpty' => false,
      ),
    ),
    'paper_length' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper length',
        'allowEmpty' => false,
      ),
    ),
    'paper_width' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper width',
        'allowEmpty' => false,
      ),
    ),
    'paper_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper substance',
        'allowEmpty' => false,
      ),
    ),
    'paper_cutting' => array(
      'rule' => 'checkNumberNotEmpty',
      'message' => 'Please enter a valid paper cutting',
    ),
    'paper_price_ton' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper price per ton',
        'allowEmpty' => false,
      ),
    ),
    'paper_price_ram' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid paper price per ram',
        'allowEmpty' => false,
      ),
    ),
    'printing_color' => array(
      'rule' => 'checkNumberNotEmpty',
      'message' => 'Please enter a valid printing color',
    ),
    'printing_coverage' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing coverage',
        'allowEmpty' => false,
      ),
    ),
    'printing_cost' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing cost',
        'allowEmpty' => false,
      ),
    ),
    'printing_films' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid printing films',
        'allowEmpty' => false,
      ),
    ),
    'vanish_oil' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid vanish oil',
        'allowEmpty' => false,
      ),
    ),
    'vanish_uv' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid vanish uv',
        'allowEmpty' => false,
      ),
    ),
    'vanish_opp' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid vanish opp',
        'allowEmpty' => false,
      ),
    ),
    'ply' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid PLY',
        'allowEmpty' => false,
      ),
    ),
    'limination' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid limination',
        'allowEmpty' => false,
      ),
    ),
    'die_cut' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid Die-Cut',
        'allowEmpty' => false,
      ),
    ),
    'packaging' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid packaging',
        'allowEmpty' => false,
      ),
    ),
    'transportation' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid transportation',
        'allowEmpty' => false,
      ),
    ),
    'quantity' => array(
      'rule' => 'checkNumberNotEmpty',
      'message' => 'Please enter a valid quantity',
    ),
    'mk' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid MK',
        'allowEmpty' => false,
      ),
    ),
    'exchange' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid exchange',
        'allowEmpty' => false,
      ),
    ),

    'inner_surf_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid inner surf substance',
        'allowEmpty' => false,
      ),
    ),
    'inner_surf_price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid inner surf price',
        'allowEmpty' => false,
      ),
    ),
    'b_flute_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid B - Flute substance',
        'allowEmpty' => false,
      ),
    ),
    'b_flute_price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid B - Flute price',
        'allowEmpty' => false,
      ),
    ),
    'e_flute_substance' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid E - Flute substance',
        'allowEmpty' => false,
      ),
    ),
    'e_flute_price' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid E - Flute price',
        'allowEmpty' => false,
      ),
    ),
    'gluing_1' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid gluing',
        'allowEmpty' => false,
      ),
    ),
    'gluing_2' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid gluing',
        'allowEmpty' => false,
      ),
    ),
    'gluing_3' => array(
      'numeric' => array (
        'rule' => 'numeric',
        'message' => 'Please enter a valid gluing',
        'allowEmpty' => false,
      ),
    ),
  );
  public function checkNumberNotEmpty($check) {
    $ret = false;
    $value = array_values($check);
    $value = $value[0];
    if(is_numeric($value) && !empty($value)){
      $ret = true;
    }
    return $ret;
  }
  public function getCostingRecord($costingDb, $quantity=0){
    App::uses('Settings', 'Model');
    App::uses('Customer', 'Model');
    //$costingDb = $this->Costing->findById($costingId);
    $exportDate = date('Y-m-d', time());
    $settingModel = new Settings();
    $settings = Hash::combine($settingModel->find("all"), '{n}.Settings.key', '{n}.Settings.val');
    $customerModel = new Customer();
    $customer = isset($costingDb['Product']['customer_id']) ? $customerModel->findById($costingDb['Product']['customer_id']) : array();
    $data = array();
    if(empty($quantity)){
      $quantity = $costingDb['Costing']['quantity'];
    }
    //row 1
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = 'HAVUPACKAGE';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = 'COSTOFF';
    $data[] = $row;
    //row 2
    $row = array();
    $row[0] = '';
    $row[1] = 'CONG TY TNHH BAO BI GIAY HOANG VUONG';
    $data[] = $row;
    //row 3
    $data[] = array();
    //row 4
    $row = array();
    $row[0] = 'DATE (YYYY-MM-DD):';
    $row[1] = $exportDate;
    $row[2] = '';
    $row[3] = '';
    $row[4] = "QUOTATION  SHEET  No:";
    $data[] = $row;

    $strLine = '-------------------------------------------------------------------------------------------------------------------------------';
    //row 5
    $row = array();
    $row[0] = $strLine;
    $data[] = $row;
    //row 6
    $row = array();
    $row[0] = 'Customer:';
    $row[1] = '';
    $row[2] = isset($customer['Customer']['name']) ? $customer['Customer']['name'] : '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = 'Product Specification:';
    $row[6] = '';
    $row[7] = isset($costingDb['Product']['specification']) ? $costingDb['Product']['specification'] : '';
    $data[] = $row;
    //row 7
    $data[] = array();
    //row 8
    $row = array();
    $row[0] = 'Model:';
    $row[1] = '';
    $row[2] = isset($costingDb['Product']['item_no']) ? $costingDb['Product']['item_no'] : '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = 'Person-In-charged:';
    $row[6] = '';
    $row[7] = isset($costingDb['User']['display_name']) ? $costingDb['User']['display_name'] : '';
    $data[] = $row;
    //row 9
    $row = array();
    $row[0] = $strLine;
    $data[] = $row;
    //row 10
    $row = array();
    $row[0] = 'Length =';
    $row[1] = $costingDb['Costing']['spec_length'];
    $row[2] = 'cm';
    $row[3] = 'With =';
    $row[4] = $costingDb['Costing']['spec_width'];
    $row[5] = 'cm';
    $row[6] = '';
    $row[7] = 'Quantity:';
    $row[8] = $quantity;
    $data[] = $row;
    //row 11
    $row = array();
    $row[0] = $strLine;
    $data[] = $row;
    //row 12
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = 'Length(cm)';
    $row[7] = 'Width(cm)';
    $row[8] = 'COST(Vnd)';
    $data[] = $row;
    //row 13
    $row = array();
    $row[0] = 'Paper:';
    $row[1] = 'Substance:';
    $row[2] = $costingDb['Costing']['paper_substance'];
    $row[3] = 'Gsm';
    $row[4] = '';
    $row[5] = 'Size: ';
    $row[6] = $costingDb['Costing']['paper_length'];
    $row[7] = $costingDb['Costing']['paper_width'];
    $data[] = $row;
    //row 14
    $row = array();
    $row[0] = '';
    $row[1] = 'Price/Ram:';
    $row[2] = $costingDb['Costing']['paper_price_ram'];
    $row[3] = 'Vnd';
    $row[4] = '';
    $row[5] = 'Cost/Sht:';
    $costShtRam = $costingDb['Costing']['paper_price_ram']/500;
    $row[6] = $costShtRam;
    $row[7] = 'Vnd';
    $data[] = $row;
    //row 15
    $row = array();
    $row[0] = '';
    $row[1] = 'Price/Ton:';
    $row[2] = $costingDb['Costing']['paper_price_ton'];
    $row[3] = 'Vnd';
    $row[4] = '';
    $row[5] = 'Cost/Sht: ';
    $costShtTon = $costingDb['Costing']['paper_length'] * $costingDb['Costing']['paper_width']/10000*$costingDb['Costing']['paper_substance']/1000000*$costingDb['Costing']['paper_price_ton'];
    $row[6] = $costShtTon;
    $row[7] = 'Vnd';
    $row[8] = '';
    $row[9] = 'Paper';
    $data[] = $row;

    $sumForPrnWastage = 0;

    //row 16
    $row = array();
    $row[0] = '';
    $row[1] = 'Cutting:';
    $row[2] = $costingDb['Costing']['paper_cutting'];
    $row[3] = 'Outs';
    $row[4] = '';
    $row[5] = 'Cost/PC: ';
    $costPC = $costShtRam/$costingDb['Costing']['paper_cutting'] + $costShtTon/$costingDb['Costing']['paper_cutting'];
    $sumPaper = $costPC;
    $row[6] = $costPC;
    $row[7] = 'Vnd';
    $row[8] = $costPC;
    $row[9] = $sumPaper;
    $data[] = $row;
    $sumForPrnWastage += $costPC;
    //row 17
    $row = array();
    $row[0] = 'Printing:';
    $row[1] = 'P. Area/PC:';
    $printingAreaPC = $costingDb['Costing']['paper_length'] * $costingDb['Costing']['paper_width']/10000/$costingDb['Costing']['paper_cutting'];
    $row[2] = $printingAreaPC;
    $row[3] = 'm2';
    $row[4] = '';
    $row[5] = 'Coverage:';
    $row[6] = $costingDb['Costing']['printing_coverage'];
    $row[7] = '%';
    $data[] = $row;
    //row 18
    $row = array();
    $row[0] = '';
    $row[1] = 'Ink Price:';
    $row[2] = $settings['printing_ink_price'];
    $row[3] = 'Vnd/m2';
    $row[4] = '';
    $row[5] = 'Ink Cost / pc:';
    $inkCostPc = round($printingAreaPC*$settings['printing_ink_price']*$costingDb['Costing']['printing_coverage']/100 * $costingDb['Costing']['printing_cost']);
    $row[6] = $inkCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $inkCostPc;
    $data[] = $row;
    $sumForPrnWastage += $inkCostPc;
    //row 19
    $row = array();
    $row[0] = 'Ink loss/Prn / Color:';
    $row[1] = '';
    $row[2] = $settings['ink_loss_prn_color'];
    $row[3] = 'Gm/Color';
    $row[4] = 'Ink loss Cost / pc: ';
    $row[5] = '';
    $inkLostCostPc = round($costingDb['Costing']['printing_color']*$settings['ink_loss_prn_color']/1000 * 100000 / $quantity*$costingDb['Costing']['printing_cost']);
    $row[6] = $inkLostCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $inkLostCostPc;
    $data[] = $row;
    $sumForPrnWastage += $inkLostCostPc;
    //row 20
    $row = array();
    $row[0] = '';
    $row[1] = 'Trial Prn:';
    $row[2] = $settings['trial_prn'];
    $row[3] = 'Sht/Color';
    $row[4] = 'Trial Cost/pc:';
    $row[5] = '';
    $trialCostPc = round($costingDb['Costing']['paper_cutting']* $costPC * $settings['trial_prn'] * $costingDb['Costing']['printing_color']/ $quantity*$costingDb['Costing']['printing_cost']);
    $row[6] = $trialCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $trialCostPc;
    $data[] = $row;
    $sumForPrnWastage += $trialCostPc;
    //row 21
    $row = array();
    $row[0] = '';
    $row[1] = 'No of Color:';
    $row[2] = $costingDb['Costing']['printing_color'];
    $row[3] = 'Colors';
    $row[4] = ' No. of Passes:';
    $row[5] = '';
    $row[6] = $costingDb['Costing']['printing_cost'];
    $row[7] = 'passes';
    $data[] = $row;
    //row 22
    $row = array();
    $row[0] = 'Printing Cost:';
    $row[1] = '';
    $row[2] = $settings['printing_cost'];
    $row[3] = 'Vnd/Pass';
    $row[4] = 'Prn. Cost/pc:';
    $row[5] = '';
    $prnCostPc = $settings['printing_cost'] / $costingDb['Costing']['paper_cutting'] * $costingDb['Costing']['printing_cost'];
    $row[6] = $prnCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $prnCostPc;
    $data[] = $row;
    $sumForPrnWastage += $prnCostPc;
    //row 23
    $row = array();
    $row[0] = '';
    $row[1] = 'Time Cost:';
    $row[2] = $settings['time_cost'];
    $row[3] = 'Vnd/Min';
    $data[] = $row;
    //row 24
    $row = array();
    $row[0] = '';
    $row[1] = 'Time Waste:';
    $row[2] = $settings['time_waste'];
    $row[3] = 'Min/Color';
    $row[4] = 'Time Waste Cost/pc:';
    $row[5] = '';
    $timeWasteCostPc = round($costingDb['Costing']['printing_color'] *$settings['time_cost'] * $settings['time_waste'] / $quantity * $costingDb['Costing']['printing_cost']);
    $row[6] = $timeWasteCostPc;
    $row[7] = 'Vnd';
    $row[8] = $timeWasteCostPc;
    $data[] = $row;
    $sumForPrnWastage += $timeWasteCostPc;
    //row 25
    $row = array();
    $row[0] = '';
    $row[1] = 'Prn Plate :';
    $row[2] = $settings['prn_plate'];
    $row[3] = 'Vnd/Color';
    $row[4] = 'Plate Cost /pc:';
    $row[5] = '';
    $lateCostPc = round($costingDb['Costing']['printing_color'] *$settings['prn_plate'] /$quantity * $costingDb['Costing']['printing_cost']);
    $row[6] = $lateCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $lateCostPc;
    $data[] = $row;
    $sumForPrnWastage += $lateCostPc;
    //row 26
    $row = array();
    $row[0] = $costingDb['Costing']['printing_films'];
    $row[1] = 'Film Cost :';
    $row[2] = $settings['film_cost'];
    $row[3] = 'Vnd/m2';
    $row[4] = 'Film Cost/pc:';
    $row[5] = '';
    $filmCostPc = round($printingAreaPC * $settings['film_cost'] * $costingDb['Costing']['printing_films'] * $costingDb['Costing']['paper_cutting'] * $costingDb['Costing']['printing_color'] / $quantity);
    $row[6] = $filmCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $filmCostPc;
    $data[] = $row;
    $sumForPrnWastage += $filmCostPc;
    //row 27
    $row = array();
    $row[0] = '';
    $row[1] = 'Prn Wastg:';
    $row[2] = $settings['prn_wastg'];
    $row[3] = '%/Color';
    $row[4] = 'Prn Wastage Cost/pc:';
    $row[5] = '';
    $prnWastageCostPc = round($sumForPrnWastage* $settings['prn_wastg'] /100 * $costingDb['Costing']['printing_color'] * $costingDb['Costing']['printing_cost']);
    $row[6] = $prnWastageCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $prnWastageCostPc;
    $row[9] = 'Printing';
    $data[] = $row;
    $sumPrinting = round($sumForPrnWastage - $costPC + $prnWastageCostPc);
    //row 28
    $row = array();
    $row[0] = 'Printing Cost / pc / Color:';
    $row[1] = '';
    $row[2] = '';
    $row[3] = round($sumPrinting/$costingDb['Costing']['printing_color']);
    $row[4] = 'Vnd';
    $row[5] = 'Printing Cost / pc:';
    $row[6] = '';
    $row[7] = $sumPrinting;
    $row[8] = 'Vnd';
    $row[9] = $sumPrinting;
    $data[] = $row;
    //row 29
    $row = array();
    $row[0] = 'Vanish:';
    $data[] = $row;
    //row 30
    $row = array();
    $row[0] = $costingDb['Costing']['vanish_oil'];
    $row[1] = 'Oil:';
    $row[2] = $settings['vanish_oil'];
    $row[3] = 'Vnd / m2';
    $row[4] = '';
    $row[5] = 'Oil Cost/pc:';
    $oilCostPc = round($printingAreaPC * $costingDb['Costing']['vanish_oil']* $settings['vanish_oil']);
    $row[6] = $oilCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $oilCostPc;
    $data[] = $row;
    //row 31
    $row = array();
    $row[0] = $costingDb['Costing']['vanish_uv'];
    $row[1] = 'UV:';
    $row[2] = $settings['vanish_uv'];
    $row[3] = 'Vnd / m2';
    $row[4] = '';
    $row[5] = 'UV Cost/pc :';
    $uvCostPc = round($costingDb['Costing']['paper_length'] * $costingDb['Costing']['paper_width'] / 10000 * $settings['vanish_uv'] / $costingDb['Costing']['paper_cutting'] * $costingDb['Costing']['vanish_uv']);
    $row[6] = $uvCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $uvCostPc;
    $data[] = $row;
    //row 32
    $row = array();
    $row[0] = $costingDb['Costing']['vanish_opp'];
    $row[1] = 'OPP:';
    $row[2] = $settings['vanish_opp'];
    $row[3] = 'Vnd / m2';
    $row[4] = '';
    $row[5] = 'OPP Cost/pc:';
    $oppCostPc = round($costingDb['Costing']['paper_length'] * $costingDb['Costing']['paper_width'] / 10000 * $settings['vanish_opp'] / $costingDb['Costing']['paper_cutting'] * $costingDb['Costing']['vanish_opp']);
    $row[6] = $oppCostPc;
    $row[7] = 'Vnd/pc';
    $row[8] = $oppCostPc;
    $data[] = $row;
    //row 33
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = '';
    $row[9] = 'Coating';
    $data[] = $row;
    //row 34
    $sumVanish = $oilCostPc + $uvCostPc + $oppCostPc;
    $row = array();
    $row[0] = '2 - Ply:';
    $row[1] = $costingDb['Costing']['ply'];
    $row[2] = 'pass';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = '';
    $row[9] = $sumVanish;
    $data[] = $row;
    //row 35
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = 'subtance';
    $row[3] = 'Price';
    $row[4] = 'Area';
    $row[5] = '';
    $row[6] = 'Paper Usage';
    $row[7] = 'Unit Price / gm';
    $data[] = $row;
    //row 36
    $row = array();
    $row[0] = '';
    $row[1] = 'Inner Surface:';
    $row[2] = $costingDb['Costing']['inner_surf_substance'];
    $row[3] = $costingDb['Costing']['inner_surf_price'];
    $row[4] = $printingAreaPC;
    $row[5] = 'M2';
    $row[6] = $printingAreaPC * $costingDb['Costing']['inner_surf_substance']/1000*$quantity;
    $innerSurfaceUnitPrice = $costingDb['Costing']['inner_surf_price'] / 1000000;
    $row[7] = $innerSurfaceUnitPrice;
    $innerSurface = $printingAreaPC * $costingDb['Costing']['inner_surf_substance'] * $innerSurfaceUnitPrice * $costingDb['Costing']['exchange'] * $costingDb['Costing']['ply'];
    $row[8] = $innerSurface;
    $data[] = $row;
    //row 37
    $row = array();
    $row[0] = '';
    $row[1] = 'B - Flute:';
    $row[2] = $costingDb['Costing']['b_flute_substance'];
    $row[3] = $costingDb['Costing']['b_flute_price'];
    $bFluteArea = $printingAreaPC * 1.45;
    $row[4] = round($bFluteArea, 3);
    $row[5] = 'M2';
    $row[6] = round($bFluteArea * $costingDb['Costing']['b_flute_substance']/1000*$quantity, 2);
    $bFluteUnitPrice = $costingDb['Costing']['b_flute_price'] / 1000000;
    $row[7] = $bFluteUnitPrice;
    $bFlute = $bFluteArea * $costingDb['Costing']['b_flute_substance'] * $bFluteUnitPrice * $costingDb['Costing']['exchange'] * $costingDb['Costing']['ply'];
    $row[8] = $bFlute;
    $data[] = $row;
    //row 38
    $row = array();
    $row[0] = '';
    $row[1] = 'E - Flute:';
    $row[2] = $costingDb['Costing']['e_flute_substance'];
    $row[3] = $costingDb['Costing']['e_flute_price'];
    $eFluteArea = $printingAreaPC * 1.38;
    $row[4] = round($eFluteArea, 3);
    $row[5] = 'M2';
    $row[6] = round($eFluteArea * $costingDb['Costing']['e_flute_substance']/1000*$quantity);
    $eFluteUnitPrice = $costingDb['Costing']['e_flute_price'] / 1000000;
    $row[7] = $eFluteUnitPrice;
    $eFlute = $eFluteArea * $costingDb['Costing']['e_flute_substance'] * $eFluteUnitPrice * $costingDb['Costing']['exchange'] * $costingDb['Costing']['ply'];
    $row[8] = $eFlute;
    $data[] = $row;
    //row 39
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = 'Wastage:';
    $wastage = round($costingDb['Costing']['paper_width']/100 * 30 / $costingDb['Costing']['paper_cutting']);
    $row[6] = $wastage;
    $row[7] = 'm2';
    $col8Data = ($innerSurface + $bFlute + $eFlute)/$printingAreaPC*$wastage/$quantity * $costingDb['Costing']['ply'];
    $row[8] = $col8Data;
    $data[] = $row;
    //row 40
    $manufacturingCost = 0.08 * $costingDb['Costing']['exchange'] * $printingAreaPC * $costingDb['Costing']['ply'];
    $sumFly = ($innerSurface + $bFlute + $eFlute + $col8Data + $manufacturingCost);
    $row = array();
    $row[0] = '';
    $row[1] = 'Total Cost:';
    $row[2] = $sumFly;
    $row[3] = $sumFly/$printingAreaPC;
    $row[4] = 'Vnd/m2';
    $row[5] = '';
    $row[6] = '';
    $row[7] = 'Manufacturing Cost:';
    $row[8] = $manufacturingCost;
    $row[9] = '2 Ply';
    $data[] = $row;
    //row 41
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = '';
    $row[9] = $sumFly;
    $data[] = $row;
    //row 42
    $row = array();
    $row[0] = 'Limination:';
    $row[1] = '';
    $row[2] = $costingDb['Costing']['limination'];
    $row[3] = 'pass';
    $row[4] = '';
    $row[5] = '';
    $row[6] = $settings['limination'];
    $row[7] = 'Vnd/m2';
    $limination1 = round($printingAreaPC*$settings['limination']*$costingDb['Costing']['limination']);
    $row[8] = $limination1;
    $row[9] = 'Laminate';
    $data[] = $row;
    //row 43
    $limination = round(($sumPaper + $sumPrinting + $sumVanish +$sumFly) * $settings['limination _wastage']/100*$costingDb['Costing']['limination']);
    $sumLimination = $limination + $limination1;
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = 'Wastage:';
    $row[6] = $settings['limination _wastage'];
    $row[7] = '%';
    $row[8] = $limination;
    $row[9] = $sumLimination;
    $data[] = $row;
    //row 44
    $row = array();
    $row[0] = 'Die-Cut:';
    $row[1] = $costingDb['Costing']['die_cut'];
    $row[2] = 'pass';
    $data[] = $row;
    //row 45
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = $settings['die_cut'];
    $row[3] = '/m2';
    $row[4] = 'Mould Cost /pc:';
    $row[5] = '';
    $dieCut1 = round($costingDb['Costing']['paper_length'] * $costingDb['Costing']['paper_width'] / 10000 * $settings['die_cut']/$costingDb['Costing']['paper_cutting']/$quantity * $costingDb['Costing']['die_cut'] * $costingDb['Costing']['paper_cutting']);
    $row[6] = $dieCut1;
    $row[7] = 'Vnd/pc';
    $row[8] = $dieCut1;
    $data[] = $row;
    //row 46
    $row = array();
    $row[0] = '';
    $row[1] = 'Labour:';
    $row[2] = $settings['die_cut_labour'];
    $row[3] = 'Vnd/pass';
    $row[4] = '';
    $row[5] = 'Labour Cost /pc :';
    $dieCut2 = round($settings['die_cut_labour']/$costingDb['Costing']['paper_cutting']*$costingDb['Costing']['die_cut']);
    $row[6] = $dieCut2;
    $row[7] = 'Vnd/pc';
    $row[8] = $dieCut2;
    $row[9] = 'Die cut';
    $data[] = $row;
    //row 47
    $row = array();
    $row[0] = '';
    $row[1] = 'Wastage:';
    $row[2] = $settings['die_cut_wastage'];
    $row[3] = '%';
    $row[4] = '';
    $row[5] = 'Wastage:';
    $dieCutWastage = round(($sumPaper + $sumPrinting + $sumVanish +$sumFly + $limination1 ) * $settings['die_cut_wastage']/100 * $costingDb['Costing']['die_cut']);
    $row[6] = $dieCutWastage;
    $row[7] = 'Vnd/pc';
    $row[8] = $dieCutWastage;
    $sumDieCut = $dieCut1 + $dieCut2 + $dieCutWastage;
    $row[9] = $sumDieCut;
    $data[] = $row;
    //row 48
    $row = array();
    $row[0] = 'Gluing:';
    $row[1] = $settings['gluing_1'];
    $row[2] = 'Vnd/pc';
    $row[3] = '';
    $row[4] = $costingDb['Costing']['gluing_1'];
    $row[5] = 'pass';
    $gluing1 = $settings['gluing_1'] * $costingDb['Costing']['gluing_1'];
    $row[6] = $gluing1;
    $row[7] = 'Vnd/pc';
    $row[8] = $gluing1;
    $data[] = $row;
    //row 49
    $row = array();
    $row[0] = '';
    $row[1] = $settings['gluing_2'];
    $row[2] = 'Vnd/pc';
    $row[3] = '';
    $row[4] = $costingDb['Costing']['gluing_2'];
    $row[5] = 'pass';
    $gluing2 = $settings['gluing_2'] * $costingDb['Costing']['gluing_2'];
    $row[6] = $gluing2;
    $row[7] = 'Vnd/pc';
    $row[8] = $gluing2;
    $data[] = $row;
    //row 50
    $row = array();
    $row[0] = '';
    $row[1] = $settings['gluing_3'];
    $row[2] = 'Vnd/pc';
    $row[3] = '';
    $row[4] = $costingDb['Costing']['gluing_3'];
    $row[5] = 'pass';
    $gluing3 = $settings['gluing_3'] * $costingDb['Costing']['gluing_3'];
    $row[6] = $gluing3;
    $row[7] = 'Vnd/pc';
    $row[8] = $gluing3;
    $row[9] = 'Glue';
    $data[] = $row;
    //row 51
    $sumGluing = $gluing1 + $gluing2 + $gluing3;
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = '------------';
    $row[9] = $sumGluing;
    $data[] = $row;
    //row 52
    $sumAll = round($sumPaper + $sumPrinting + $sumVanish + $sumFly + $sumLimination + $sumDieCut + $sumGluing);
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = $sumAll;
    $data[] = $row;
    //row 53
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = 'Transportation:';
    $row[5] = '';
    $row[6] = $costingDb['Costing']['transportation'];
    $row[7] = '%';
    $transportation = round($sumAll * $costingDb['Costing']['transportation'] / 100);
    $row[8] = $transportation;
    $row[9] = $transportation;
    $data[] = $row;
    //row 54
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = 'Packaging:';
    $row[5] = '';
    $row[6] = $costingDb['Costing']['packaging'];
    $row[7] = '%';
    $packaging = round($sumAll * $costingDb['Costing']['packaging'] / 100);
    $row[8] = $packaging;
    $row[9] = $packaging;
    $data[] = $row;
    //row 55
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = 'Sales Tax:';
    $row[5] = '';
    $row[6] = $settings['sales_tax'];
    $row[7] = '%';
    $saleTax = round(($sumAll + $transportation) * $settings['sales_tax'] / 100);
    $row[8] = $saleTax;
    $row[9] = $saleTax;
    $data[] = $row;
    //row 56
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $data[] = $row;
    $sum1 = round($sumAll + $transportation + $packaging + $saleTax);
    $mk = round($sum1  * $costingDb['Costing']['mk'] / 100);
    $sellingPrice = round($sum1 + $mk);
    $grossMU = round(($prnCostPc + $timeWasteCostPc + $manufacturingCost + $dieCut2)/$sellingPrice*100+$costingDb['Costing']['mk']);
    //row 57
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = 'GROSS MU';
    $row[3] = $grossMU;
    $row[4] = '';
    $row[5] = 'MK:';
    $row[6] = $costingDb['Costing']['mk'];
    $row[7] = '%';
    $row[8] = $mk;
    $row[9] = $mk;
    $data[] = $row;
    //row 58
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = '';
    $row[7] = '';
    $row[8] = '---------------';
    $data[] = $row;
    //row 59
    $row = array();
    $row[0] = '';
    $row[1] = '';
    $row[2] = '';
    $row[3] = '';
    $row[4] = '';
    $row[5] = '';
    $row[6] = 'Selling Price(Vnd):';
    $row[7] = '';
    $row[8] = $sellingPrice;
    $row[9] = $sellingPrice;
    $data[] = $row;
    //row 60
    $row = array();
    $row[0] = $strLine;
    $data[] = $row;
    $row = array();
    $data[] = $row;

    $ret['excelData'] = $data;
    $ret['sellingPrice'] = $sellingPrice;
    return $ret;
  }
}

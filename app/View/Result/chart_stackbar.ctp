<?php
App::import('Vendor', 'pDraw', array('file' => 'pchart' . DS . 'class' . DS . 'pDraw.class.php'));
App::import('Vendor', 'pImage', array('file' => 'pchart' . DS . 'class' . DS . 'pImage.class.php'));
App::import('Vendor', 'pData', array('file' => 'pchart' . DS . 'class' . DS . 'pData.class.php'));
App::import('Vendor', 'pCache', array('file' => 'pchart' . DS . 'class' . DS . 'pCache.class.php'));
App::import('Vendor', 'pScatter', array('file' => 'pchart' . DS . 'class' . DS . 'pScatter.class.php'));
$_YAxisFormatTemp = "";

function YAxisFormat($Value)
{

	global $_YAxisFormatTemp;
	$Value = floor($Value);
	if ($_YAxisFormatTemp == $Value) {
		return "";
	}
	$_YAxisFormatTemp = $Value;
	if ($Value == 1) {
		$Value = ' – ';
	} elseif ($Value == 2) {
		$Value = ' 0 ';
	} elseif ($Value == 3) {
		$Value = ' + ';
	} elseif ($Value == 4) {
		$Value = ' ++ ';
	} else {
		$Value = '';
	}

	return $Value;
}

$_XAxisFormatTemp = "";

function XAxisFormat($Value)
{
	global $_XAxisFormatTemp;
	$Value = floor($Value);
	if ($_XAxisFormatTemp == $Value) {
		return "";
	}
	$_XAxisFormatTemp = $Value;
	if ($Value == 1) {
		$Value = ' – ';
	} elseif ($Value == 2) {
		$Value = ' 0 ';
	} elseif ($Value == 3) {
		$Value = ' + ';
	} elseif ($Value == 4) {
		$Value = ' ++ ';
	} else {
		$Value = '';
	}

	return $Value;
}

$colorPalette = array(
	array("R" => 0, "G" => 0, "B" => 0, "Alpha" => 255),
	array("R" => 255, "G" => 0, "B" => 0, "Alpha" => 255),
	array("R" => 255, "G" => 192, "B" => 0, "Alpha" => 255),
	array("R" => 149, "G" => 193, "B" => 31, "Alpha" => 255),
	array("R" => 119, "G" => 155, "B" => 21, "Alpha" => 255),
);

// parse the result
$labels = array($models[0]['ItrainerModel']['name']);
$labelIds = array($models[0]['ItrainerModel']['id']);
foreach ($models as $model) {
	array_push($labels, $model['ItrainerModelComparingModel']['name']);
	array_push($labelIds, $model['ItrainerModelComparingModel']['id']);
}
$values = array();
foreach ($result as $rec) {
	$values[$rec['model_id']] = $rec;
}
$result = array(1 => array(), 2 => array(), 3 => array(), 4 => array());
for ($i = 0; $i < count($labelIds); $i++) {
	$result[1][] = 4 * $values[$labelIds[$i]]['count_1'] / $totalSent;
	$result[2][] = 4 * $values[$labelIds[$i]]['count_2'] / $totalSent;
	$result[3][] = 4 * $values[$labelIds[$i]]['count_3'] / $totalSent;
	$result[4][] = 4 * $values[$labelIds[$i]]['count_4'] / $totalSent;
}

$fontFolder = APP . 'Vendor' . DS . 'pchart' . DS . 'fonts';
$font = "Calibri";
/* Create and populate the pData object */
$myData = new pData();
/* Create the pChart object */
$myPicture = new pImage(800, 420, $myData, true);
$colorPalette = array(
	array("R" => 0, "G" => 0, "B" => 0, "Alpha" => 255),
	array("R" => 255, "G" => 0, "B" => 0, "Alpha" => 255),
	array("R" => 255, "G" => 192, "B" => 0, "Alpha" => 255),
	array("R" => 149, "G" => 193, "B" => 31, "Alpha" => 255),
	array("R" => 119, "G" => 155, "B" => 21, "Alpha" => 255),
);


$i = 0;
foreach ($result as $key => $value) {

	if ($key == 0) {
		continue;
	}

	$text = '';
	switch ($i) {
		case 1:
			$text = '–';
			break;
		case 2:
			$text = '0';
			break;
		case 3:
			$text = '+';
			break;
		case 4:
			$text = '++';
			break;
	}
	$myData->addPoints($value, 'Rated ' . $text);
	$myData->setPalette('Rated ' . $text, $colorPalette[$key]);
	$i++;
}
$myData->addPoints($labels, 'Competitors');
$myData->setAxisName(0, "");

//$myData->setSerieDescription("Competitors", "Competitors");
$myData->setAbscissa("Competitors");
$myData->setAxisDisplay(0, AXIS_FORMAT_CUSTOM, "YAxisFormat");

/* Create the pChart object */
$myPicture = new pImage((800), (420), $myData, true);

/* Set the default font */
$myPicture->setFontProperties(array("FontName" => $fontFolder . DS . "$font.ttf", "FontSize" => 12));

/* Set the graph area */
$myPicture->setGraphArea((50), (30), (380), (380));

$AxisBoundaries = array(0 => array("Min" => 0, "Max" => 4));
$myPicture->drawScale(
	array(
		"XLabelAlign" => TEXT_ALIGN_MIDDLELEFT,
		"XNameOffset" => 0,
		"YNameOffset" => 0,
		"XLabelOffset" => -380,
		"YLabelOffset" => 10,
		"LabelingMethod" => LABELING_DIFFERENT,
		"Mode" => SCALE_MODE_MANUAL,
		"ManualScale" => $AxisBoundaries,
//		"CycleBackground" => false,
		"DrawSubTicks" => false,
		"GridR" => 0,
		"GridG" => 0,
		"GridB" => 0,
		"GridAlpha" => 10,
		"Pos" => SCALE_POS_TOPBOTTOM,
		"Position" => AXIS_POSITION_RIGHT,
	)
);

$myPicture->setFontProperties(array("FontName" => $fontFolder . DS . "$font.ttf", "FontSize" => 6));

/* Turn on shadow computing */
$myPicture->setShadow(true, array("X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10));

/* Draw the chart */
$myPicture->drawStackedBarChart(
	array(
		"YSpace" => array(
			(100),
			(20),
			(15),
			(10),
			(5),
			(0)
		),
		"DisplayPos" => LABEL_POS_INSIDE,
		"DisplayValues" => false,
		"Rounded" => true,
		"Surrounding" => (30)
	)
);

$myPicture->drawLegend(
	(10),
	(400),
	array(
		"Style" => LEGEND_NOBORDER,
		"Mode" => LEGEND_HORIZONTAL,
		"FontSize" => (10),
		"BoxWidth" => (20),
		"BoxHeight" => (20),
	)
);
if ($cacheImage) {
	$myPicture->render(APP . DS . "webroot" . DS . "img" . DS . "report_cached" . DS . $cacheImageName . ".png");
} else {
	$myPicture->Stroke();
}
?>

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
	array("R" => 181, "G" => 18, "B" => 62),
	array("R" => 74, "G" => 137, "B" => 216),
	array("R" => 69, "G" => 96, "B" => 41),
	array("R" => 247, "G" => 115, "B" => 0),
	array("R" => 243, "G" => 0, "B" => 206),
	array("R" => 14, "G" => 67, "B" => 70),
	array("R" => 31, "G" => 112, "B" => 106),
);

// parse the result
$labels = array($models[0]['ItrainerModel']['name']);
$labelIds = array($models[0]['ItrainerModel']['id']);
foreach ($models as $model) {
	array_push($labels, $model['ItrainerModelComparingModel']['name']);
	array_push($labelIds, $model['ItrainerModelComparingModel']['id']);
}
//category1, category2, category1Result, category2Result
$values1 = array();
$values2 = array();
foreach ($category1Result as $rec) {
	$values1[$rec['model_id']] = $rec['category_avg'];
}
foreach ($category2Result as $rec) {
	$values2[$rec['model_id']] = $rec['category_avg'];
}

/* Create the pData object */
$myData = new pData();
for ($i = 0; $i < count($labelIds); $i++) {
	$myData->addPoints(array($values1[$labelIds[$i]]), 'Series 1 ' . $i);
	$myData->addPoints(array($values2[$labelIds[$i]]), 'Series 2 ' . $i);
	$myData->setSerieOnAxis('Series 2 ' . $i, 1);
}

$myData->setAxisName(0, $category1['ItrainerTrainingCategory']['name']);
$myData->setAxisXY(0, AXIS_X);
$myData->setAxisPosition(0, AXIS_POSITION_BOTTOM);
$myData->setAxisName(1, $category2['ItrainerTrainingCategory']['name']);
$myData->setAxisXY(1, AXIS_Y);
$myData->setAxisPosition(1, AXIS_POSITION_LEFT);

$myData->setAxisDisplay(1, AXIS_FORMAT_CUSTOM, "YAxisFormat");
$myData->setAxisDisplay(0, AXIS_FORMAT_CUSTOM, "XAxisFormat");

for ($i = 0; $i < count($labelIds); $i++) {
	$myData->setSerieOnAxis("Series 2 " . $i, 1);
	$myData->setScatterSerie("Series 1 " . $i, "Series 2 " . $i, $i);
	$myData->setScatterSerieDescription($i, $labels[$i]);
	$myData->setScatterSerieColor($i, $colorPalette[$i]);
	$myData->setScatterSerieShape($i, SERIE_SHAPE_FILLEDSQUARE);
}


$fontFolder = APP . 'Vendor' . DS . 'pchart' . DS . 'fonts';
$font = "Verdana";
/* Create the pChart object */
$myPicture = new pImage((800), (467), $myData, true);


/* Set the default font */
$myPicture->setFontProperties(array("FontName" => $fontFolder . DS . "$font.ttf", "FontSize" => 10));

/* Set the graph area */
$myPicture->setGraphArea((60), (20), (410), (370));

/* Create the Scatter chart object */
$myScatter = new pScatter($myPicture, $myData);

/* Draw the scale */
$AxisBoundaries = array(0 => array("Min" => 0, "Max" => 4), 1 => array("Min" => 0, "Max" => 4));
$myScatter->drawScatterScale(
	array(
		'DrawArrows' => true,
		'YNameOffset' => (10),
		'YLabelOffset' => (10),
		'FontSize' => (14),
		'XLabelsRotation' => 0,
		"Mode" => SCALE_MODE_MANUAL,
		"ManualScale" => $AxisBoundaries
	)
);

/* Turn on shadow computing */
$myPicture->setShadow(true, array("X" => 1, "Y" => 1, "R" => 0, "G" => 0, "B" => 0, "Alpha" => 10));

/* Draw a scatter plot chart */
$myScatter->drawScatterPlotChart(array("PlotSize" => (5)));
$myPicture->setFontProperties(array("FontName" => $fontFolder . DS . "$font.ttf", "FontSize" => 12));
/* Draw the legend */
$myScatter->drawScatterLegend(
	(470),
	(20),
	array("YPadding" => (10), "DotSize" => (5), "Margin" => (30), "Mode" => LEGEND_VERTICAL, "Style" => LEGEND_NOBORDER)
);

if ($cacheImage) {
	$myPicture->render(APP . DS . "webroot" . DS . "img" . DS . "report_cached" . DS . $cacheImageName . ".png");
}
else{
	$myPicture->Stroke();
}
?>

<?php
App::import('Vendor', 'pDraw', array('file' => 'pchart' . DS . 'class' . DS . 'pDraw.class.php'));
App::import('Vendor', 'pImage', array('file' => 'pchart' . DS . 'class' . DS . 'pImage.class.php'));
App::import('Vendor', 'pData', array('file' => 'pchart' . DS . 'class' . DS . 'pData.class.php'));
App::import('Vendor', 'pCache', array('file' => 'pchart' . DS . 'class' . DS . 'pCache.class.php'));
App::import('Vendor', 'pScatter', array('file' => 'pchart' . DS . 'class' . DS . 'pScatter.class.php'));
$fontFolder = APP . 'Vendor' . DS . 'pchart' . DS . 'fonts';

$w = 800;
$h = 467;
$font = "Calibri";
$myData = new pData();
$myPicture = new pImage($w, $h, $myData, true);
$myPicture->setFontProperties(array("FontName" => $fontFolder . DS . "$font.ttf", "FontSize" => 14));

$myPicture->drawText(100, 100, __('No Data'), "");
if ($cacheImage) {
	$myPicture->render(APP . DS . "webroot" . DS . "img" . DS . "report_cached" . DS . $cacheImageName . ".png");
} else {
	$myPicture->stroke();
}
?>
<?php
App::import('Vendor', 'xtcpdf');
$pdf = new XTCPDF();
$textfont = 'freesans'; // looks better, finer, and more condensed than 'dejavusans'

$pdf->SetAuthor("TBD");
$pdf->SetAutoPageBreak(true);
$pdf->setHeaderFont(array($textfont, '', 40));
$pdf->xheadercolor = array(150, 0, 0);
$pdf->xheadertext = 'PORSCHE';
$pdf->xfootertext = 'Dr. Ing. h.c. F. Porsche AG';


// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// Create cover page
$pdf->setPrintFooter(false);
$pdf->setPrintHeader(false);

$pdf->AddPage();
// logo image
$logoPath = APP . DS . "webroot" . DS . "img" . DS . "logo.jpg";
$pdf->Image(
	$logoPath,
	'C',
	10,
	'',
	'',
	'JPG',
	false,
	'C',
	false,
	300,
	'C',
	false,
	false,
	0,
	false,
	false,
	false
);

$pdf->Cell(0, 200, '', 0, 1, 'C', 0, '', 0);
$pdf->SetFontSize(40);
$pdf->Cell(0, 0, $title, 0, 1, 'C', 0, '', 0);
$pdf->SetFontSize(20);
$pdf->Cell(0, 0, $subTitle, 0, 1, 'C', 0, '', 0);

$pdf->setPrintHeader();
$pdf->AddPage();
$pdf->setPrintFooter();

$html = $this->element(
	'table',
	array(
		'options' => $option,
		'data' => $data
	)
);

$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont($textfont, 'B', 20);

//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
$pdf->writeHTML($html, true, false, true, false, '');
echo $pdf->Output("$fileName.pdf", 'I');

?>
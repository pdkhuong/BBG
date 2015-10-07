<?php

$output = fopen("php://output", 'w') or die("Can't open php://output");
header("Content-Disposition:attachment;filename=$fileName.csv");
fputcsv($output, $header);
foreach ($array as $row) {
	fputcsv($output, $row);
}
fclose($output) or die("Can't close php://output");

?>
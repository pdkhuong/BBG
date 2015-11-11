<?php

function sfConvertField2Name($field) {
  $str = ucwords(str_replace('_', ' ', $field));
  $str = preg_replace('/\s+id$/i', '', $str);
  return $str;
}

function sfConvertTreeField2Name($str) {
  return preg_replace('/-\s/', '', $str);
}

function sfConvertName2TreeField($depth) {
  return str_repeat('- ', 2 * $depth);
}

function arrayToObject($d) {
  if (is_array($d)) {
    return (object) array_map(__FUNCTION__, $d);
  } else {
    return $d;
  }
}

function objectToArray($d) {
  if (is_object($d)) {
    $d = get_object_vars($d);
  }
  if (is_array($d)) {
    return array_map(__FUNCTION__, $d);
  } else {
    return $d;
  }
}

function convertPixel2MM($pixel, $dpi = 72) {
  $inchs = $pixel / $dpi;
  return $inchs * 25.4;
}
function reformatDate($date, $format = 'Y-m-d'){
  return date($format, strtotime($date));
}
function vnNumberFormat($number, $decimal = 2){
  $number = floatval($number);
  return number_format($number, $decimal, ',', '.');
}
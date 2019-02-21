<?php namespace ProcessWire;
// get_row_details_specials.php
// print_r($_GET);
// header('Content-type: application/json; charset=utf-8');
// session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
include("/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/index.php"); 
// iterate over every row
$entry = 1;
// $forms = wire('forms');
$form = $forms->get('specials_upload');

$entries = array();
foreach($form->entries()->find("sort=created") as $entry) {
  $entries[] = $entry;
}
print_r($entries);

foreach($entries as $entry){
  // for every field in the result..
  $insert = "INSERT INTO `team`.`rates_combined` VALUES ('','" . $entry['cap_id'] . "', '" . $entry['cap_code'] . "', '" . $entry['source'] . "', NOW(), '" . $entry['expired'] . "', '" . (stripos($entry['manufacturer'], 'mercedes' ) === FALSE?$entry['manufacturer']:"MERCEDES") . "', '" . $entry['model'] . "', '" . $entry['description_1'] . "', '" . $entry['term'] . "', '" . $entry['mileage'] . "', '" . $entry['rental'] . "', '" . $entry['vehicle_list_price'] . "', '" . $entry['vehicle_otr_price'] . "', '" . $entry['p11d_price'] . "', '" . $entry['co2'] . "', '" . $entry['lcv'] . "', 1, '" . $entry['deal_notes'] . "', '" . $entry['upfront'] . "', '" . (!empty($entry['special_upfront'])?str_replace(',','',$entry['special_upfront']):'') . "', '" . (!empty($entry['website_deal_notes'])?$entry['website_deal_notes']:'') . "', '" . (!empty($entry['biz_only'])?$entry['biz_only']:'') . "')";
  echo $insert;
  $result = $conn->query($insert) or die(mysqli_error($conn));
  $entry++;
}
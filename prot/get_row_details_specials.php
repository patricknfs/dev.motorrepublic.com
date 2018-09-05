<?php
// get_row_details.php
// print_r($_GET);
header('Content-type: application/json; charset=utf-8');
session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php';

// iterate over every row
$row = 1;

$form = $forms->get('specials_upload');

$entries = array();
foreach($form->entries()->find("sort=created") as $entry) {
  $entries[] = $entry;
}

foreach($entries as $entry){
  echo "<p>$entry[something_name]</p>";
}

  // for every field in the result..
//   $insert = "INSERT INTO `team`.`rates_combined` VALUES ('','" . $row['cap_id'] . "', '" . $row['cap_code'] . "', '" . $row['source'] . "', '" . $row['manufacturer'] . "', '" . $row['model'] . "', '" . $row['descr'] . "', '" . $row['term'] . "', '" . $row['mileage'] . "', '" . $row['rental'] . "', '" . $row['vehicle_list'] . "', '" . $row['vehicle_otr'] . "', '" . $row['p11d'] . "', '" . $row['CO2_no'] . "')";
//   $result3 = $conn->query($insert) or die(mysqli_error($conn));
//   $row++;
// }

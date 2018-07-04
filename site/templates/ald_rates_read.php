#!/usr/bin/php
<?php

// ALD ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR ALD CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_ald`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$csv = "inc/ald_rates_cars_8k.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    print_r($rawsdata);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    $data = str_replace('£','',$data);
    $data = str_replace('#N/A',NULL,$data);
    if($row > 2){
      switch($data[1]){
        case 8000:
        echo $data[12];
        switch($data[0]){
          case 24:
          $insert = "`24_8K_PA_rental` = " . $data[12] . ", `24_8K_PA_service` = " . ($data[12]-$data[11]);
          break;
          case 36:
          $insert = "`36_8K_PA_rental` = " . $data[12] . ", `36_8K_PA_service` = " . ($data[12]-$data[11]);
          break;
          case 48:
          $insert = "`48_8K_PA_rental` = " . $data[12] . ", `48_8K_PA_service` = " . ($data[12]-$data[11]);
          break;
          case 60:
          $insert = "`60_8K_PA_rental` = " . $data[12] . ", `60_8K_PA_service` = " . ($data[12]-$data[11]);
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ald`
        SET
        `cap_id` = 'test',
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
          `cap_id` = " . $data[24];
      }
      echo $update . "<br />";
      // $result2 = mysqli_query($conn, $update);
    }
    $row++;
  }
  $AdminMessage .= $num . " rows inserted\n";
  mail($adminEmail,"MR ALD Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR ALD rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
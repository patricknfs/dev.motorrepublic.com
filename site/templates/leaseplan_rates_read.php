#!/usr/bin/php
<?php

// leaseplan ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Leaseplan CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_leaseplan`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$csv = "repos/leaseplan_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($rawdata);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row > 1){
      switch($data[13]){
        case 8000:
        switch($data[12]){
          case 24:
          $insert = "`24_8K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`24_8K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 36:
          $insert = "`36_8K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`36_8K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 48:
          $insert = "`48_8K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`48_8K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 60:
          $insert = "`60_8K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`60_8K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = '" . $data[0] . "',
        `CO2` = '" . $data[9] . "',
        `vehicle_list_price` = '" . $data[10] . "',
        `vehicle_otr_price` = '0.00',
        `p11d_price` = '" . $data[8] . "',
        `updated` = NOW(),
        `lcv` = '" . ((substr($data[1], -1) == 'L')?1:0) . "',
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        switch($data[12]){
          case 24:
          $insert = "`24_10K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`24_10K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 36:
          $insert = "`36_10K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`36_10K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 48:
          $insert = "`48_10K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`48_10K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 60:
          $insert = "`60_10K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`60_10K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = '" . $data[0] . "',
        `CO2` = '" . $data[9] . "',
        `vehicle_list_price` = '" . $data[10] . "',
        `vehicle_otr_price` = '0.00',
        `p11d_price` = '" . $data[8] . "',
        `updated` = NOW(),
        `lcv` = '" . ((substr($data[1], -1) == 'L')?1:0) . "',
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 15000:
        switch($data[12]){
          case 24:
          $insert = "`24_15K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`24_15K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 36:
          $insert = "`36_15K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`36_15K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 48:
          $insert = "`48_15K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`48_15K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 60:
          $insert = "`60_15K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`60_15K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = '" . $data[0] . "',
        `CO2` = '" . $data[9] . "',
        `vehicle_list_price` = '" . $data[10] . "',
        `vehicle_otr_price` = '0.00',
        `p11d_price` = '" . $data[8] . "',
        `updated` = NOW(),
        `lcv` = '" . ((substr($data[1], -1) == 'L')?1:0) . "',
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        switch($data[12]){
          case 24:
          $insert = "`24_20K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`24_20K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 36:
          $insert = "`36_20K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`36_20K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 48:
          $insert = "`48_20K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`48_20K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 60:
          $insert = "`60_20K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`60_20K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = '" . $data[0] . "',
        `CO2` = '" . $data[9] . "',
        `vehicle_list_price` = '" . $data[10] . "',
        `vehicle_otr_price` = '0.00',
        `p11d_price` = '" . $data[8] . "',
        `updated` = NOW(),
        `lcv` = '" . ((substr($data[1], -1) == 'L')?1:0) . "',
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        switch($data[12]){
          case 24:
          $insert = "`24_25K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`24_25K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 36:
          $insert = "`36_25K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`36_25K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 48:
          $insert = "`48_25K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`48_25K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 60:
          $insert = "`60_25K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`60_25K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = '" . $data[0] . "',
        `CO2` = '" . $data[9] . "',
        `vehicle_list_price` = '" . $data[10] . "',
        `vehicle_otr_price` = '0.00',
        `p11d_price` = '" . $data[8] . "',
        `updated` = NOW(),
        `lcv` = '" . ((substr($data[1], -1) == 'L')?1:0) . "',
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        switch($data[12]){
          case 24:
          $insert = "`24_30K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`24_30K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 36:
          $insert = "`36_30K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`36_30K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 48:
          $insert = "`48_30K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`48_30K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          case 60:
          $insert = "`60_30K_PA_rental_nm` = '" . ($data[17]) . "'";
          $insert .= ",`60_30K_PA_rental_m` = '" . ($data[17]+$data[18]) . "'";
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = '" . $data[0] . "',
        `CO2` = '" . $data[9] . "',
        `vehicle_list_price` = '" . $data[10] . "',
        `vehicle_otr_price` = '0.00',
        `p11d_price` = '" . $data[8] . "',
        `updated` = NOW(),
        `lcv` = '" . ((substr($data[1], -1) == 'L')?1:0) . "',
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        default;
        echo "Ratebook fault";
      }
      echo $update;      
      $result2 = mysqli_query($conn, $update);
    }
    $row++;
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  $AdminMessage .= "First pass upload"; 
  mail($adminEmail,"MR Leaseplan Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Leaseplan rates csv first pass upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
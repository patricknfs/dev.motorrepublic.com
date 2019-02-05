#!/usr/bin/php
<?php

// Lex ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Lex CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_lex`";
$result = mysqli_query($conn, $truncate);

$row = 1;
$csv = "repos/lex_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($rawdata);
    $num = count($rawdata);
    // $data = preg_replace('/\s+/', '', $rawdata);
    $data = $rawdata;
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row >= 2){
      $data22 = str_replace(',','',$data[22]);
      $data9 = str_replace(',','',$data[9]);
      $cap_query = "SELECT `cap_id` FROM `team`.`vehicles` WHERE `cap_code` = '" . trim($data[0]) . "' LIMIT 1";
      // echo $cap_query . "</n>";
      $cap_result = mysqli_query($conn, $cap_query);
      $cap_row = mysqli_fetch_assoc($cap_result);
      $capid = $cap_row['cap_id'];

      switch($data[8]){
        case 8000:
        switch($data[7]){
          case 24:
          $insert = "`24_8K_PA_rental_m` = " . $data9 . ", `24_8K_PA_rental_nm` = " . $data22;
          break;
          case 36:
          $insert = "`36_8K_PA_rental_m` = " . $data9 . ", `36_8K_PA_rental_nm` = " . $data22;
          break;
          case 48:
          $insert = "`48_8K_PA_rental_m` = " . $data9 . ", `48_8K_PA_rental_nm` = " . $data22;
          break;
          case 60:
          $insert = "`60_8K_PA_rental_m` = " . $data9 . ", `60_8K_PA_rental_nm` = " . $data22;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = " . $capid . ",
        `CO2` = " . $data[5]. ",
        `vehicle_list_price` = " . $data[15] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        switch($data[7]){
          case 24:
          $insert = "`24_10K_PA_rental_m` = " . $data9 . ", `24_10K_PA_rental_nm` = " . $data22;
          break;
          case 36:
          $insert = "`36_10K_PA_rental_m` = " . $data9 . ", `36_10K_PA_rental_nm` = " . $data22;
          break;
          case 48:
          $insert = "`48_10K_PA_rental_m` = " . $data9 . ", `48_10K_PA_rental_nm` = " . $data22;
          break;
          case 60:
          $insert = "`60_10K_PA_rental_m` = " . $data9 . ", `60_10K_PA_rental_nm` = " . $data22;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = " . $capid . ",
        `CO2` = " . $data[5]. ",
        `vehicle_list_price` = " . $data[15] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break; 
        case 15000:
        switch($data[7]){
          case 24:
          $insert = "`24_15K_PA_rental_m` = " . $data9 . ", `24_15K_PA_rental_nm` = " . $data22;
          break;
          case 36:
          $insert = "`36_15K_PA_rental_m` = " . $data9 . ", `36_15K_PA_rental_nm` = " . $data22;
          break;
          case 48:
          $insert = "`48_15K_PA_rental_m` = " . $data9 . ", `48_15K_PA_rental_nm` = " . $data22;
          break;
          case 60:
          $insert = "`60_15K_PA_rental_m` = " . $data9 . ", `60_15K_PA_rental_nm` = " . $data22;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = " . $capid . ",
        `CO2` = " . $data[5]. ",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        switch($data[7]){
          case 24:
          $insert = "`24_20K_PA_rental_m` = " . $data9 . ", `24_20K_PA_rental_nm` = " . $data22;
          break;
          case 36:
          $insert = "`36_20K_PA_rental_m` = " . $data9 . ", `36_20K_PA_rental_nm` = " . $data22;
          break;
          case 48:
          $insert = "`48_20K_PA_rental_m` = " . $data9 . ", `48_20K_PA_rental_nm` = " . $data22;
          break;
          case 60:
          $insert = "`60_20K_PA_rental_m` = " . $data9 . ", `60_20K_PA_rental_nm` = " . $data22;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = " . $capid . ",
        `CO2` = " . $data[5]. ",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        switch($data[7]){
          case 24:
          $insert = "`24_25K_PA_rental_m` = " . $data9 . ", `24_25K_PA_rental_nm` = " . $data22;
          break;
          case 36:
          $insert = "`36_25K_PA_rental_m` = " . $data9 . ", `36_25K_PA_rental_nm` = " . $data22;
          break;
          case 48:
          $insert = "`48_25K_PA_rental_m` = " . $data9 . ", `48_25K_PA_rental_nm` = " . $data22;
          break;
          case 60:
          $insert = "`60_25K_PA_rental_m` = " . $data9 . ", `60_25K_PA_rental_nm` = " . $data22;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = " . $capid . ",
        `CO2` = " . $data[5]. ",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        $data22 = str_replace(',','',$data[11]);
        $data9 = str_replace(',','',$data[12]);
        switch($data[7]){
          case 24:
          $insert = "`24_30K_PA_rental_m` = " . $data9 . ", `24_30K_PA_rental_nm` = " . $data22;
          break;
          case 36:
          $insert = "`36_30K_PA_rental_m` = " . $data9 . ", `36_30K_PA_rental_nm` = " . $data22;
          break;
          case 48:
          $insert = "`48_30K_PA_rental_m` = " . $data9 . ", `48_30K_PA_rental_nm` = " . $data22;
          break;
          case 60:
          $insert = "`60_30K_PA_rental_m` = " . $data9 . ", `60_30K_PA_rental_nm` = " . $data22;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = " . $capid . ",
        `CO2` = " . $data[5]. ",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        default;
        echo "Ratebook fault";
      }
      echo $update . "<br />";
      $result = mysqli_query($conn, $update);
    }
    $row++;
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  mail($adminEmail,"MR Lex Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Lex rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
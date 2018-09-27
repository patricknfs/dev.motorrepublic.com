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
$csv = "inc/lex_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($rawdata);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row > 2){
      $data11 = str_replace(',','',$data[11]);
      $data12 = str_replace(',','',$data[12]);
      switch($data[8]){
        case 8000:
        switch($data[7]){
          case 24:
          $insert = "`24_8K_PA_rental_m` = " . $data12 . ", `24_8K_PA_rental_nm` = " . $data11;
          break;
          case 36:
          $insert = "`36_8K_PA_rental_m` = " . $data12 . ", `36_8K_PA_rental_nm` = " . $data11;
          break;
          case 48:
          $insert = "`48_8K_PA_rental_m` = " . $data12 . ", `48_8K_PA_rental_nm` = " . $data11;
          break;
          case 60:
          $insert = "`60_8K_PA_rental_m` = " . $data12 . ", `60_8K_PA_rental_nm` = " . $data11;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = "",
        `vehicle_list_price` = " . $data[15] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        switch($data[7]){
          case 24:
          $insert = "`24_10K_PA_rental_m` = " . $data12 . ", `24_10K_PA_rental_nm` = " . $data11;
          break;
          case 36:
          $insert = "`36_10K_PA_rental_m` = " . $data12 . ", `36_10K_PA_rental_nm` = " . $data11;
          break;
          case 48:
          $insert = "`48_10K_PA_rental_m` = " . $data12 . ", `48_10K_PA_rental_nm` = " . $data11;
          break;
          case 60:
          $insert = "`60_10K_PA_rental_m` = " . $data12 . ", `60_10K_PA_rental_nm` = " . $data11;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = "",
        `vehicle_list_price` = " . $data[15] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break; 
        case 15000:
        switch($data[7]){
          case 24:
          $insert = "`24_15K_PA_rental_m` = " . $data12 . ", `24_15K_PA_rental_nm` = " . $data11;
          break;
          case 36:
          $insert = "`36_15K_PA_rental_m` = " . $data12 . ", `36_15K_PA_rental_nm` = " . $data11;
          break;
          case 48:
          $insert = "`48_15K_PA_rental_m` = " . $data12 . ", `48_15K_PA_rental_nm` = " . $data11;
          break;
          case 60:
          $insert = "`60_15K_PA_rental_m` = " . $data12 . ", `60_15K_PA_rental_nm` = " . $data11;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = "",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        switch($data[7]){
          case 24:
          $insert = "`24_20K_PA_rental_m` = " . $data12 . ", `24_20K_PA_rental_nm` = " . $data11;
          break;
          case 36:
          $insert = "`36_20K_PA_rental_m` = " . $data12 . ", `36_20K_PA_rental_nm` = " . $data11;
          break;
          case 48:
          $insert = "`48_20K_PA_rental_m` = " . $data12 . ", `48_20K_PA_rental_nm` = " . $data11;
          break;
          case 60:
          $insert = "`60_20K_PA_rental_m` = " . $data12 . ", `60_20K_PA_rental_nm` = " . $data11;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = "",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        switch($data[7]){
          case 24:
          $insert = "`24_25K_PA_rental_m` = " . $data12 . ", `24_25K_PA_rental_nm` = " . $data11;
          break;
          case 36:
          $insert = "`36_25K_PA_rental_m` = " . $data12 . ", `36_25K_PA_rental_nm` = " . $data11;
          break;
          case 48:
          $insert = "`48_25K_PA_rental_m` = " . $data12 . ", `48_25K_PA_rental_nm` = " . $data11;
          break;
          case 60:
          $insert = "`60_25K_PA_rental_m` = " . $data12 . ", `60_25K_PA_rental_nm` = " . $data11;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = "",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        $data11 = str_replace(',','',$data[11]);
        $data12 = str_replace(',','',$data[12]);
        switch($data[7]){
          case 24:
          $insert = "`24_30K_PA_rental_m` = " . $data12 . ", `24_30K_PA_rental_nm` = " . $data11;
          break;
          case 36:
          $insert = "`36_30K_PA_rental_m` = " . $data12 . ", `36_30K_PA_rental_nm` = " . $data11;
          break;
          case 48:
          $insert = "`48_30K_PA_rental_m` = " . $data12 . ", `48_30K_PA_rental_nm` = " . $data11;
          break;
          case 60:
          $insert = "`60_30K_PA_rental_m` = " . $data12 . ", `60_30K_PA_rental_nm` = " . $data11;
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_lex`
        SET
        `cap_id` = "",
        `vehicle_list_price` = " . $data[17] . ",
        `p11d_price` = " . $data[6] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        default;
        echo "Ratebook fault";
      }
      // echo $update . "<br />";
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
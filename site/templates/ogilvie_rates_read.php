#!/usr/bin/php
<?php

// Oguilvie ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Ogilvie CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_ogilvie`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$csv = "inc/ogilvie_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    switch($data[22]){
      case 24:
      switch($data[23]){
        case 16000:
        $mileage = 8000;
        break;
        case 20000:
        $mileage = 10000;
        break;
        case 30000:
        $mileage = 15000;
        break;
        case 40000:
        $mileage = 20000;
        break;
        case 50000:
        $mileage = 25000;
        break;
        case 60000:
        $mileage = 30000;
        break;
        default:
        echo $data[23] . "mileage profile is not coded into 24 month mileage specifier";
      }
      break;
      case 36:
      switch($data[23]){
        case 24000:
        $mileage = 8000;
        break;
        case 30000:
        $mileage = 10000;
        break;
        case 45000:
        $mileage = 15000;
        break;
        case 60000:
        $mileage = 20000;
        break;
        case 75000:
        $mileage = 25000;
        break;
        case 90000:
        $mileage = 30000;
        break;
        default:
        echo $data[23] . "mileage profile is not coded into 36 month mileage specifier";
      }
      break;
      case 48:
      switch($data[23]){
        case 32000:
        $mileage = 8000;
        break;
        case 40000:
        $mileage = 10000;
        break;
        case 60000:
        $mileage = 15000;
        break;
        case 80000:
        $mileage = 20000;
        break;
        case 100000:
        $mileage = 25000;
        break;
        case 120000:
        $mileage = 30000;
        break;
        default:
        echo $data[23] . "mileage profile is not coded into 48 month mileage specifier";
      }
      break;
      default:
      echo $data[22] . "monthly profile not coded";
    }
    if($row > 2){
      switch($mileage){
        case 8000:
        switch($data[22]){
          case 24:
          $insert = "`24_8K_PA_rental_m` = " . $data[11] . ", `24_8K_PA_rental_nm` = " . $data[9];
          break;
          case 36:
          $insert = "`36_8K_PA_rental_m` = " . $data[11] . ", `36_8K_PA_rental_nm` = " . $data[9];
          break;
          case 48:
          $insert = "`48_8K_PA_rental_m` = " . $data[11] . ", `48_8K_PA_rental_nm` = " . $data[9];
          break;
          case 60:
          $insert = "`60_8K_PA_rental_m` = " . $data[11] . ", `60_8K_PA_rental_nm` = " . $data[9];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ogilvie`
        SET
        `cap_id` = " . $data[2] . ",
        `CO2` = " . $data[14] . ",
        `vehicle_list_price` = " . $data[7] . ",
        `vehicle_otr_price` = '',
        `p11d_price` = '',
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        switch($data[22]){
          case 24:
          $insert = "`24_10K_PA_rental_m` = " . $data[11] . ", `24_10K_PA_rental_nm` = " . $data[9];
          break;
          case 36:
          $insert = "`36_10K_PA_rental_m` = " . $data[11] . ", `36_10K_PA_rental_nm` = " . $data[9];
          break;
          case 48:
          $insert = "`48_10K_PA_rental_m` = " . $data[11] . ", `48_10K_PA_rental_nm` = " . $data[9];
          break;
          case 60:
          $insert = "`60_10K_PA_rental_m` = " . $data[11] . ", `60_10K_PA_rental_nm` = " . $data[9];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ogilvie`
        SET
        `cap_id` = " . $data[2] . ",
        `CO2` = " . $data[14] . ",
        `vehicle_list_price` = " . $data[7] . ",
        `vehicle_otr_price` = "0",
        `p11d_price` = " . $data[8] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break; 
        case 15000:
        switch($data[22]){
          case 24:
          $insert = "`24_15K_PA_rental_m` = " . $data[11] . ", `24_15K_PA_rental_nm` = " . $data[9];
          break;
          case 36:
          $insert = "`36_15K_PA_rental_m` = " . $data[11] . ", `36_15K_PA_rental_nm` = " . $data[9];
          break;
          case 48:
          $insert = "`48_15K_PA_rental_m` = " . $data[11] . ", `48_15K_PA_rental_nm` = " . $data[9];
          break;
          case 60:
          $insert = "`60_15K_PA_rental_m` = " . $data[11] . ", `60_15K_PA_rental_nm` = " . $data[9];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ogilvie`
        SET
        `cap_id` = " . $data[2] . ",
        `CO2` = " . $data[14] . ",
        `vehicle_list_price` = " . $data[7] . ",
        `vehicle_otr_price` = "0",
        `p11d_price` = " . $data[8] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        switch($data[22]){
          case 24:
          $insert = "`24_20K_PA_rental_m` = " . $data[11] . ", `24_20K_PA_rental_nm` = " . $data[9];
          break;
          case 36:
          $insert = "`36_20K_PA_rental_m` = " . $data[11] . ", `36_20K_PA_rental_nm` = " . $data[9];
          break;
          case 48:
          $insert = "`48_20K_PA_rental_m` = " . $data[11] . ", `48_20K_PA_rental_nm` = " . $data[9];
          break;
          case 60:
          $insert = "`60_20K_PA_rental_m` = " . $data[11] . ", `60_20K_PA_rental_nm` = " . $data[9];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ogilvie`
        SET
        `cap_id` = " . $data[2] . ",
        `CO2` = " . $data[14] . ",
        `vehicle_list_price` = " . $data[7] . ",
        `vehicle_otr_price` = "0",
        `p11d_price` = " . $data[8] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        switch($data[22]){
          case 24:
          $insert = "`24_25K_PA_rental_m` = " . $data[11] . ", `24_25K_PA_rental_nm` = " . $data[9];
          break;
          case 36:
          $insert = "`36_25K_PA_rental_m` = " . $data[11] . ", `36_25K_PA_rental_nm` = " . $data[9];
          break;
          case 48:
          $insert = "`48_25K_PA_rental_m` = " . $data[11] . ", `48_25K_PA_rental_nm` = " . $data[9];
          break;
          case 60:
          $insert = "`60_25K_PA_rental_m` = " . $data[11] . ", `60_25K_PA_rental_nm` = " . $data[9];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ogilvie`
        SET
        `cap_id` = " . $data[2] . ",
        `CO2` = " . $data[14] . ",
        `vehicle_list_price` = " . $data[7] . ",
        `vehicle_otr_price` = "0",
        `p11d_price` = " . $data[8] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        $data[9] = str_replace(',','',$data[11]);
        $data[11] = str_replace(',','',$data[12]);
        switch($data[22]){
          case 24:
          $insert = "`24_30K_PA_rental_m` = " . $data[11] . ", `24_30K_PA_rental_nm` = " . $data[9];
          break;
          case 36:
          $insert = "`36_30K_PA_rental_m` = " . $data[11] . ", `36_30K_PA_rental_nm` = " . $data[9];
          break;
          case 48:
          $insert = "`48_30K_PA_rental_m` = " . $data[11] . ", `48_30K_PA_rental_nm` = " . $data[9];
          break;
          case 60:
          $insert = "`60_30K_PA_rental_m` = " . $data[11] . ", `60_30K_PA_rental_nm` = " . $data[9];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_ogilvie`
        SET
        `cap_id` = " . $data[2] . ",
        `CO2` = " . $data[14] . ",
        `vehicle_list_price` = " . $data[16] . ",
        `vehicle_otr_price` = "0",
        `p11d_price` = " . $data[8] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        default;
        echo "Ratebook fault";
      }
      echo $update . "<br />";
      // $result = mysqli_query($conn, $update);
    }
    $row++;
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  mail($adminEmail,"MR Ogilvie Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Ogilvie rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
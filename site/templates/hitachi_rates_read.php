#!/usr/bin/php
<?php

// hitachi ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Hitachi CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_hitachi`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$csv = "repos/hitachi_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($rawdata);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row > 1){
      switch($data[16]){
        case 24:
        switch($data[17]){
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
          echo $data[17] . "mileage profile is not coded into 24 month mileage specifier";
        }
        break;
        case 36:
        switch($data[17]){
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
          echo $data[17] . "mileage profile is not coded into 36 month mileage specifier";
        }
        break;
        case 48:
        switch($data[17]){
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
          echo $data[17] . "mileage profile is not coded into 48 month mileage specifier";
        }
        break;
        default:
        echo $data[11] . "monthly profile not coded";
      }
      switch($mileage){
        case 8000:
        if($data[15] == 0){
          switch($data[11]){
            case 24:
            $insert = "`24_8K_PA_rental_nm` = " . ($data[14]);
            break;
            case 36:
            $insert = "`36_8K_PA_rental_nm` = " . ($data[14]);
            break;
            case 48:
            $insert = "`48_8K_PA_rental_nm` = " . ($data[14]);
            break;
            case 60:
            $insert = "`60_8K_PA_rental_nm` = " . ($data[14]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[11]){
            case 24:
            $insert = "`24_8K_PA_rental_m` = " . $data[20];
            break;
            case 36:
            $insert = "`36_8K_PA_rental_m` = " . $data[20];
            break;
            case 48:
            $insert = "`48_8K_PA_rental_m` = " . $data[20];
            break;
            case 60:
            $insert = "`60_8K_PA_rental_m` = " . $data[20];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_hitachi`
        SET
        `cap_id` = " . $data[0] . ",
        `CO2` = " . $data[9] . ",
        `vehicle_list_price` = " . $data[11] . ",
        `vehicle_otr_price` = " . $data[14] . ",
        `p11d_price` = " . $data[15] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[1], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        if($data[15] == 0){
          switch($data[11]){
            case 24:
            $insert = "`24_10K_PA_rental_nm` = " . ($data[14]);
            break;
            case 36:
            $insert = "`36_10K_PA_rental_nm` = " . ($data[14]);
            break;
            case 48:
            $insert = "`48_10K_PA_rental_nm` = " . ($data[14]);
            break;
            case 60:
            $insert = "`60_10K_PA_rental_nm` = " . ($data[14]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[11]){
            case 24:
            $insert = "`24_10K_PA_rental_m` = " . $data[20];
            break;
            case 36:
            $insert = "`36_10K_PA_rental_m` = " . $data[20];
            break;
            case 48:
            $insert = "`48_10K_PA_rental_m` = " . $data[20];
            break;
            case 60:
            $insert = "`60_10K_PA_rental_m` = " . $data[20];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_hitachi`
        SET
        `cap_id` = " . $data[0] . ",
        `CO2` = " . $data[9] . ",
        `vehicle_list_price` = " . $data[11] . ",
        `vehicle_otr_price` = " . $data[14] . ",
        `p11d_price` = " . $data[15] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[1], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 15000:
        if($data[15] == 0){
          switch($data[11]){
            case 24:
            $insert = "`24_15K_PA_rental_nm` = " . ($data[20]);
            break;
            case 36:
            $insert = "`36_15K_PA_rental_nm` = " . ($data[20]);
            break;
            case 48:
            $insert = "`48_15K_PA_rental_nm` = " . ($data[20]);
            break;
            case 60:
            $insert = "`60_15K_PA_rental_nm` = " . ($data[20]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[11]){
            case 24:
            $insert = "`24_15K_PA_rental_m` = " . $data[14];
            break;
            case 36:
            $insert = "`36_15K_PA_rental_m` = " . $data[14];
            break;
            case 48:
            $insert = "`48_15K_PA_rental_m` = " . $data[14];
            break;
            case 60:
            $insert = "`60_15K_PA_rental_m` = " . $data[14];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_hitachi`
        SET
        `cap_id` = " . $data[0] . ",
        `CO2` = " . $data[9] . ",
        `vehicle_list_price` = " . $data[11] . ",
        `vehicle_otr_price` = " . $data[14] . ",
        `p11d_price` = " . $data[15] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[1], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        if($data[15] == 0){
          switch($data[11]){
            case 24:
            $insert = "`24_20K_PA_rental_nm` = " . ($data[14]);
            break;
            case 36:
            $insert = "`36_20K_PA_rental_nm` = " . ($data[14]);
            break;
            case 48:
            $insert = "`48_20K_PA_rental_nm` = " . ($data[14]);
            break;
            case 60:
            $insert = "`60_20K_PA_rental_nm` = " . ($data[14]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[11]){
            case 24:
            $insert = "`24_20K_PA_rental_m` = " . $data[20];
            break;
            case 36:
            $insert = "`36_20K_PA_rental_m` = " . $data[20];
            break;
            case 48:
            $insert = "`48_20K_PA_rental_m` = " . $data[20];
            break;
            case 60:
            $insert = "`60_20K_PA_rental_m` = " . $data[20];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_hitachi`
        SET
        `cap_id` = " . $data[0] . ",
        `CO2` = " . $data[9] . ",
        `vehicle_list_price` = " . $data[11] . ",
        `vehicle_otr_price` = " . $data[14] . ",
        `p11d_price` = " . $data[15] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[1], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        if($data[15] == 0){
          switch($data[11]){
            case 24:
            $insert = "`24_25K_PA_rental_nm` = " . ($data[14]);
            break;
            case 36:
            $insert = "`36_25K_PA_rental_nm` = " . ($data[14]);
            break;
            case 48:
            $insert = "`48_25K_PA_rental_nm` = " . ($data[14]);
            break;
            case 60:
            $insert = "`60_25K_PA_rental_nm` = " . ($data[14]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[11]){
            case 24:
            $insert = "`24_25K_PA_rental_m` = " . $data[20];
            break;
            case 36:
            $insert = "`36_25K_PA_rental_m` = " . $data[20];
            break;
            case 48:
            $insert = "`48_25K_PA_rental_m` = " . $data[20];
            break;
            case 60:
            $insert = "`60_25K_PA_rental_m` = " . $data[20];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_hitachi`
        SET
        `cap_id` = " . $data[0] . ",
        `CO2` = " . $data[9] . ",
        `vehicle_list_price` = " . $data[11] . ",
        `vehicle_otr_price` = " . $data[14] . ",
        `p11d_price` = " . $data[15] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[1], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        if($data[15] == 0){
          switch($data[11]){
            case 24:
            $insert = "`24_30K_PA_rental_nm` = " . ($data[14]);
            break;
            case 36:
            $insert = "`36_30K_PA_rental_nm` = " . ($data[14]);
            break;
            case 48:
            $insert = "`48_30K_PA_rental_nm` = " . ($data[14]);
            break;
            case 60:
            $insert = "`60_30K_PA_rental_nm` = " . ($data[14]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[11]){
            case 24:
            $insert = "`24_30K_PA_rental_m` = " . $data[20];
            break;
            case 36:
            $insert = "`36_30K_PA_rental_m` = " . $data[20];
            break;
            case 48:
            $insert = "`48_30K_PA_rental_m` = " . $data[20];
            break;
            case 60:
            $insert = "`60_30K_PA_rental_m` = " . $data[20];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_hitachi`
        SET
        `cap_id` = " . $data[0] . ",
        `CO2` = " . $data[9] . ",
        `vehicle_list_price` = " . $data[11] . ",
        `vehicle_otr_price` = " . $data[14] . ",
        `p11d_price` = " . $data[15] . ",
        `updated` = NOW(),
        `lcv` = " . ((substr($data[1], -1) == 'L')?1:0) . ",
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        default;
        echo "Ratebook fault";
      }
      echo $update . "\n";
      $result2 = mysqli_query($conn, $update);
    }
    $row++;
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  $AdminMessage .= "First pass upload"; 
  mail($adminEmail,"MR Hitachi Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Hitachi rates csv first pass upload","The csv upload has failed for some reason","From: MR Server");
}
// Second pass
if (($handle2 = fopen($csv , "r")) !== FALSE) {
  while (($rawdata2 = fgetcsv($handle2, 0, ",")) !== FALSE) {
    $data2 = preg_replace('/\s+/', '', $rawdata2);
    if($row > 1){
      if($data2[26] != 0){
        switch($data2[24]){
          case 24:
          switch($data2[25]){
            case 16000:
            $mileage2 = 8000;
            break;
            case 20000:
            $mileage2 = 10000;
            break;
            case 30000:
            $mileage2 = 15000;
            break;
            case 40000:
            $mileage2 = 20000;
            break;
            case 50000:
            $mileage2 = 25000;
            break;
            case 60000:
            $mileage2 = 30000;
            break;
            default:
            echo $data2[25] . "mileage profile is not coded into 24 month mileage specifier";
          }
          break;
          case 36:
          switch($data2[25]){
            case 24000:
            $mileage2 = 8000;
            break;
            case 30000:
            $mileage2 = 10000;
            break;
            case 45000:
            $mileage2 = 15000;
            break;
            case 60000:
            $mileage2 = 20000;
            break;
            case 75000:
            $mileage2 = 25000;
            break;
            case 90000:
            $mileage2 = 30000;
            break;
            default:
            echo $data2[25] . "mileage profile is not coded into 36 month mileage specifier";
          }
          break;
          case 48:
          switch($data2[25]){
            case 32000:
            $mileage2 = 8000;
            break;
            case 40000:
            $mileage2 = 10000;
            break;
            case 60000:
            $mileage2 = 15000;
            break;
            case 80000:
            $mileage2 = 20000;
            break;
            case 100000:
            $mileage2 = 25000;
            break;
            case 120000:
            $mileage2 = 30000;
            break;
            default:
            echo $data2[25] . "mileage profile is not coded into 48 month mileage specifier";
          }
          break;
          default:
          echo $data2[24] . "monthly profile not coded";
        }
        switch($mileage2){
          case 8000:
          if($data2[27] == 0){
            switch($data2[24]){
              case 24:
              $insert = "`24_8K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 36:
              $insert = "`36_8K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 48:
              $insert = "`48_8K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 60:
              $insert = "`60_8K_PA_rental_nm` = " . ($data2[26]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[24]){
              case 24:
              $insert = "`24_8K_PA_rental_m` = " . $data2[28];
              break;
              case 36:
              $insert = "`36_8K_PA_rental_m` = " . $data2[28];
              break;
              case 48:
              $insert = "`48_8K_PA_rental_m` = " . $data2[28];
              break;
              case 60:
              $insert = "`60_8K_PA_rental_m` = " . $data2[28];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_hitachi`
          SET
          `cap_id` = " . $data2[0] . ",
          `CO2` = " . $data2[14] . ",
          `vehicle_list_price` = " . $data2[16] . ",
          `vehicle_otr_price` = " . $data2[18] . ",
          `p11d_price` = " . $data2[19] . ",
          `updated` = NOW(),
          `lcv` = " . ((substr($data2[1], -1) == 'L')?1:0) . ",
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 10000:
          if($data2[31] == 0){
            switch($data2[24]){
              case 24:
              $insert = "`24_10K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 36:
              $insert = "`36_10K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 48:
              $insert = "`48_10K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 60:
              $insert = "`60_10K_PA_rental_nm` = " . ($data2[26]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[24]){
              case 24:
              $insert = "`24_10K_PA_rental_m` = " . $data2[28];
              break;
              case 36:
              $insert = "`36_10K_PA_rental_m` = " . $data2[28];
              break;
              case 48:
              $insert = "`48_10K_PA_rental_m` = " . $data2[28];
              break;
              case 60:
              $insert = "`60_10K_PA_rental_m` = " . $data2[28];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_hitachi`
          SET
          `cap_id` = " . $data2[0] . ",
          `CO2` = " . $data2[14] . ",
          `vehicle_list_price` = " . $data2[16] . ",
          `vehicle_otr_price` = " . $data2[18] . ",
          `p11d_price` = " . $data2[19] . ",
          `updated` = NOW(),
          `lcv` = " . ((substr($data2[1], -1) == 'L')?1:0) . ",
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 15000:
          if($data2[31] == 0){
            switch($data2[24]){
              case 24:
              $insert = "`24_15K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 36:
              $insert = "`36_15K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 48:
              $insert = "`48_15K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 60:
              $insert = "`60_15K_PA_rental_nm` = " . ($data2[26]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[24]){
              case 24:
              $insert = "`24_15K_PA_rental_m` = " . $data2[28];
              break;
              case 36:
              $insert = "`36_15K_PA_rental_m` = " . $data2[28];
              break;
              case 48:
              $insert = "`48_15K_PA_rental_m` = " . $data2[28];
              break;
              case 60:
              $insert = "`60_15K_PA_rental_m` = " . $data2[28];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_hitachi`
          SET
          `cap_id` = " . $data2[0] . ",
          `CO2` = " . $data2[14] . ",
          `vehicle_list_price` = " . $data2[16] . ",
          `vehicle_otr_price` = " . $data2[18] . ",
          `p11d_price` = " . $data2[19] . ",
          `updated` = NOW(),
          `lcv` = " . ((substr($data2[1], -1) == 'L')?1:0) . ",
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 20000:
          if($data2[31] == 0){
            switch($data2[24]){
              case 24:
              $insert = "`24_20K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 36:
              $insert = "`36_20K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 48:
              $insert = "`48_20K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 60:
              $insert = "`60_20K_PA_rental_nm` = " . ($data2[26]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[24]){
              case 24:
              $insert = "`24_20K_PA_rental_m` = " . $data2[28];
              break;
              case 36:
              $insert = "`36_20K_PA_rental_m` = " . $data2[28];
              break;
              case 48:
              $insert = "`48_20K_PA_rental_m` = " . $data2[28];
              break;
              case 60:
              $insert = "`60_20K_PA_rental_m` = " . $data2[28];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_hitachi`
          SET
          `cap_id` = " . $data2[0] . ",
          `CO2` = " . $data2[14] . ",
          `vehicle_list_price` = " . $data2[16] . ",
          `vehicle_otr_price` = " . $data2[18] . ",
          `p11d_price` = " . $data2[19] . ",
          `updated` = NOW(),
          `lcv` = " . ((substr($data2[1], -1) == 'L')?1:0) . ",
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 25000:
          if($data2[31] == 0){
            switch($data2[24]){
              case 24:
              $insert = "`24_25K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 36:
              $insert = "`36_25K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 48:
              $insert = "`48_25K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 60:
              $insert = "`60_25K_PA_rental_nm` = " . ($data2[26]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[24]){
              case 24:
              $insert = "`24_25K_PA_rental_m` = " . $data2[28];
              break;
              case 36:
              $insert = "`36_25K_PA_rental_m` = " . $data2[28];
              break;
              case 48:
              $insert = "`48_25K_PA_rental_m` = " . $data2[28];
              break;
              case 60:
              $insert = "`60_25K_PA_rental_m` = " . $data2[28];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_hitachi`
          SET
          `cap_id` = " . $data2[0] . ",
          `CO2` = " . $data2[14] . ",
          `vehicle_list_price` = " . $data2[16] . ",
          `vehicle_otr_price` = " . $data2[18] . ",
          `p11d_price` = " . $data2[19] . ",
          `updated` = NOW(),
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          `lcv` = " . ((substr($data2[1], -1) == 'L')?1:0) . ",
          " . $insert . ";";
          break;
          case 30000:
          if($data2[31] == 0){
            switch($data2[24]){
              case 24:
              $insert = "`24_30K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 36:
              $insert = "`36_30K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 48:
              $insert = "`48_30K_PA_rental_nm` = " . ($data2[26]);
              break;
              case 60:
              $insert = "`60_30K_PA_rental_nm` = " . ($data2[26]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[24]){
              case 24:
              $insert = "`24_30K_PA_rental_m` = " . $data2[28];
              break;
              case 36:
              $insert = "`36_30K_PA_rental_m` = " . $data2[28];
              break;
              case 48:
              $insert = "`48_30K_PA_rental_m` = " . $data2[28];
              break;
              case 60:
              $insert = "`60_30K_PA_rental_m` = " . $data2[28];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_hitachi`
          SET
          `cap_id` = " . $data2[0] . ",
          `CO2` = " . $data2[14] . ",
          `vehicle_list_price` = " . $data2[16] . ",
          `vehicle_otr_price` = " . $data2[18] . ",
          `p11d_price` = " . $data2[19] . ",
          `updated` = NOW(),
          `lcv` = " . ((substr($data2[1], -1) == 'L')?1:0) . ",
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          default;
          echo "Ratebook fault";
        }
        echo $update . "\n";
        $result2 = mysqli_query($conn, $update);
      }
      $row++;
    }
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  $AdminMessage .= "Second pass upload"; 
  mail($adminEmail,"MR Hitachi Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle2);
}
else {
	mail($adminEmail,"Problem - MR Hitachi rates csv second pass upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
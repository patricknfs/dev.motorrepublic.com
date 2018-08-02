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
$csv = "inc/leaseplan_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($rawdata);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row > 1){
      switch($data[40]){
        case 24:
        switch($data[41]){
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
          echo $data[41] . "mileage profile is not coded into 24 month mileage specifier";
        }
        break;
        case 36:INSERT INTO `team`.`rates_lex` SET `cap_id` = ABARTH, `updated` = NOW(), `24_10K_PA_rental_m` = 433.22 ON DUPLICATE KEY UPDATE `updated` = NOW(), `24_10K_PA_rental_m` = 433.22;
        switch($data[41]){
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
          $mileage = 20000;INSERT INTO `team`.`rates_lex` SET `cap_id` = ABARTH, `updated` = NOW(), `24_10K_PA_rental_m` = 433.22 ON DUPLICATE KEY UPDATE `updated` = NOW(), `24_10K_PA_rental_m` = 433.22;
          break;
          case 75000:
          $mileage = 25000;
          break;
          case 90000:
          $mileage = 30000;
          break;
          default:
          echo $data[41] . "mileage profile is not coded into 36 month mileage specifier";
        }
        break;
        case 48:
        switch($data[41]){
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
          echo $data[41] . "mileage profile is not coded into 48 month mileage specifier";
        }
        break;
        default:
        echo $data[40] . "monthly profile not coded";
      }
      switch($mileage){
        case 8000:
        if($data[43] == 0){
          switch($data[40]){
            case 24:
            $insert = "`24_8K_PA_rental_nm` = " . ($data[47]);
            break;
            case 36:
            $insert = "`36_8K_PA_rental_nm` = " . ($data[47]);
            break;
            case 48:
            $insert = "`48_8K_PA_rental_nm` = " . ($data[47]);
            break;
            case 60:
            $insert = "`60_8K_PA_rental_nm` = " . ($data[47]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[40]){
            case 24:
            $insert = "`24_8K_PA_rental_m` = " . $data[47];
            break;
            case 36:
            $insert = "`36_8K_PA_rental_m` = " . $data[47];
            break;
            case 48:
            $insert = "`48_8K_PA_rental_m` = " . $data[47];
            break;
            case 60:
            $insert = "`60_8K_PA_rental_m` = " . $data[47];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = " . $data[1] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        if($data[43] == 0){
          switch($data[40]){
            case 24:
            $insert = "`24_10K_PA_rental_nm` = " . ($data[47]);
            break;
            case 36:
            $insert = "`36_10K_PA_rental_nm` = " . ($data[47]);
            break;
            case 48:
            $insert = "`48_10K_PA_rental_nm` = " . ($data[47]);
            break;
            case 60:
            $insert = "`60_10K_PA_rental_nm` = " . ($data[47]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[40]){
            case 24:
            $insert = "`24_10K_PA_rental_m` = " . $data[47];
            break;
            case 36:
            $insert = "`36_10K_PA_rental_m` = " . $data[47];
            break;
            case 48:
            $insert = "`48_10K_PA_rental_m` = " . $data[47];
            break;
            case 60:
            $insert = "`60_10K_PA_rental_m` = " . $data[47];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = " . $data[1] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 15000:
        if($data[43] == 0){
          switch($data[40]){
            case 24:
            $insert = "`24_15K_PA_rental_nm` = " . ($data[47]);
            break;
            case 36:
            $insert = "`36_15K_PA_rental_nm` = " . ($data[47]);
            break;
            case 48:
            $insert = "`48_15K_PA_rental_nm` = " . ($data[47]);
            break;
            case 60:
            $insert = "`60_15K_PA_rental_nm` = " . ($data[47]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[40]){
            case 24:
            $insert = "`24_15K_PA_rental_m` = " . $data[47];
            break;
            case 36:
            $insert = "`36_15K_PA_rental_m` = " . $data[47];
            break;
            case 48:
            $insert = "`48_15K_PA_rental_m` = " . $data[47];
            break;
            case 60:
            $insert = "`60_15K_PA_rental_m` = " . $data[47];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = " . $data[1] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        if($data[43] == 0){
          switch($data[40]){
            case 24:
            $insert = "`24_20K_PA_rental_nm` = " . ($data[47]);
            break;
            case 36:
            $insert = "`36_20K_PA_rental_nm` = " . ($data[47]);
            break;
            case 48:
            $insert = "`48_20K_PA_rental_nm` = " . ($data[47]);
            break;
            case 60:
            $insert = "`60_20K_PA_rental_nm` = " . ($data[47]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[40]){
            case 24:
            $insert = "`24_20K_PA_rental_m` = " . $data[47];
            break;
            case 36:
            $insert = "`36_20K_PA_rental_m` = " . $data[47];
            break;
            case 48:
            $insert = "`48_20K_PA_rental_m` = " . $data[47];
            break;
            case 60:
            $insert = "`60_20K_PA_rental_m` = " . $data[47];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = " . $data[1] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        if($data[43] == 0){
          switch($data[40]){
            case 24:
            $insert = "`24_25K_PA_rental_nm` = " . ($data[47]);
            break;
            case 36:
            $insert = "`36_25K_PA_rental_nm` = " . ($data[47]);
            break;
            case 48:
            $insert = "`48_25K_PA_rental_nm` = " . ($data[47]);
            break;
            case 60:
            $insert = "`60_25K_PA_rental_nm` = " . ($data[47]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[40]){
            case 24:
            $insert = "`24_25K_PA_rental_m` = " . $data[47];
            break;
            case 36:
            $insert = "`36_25K_PA_rental_m` = " . $data[47];
            break;
            case 48:
            $insert = "`48_25K_PA_rental_m` = " . $data[47];
            break;
            case 60:
            $insert = "`60_25K_PA_rental_m` = " . $data[47];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = " . $data[1] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        if($data[43] == 0){
          switch($data[40]){
            case 24:
            $insert = "`24_30K_PA_rental_nm` = " . ($data[47]);
            break;
            case 36:
            $insert = "`36_30K_PA_rental_nm` = " . ($data[47]);
            break;
            case 48:
            $insert = "`48_30K_PA_rental_nm` = " . ($data[47]);
            break;
            case 60:
            $insert = "`60_30K_PA_rental_nm` = " . ($data[47]);
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        else {
          switch($data[40]){
            case 24:
            $insert = "`24_30K_PA_rental_m` = " . $data[47];
            break;
            case 36:
            $insert = "`36_30K_PA_rental_m` = " . $data[47];
            break;
            case 48:
            $insert = "`48_30K_PA_rental_m` = " . $data[47];
            break;
            case 60:
            $insert = "`60_30K_PA_rental_m` = " . $data[47];
            break;
            default:
            echo "no months defined";
            break;
          }
        }
        $update = "INSERT INTO `team`.`rates_leaseplan`
        SET
        `cap_id` = " . $data[1] . ",
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
// Second pass
if (($handle2 = fopen($csv , "r")) !== FALSE) {
  while (($rawdata2 = fgetcsv($handle2, 0, ",")) !== FALSE) {
    $data2 = preg_replace('/\s+/', '', $rawdata2);
    if($row > 1){
      if($data2[74] != 0){
        switch($data2[73]){
          case 24:
          switch($data2[74]){
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
            echo $data2[74] . "mileage profile is not coded into 24 month mileage specifier";
          }
          break;
          case 36:
          switch($data2[74]){
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
            echo $data2[74] . "mileage profile is not coded into 36 month mileage specifier";
          }
          break;
          case 48:
          switch($data2[74]){
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
            echo $data2[74] . "mileage profile is not coded into 48 month mileage specifier";
          }
          break;
          default:
          echo $data2[73] . "monthly profile not coded";
        }
        switch($mileage2){
          case 8000:
          if($data2[43] == 0){
            switch($data2[73]){
              case 24:
              $insert = "`24_8K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 36:
              $insert = "`36_8K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 48:
              $insert = "`48_8K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 60:
              $insert = "`60_8K_PA_rental_nm` = " . ($data2[47]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[73]){
              case 24:
              $insert = "`24_8K_PA_rental_m` = " . $data2[47];
              break;
              case 36:
              $insert = "`36_8K_PA_rental_m` = " . $data2[47];
              break;
              case 48:
              $insert = "`48_8K_PA_rental_m` = " . $data2[47];
              break;
              case 60:
              $insert = "`60_8K_PA_rental_m` = " . $data2[47];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_leaseplan`
          SET
          `cap_id` = " . $data2[1] . ",
          `updated` = NOW(),
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 10000:
          if($data2[43] == 0){
            switch($data2[73]){
              case 24:
              $insert = "`24_10K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 36:
              $insert = "`36_10K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 48:
              $insert = "`48_10K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 60:
              $insert = "`60_10K_PA_rental_nm` = " . ($data2[47]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[73]){
              case 24:
              $insert = "`24_10K_PA_rental_m` = " . $data2[47];
              break;
              case 36:
              $insert = "`36_10K_PA_rental_m` = " . $data2[47];
              break;
              case 48:
              $insert = "`48_10K_PA_rental_m` = " . $data2[47];
              break;
              case 60:
              $insert = "`60_10K_PA_rental_m` = " . $data2[47];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_leaseplan`
          SET
          `cap_id` = " . $data2[1] . ",
          `updated` = NOW(),
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 15000:
          if($data2[43] == 0){
            switch($data2[73]){
              case 24:
              $insert = "`24_15K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 36:
              $insert = "`36_15K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 48:
              $insert = "`48_15K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 60:
              $insert = "`60_15K_PA_rental_nm` = " . ($data2[47]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[73]){
              case 24:
              $insert = "`24_15K_PA_rental_m` = " . $data2[47];
              break;
              case 36:
              $insert = "`36_15K_PA_rental_m` = " . $data2[47];
              break;
              case 48:
              $insert = "`48_15K_PA_rental_m` = " . $data2[47];
              break;
              case 60:
              $insert = "`60_15K_PA_rental_m` = " . $data2[47];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_leaseplan`
          SET
          `cap_id` = " . $data2[1] . ",
          `updated` = NOW(),
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 20000:
          if($data2[43] == 0){
            switch($data2[73]){
              case 24:
              $insert = "`24_20K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 36:
              $insert = "`36_20K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 48:
              $insert = "`48_20K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 60:
              $insert = "`60_20K_PA_rental_nm` = " . ($data2[47]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[73]){
              case 24:
              $insert = "`24_20K_PA_rental_m` = " . $data2[47];
              break;
              case 36:
              $insert = "`36_20K_PA_rental_m` = " . $data2[47];
              break;
              case 48:
              $insert = "`48_20K_PA_rental_m` = " . $data2[47];
              break;
              case 60:
              $insert = "`60_20K_PA_rental_m` = " . $data2[47];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_leaseplan`
          SET
          `cap_id` = " . $data2[1] . ",
          `updated` = NOW(),
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 25000:
          if($data2[43] == 0){
            switch($data2[73]){
              case 24:
              $insert = "`24_25K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 36:
              $insert = "`36_25K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 48:
              $insert = "`48_25K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 60:
              $insert = "`60_25K_PA_rental_nm` = " . ($data2[47]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[73]){
              case 24:
              $insert = "`24_25K_PA_rental_m` = " . $data2[47];
              break;
              case 36:
              $insert = "`36_25K_PA_rental_m` = " . $data2[47];
              break;
              case 48:
              $insert = "`48_25K_PA_rental_m` = " . $data2[47];
              break;
              case 60:
              $insert = "`60_25K_PA_rental_m` = " . $data2[47];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_leaseplan`
          SET
          `cap_id` = " . $data2[1] . ",
          `updated` = NOW(),
          " . $insert . "
          ON DUPLICATE KEY UPDATE
          `updated` = NOW(),
          " . $insert . ";";
          break;
          case 30000:
          if($data2[43] == 0){
            switch($data2[73]){
              case 24:
              $insert = "`24_30K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 36:
              $insert = "`36_30K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 48:
              $insert = "`48_30K_PA_rental_nm` = " . ($data2[47]);
              break;
              case 60:
              $insert = "`60_30K_PA_rental_nm` = " . ($data2[47]);
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          else {
            switch($data2[73]){
              case 24:
              $insert = "`24_30K_PA_rental_m` = " . $data2[47];
              break;
              case 36:
              $insert = "`36_30K_PA_rental_m` = " . $data2[47];
              break;
              case 48:
              $insert = "`48_30K_PA_rental_m` = " . $data2[47];
              break;
              case 60:
              $insert = "`60_30K_PA_rental_m` = " . $data2[47];
              break;
              default:
              echo "no months defined";
              break;
            }
          }
          $update = "INSERT INTO `team`.`rates_leaseplan`
          SET
          `cap_id` = " . $data2[1] . ",
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
        $result2 = mysqli_query($conn, $update);
      }
      $row++;
    }
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  $AdminMessage .= "Second pass upload"; 
  mail($adminEmail,"MR Leaseplan Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle2);
}
else {
	mail($adminEmail,"Problem - MR Leaseplan rates csv second pass upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
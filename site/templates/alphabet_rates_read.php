#!/usr/bin/php
<?php

// alphabet ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Alphabet CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_alphabet`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$csv = "inc/alphabet_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($rawdata);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row > 1){
      switch($data[23]){
        case 24:
        switch($data[22]){
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
          echo $data[22] . "mileage profile is not coded into 24 month mileage specifier";
        }
        break;
        case 36:
        switch($data[22]){
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
          echo $data[22] . "mileage profile is not coded into 36 month mileage specifier";
        }
        break;
        case 48:
        switch($data[22]){
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
          echo $data[22] . "mileage profile is not coded into 48 month mileage specifier";
        }
        break;
        default:
        echo $data[23] . "monthly profile not coded";
      }
      echo "Mileage is: " . $mileage . "<br />";
      switch($mileage){
        case 8000:
        switch($data[22]){
          case 24:
          $insert = "`24_8K_PA_rental_nm` = " . ($data[9]) . ", `24_8K_PA_rental_m` = " . $data[11];
          break;
          case 36:
          $insert = "`36_8K_PA_rental_nm` = " . ($data[9]) . ", `36_8K_PA_rental_m` = " . $data[11];
          break;
          case 48:
          $insert = "`48_8K_PA_rental_nm` = " . ($data[9]) . ", `48_8K_PA_rental_m` = " . $data[11];
          break;
          case 60:
          $insert = "`60_8K_PA_rental_nm` = " . ($data[9]) . ", `60_8K_PA_rental_m` = " . $data[11];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_alphabet`
        SET
        `cap_id` = " . $data[2] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 10000:
        switch($data[22]){
          case 24:
          $insert = "`24_10K_PA_rental_nm` = " . ($data[9]) . ", `24_10K_PA_rental_m` = " . $data[11];
          break;
          case 36:
          $insert = "`36_10K_PA_rental_nm` = " . ($data[9]) . ", `36_10K_PA_rental_m` = " . $data[11];
          break;
          case 48:
          $insert = "`48_10K_PA_rental_nm` = " . ($data[9]) . ", `48_10K_PA_rental_m` = " . $data[11];
          break;
          case 60:
          $insert = "`60_10K_PA_rental_nm` = " . ($data[9]) . ", `60_10K_PA_rental_m` = " . $data[11];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_alphabet`
        SET
        `cap_id` = " . $data[2] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 15000:
        switch($data[22]){
          case 24:
          $insert = "`24_15K_PA_rental_nm` = " . ($data[9]) . ", `24_15K_PA_rental_m` = " . $data[11];
          break;
          case 36:
          $insert = "`36_15K_PA_rental_nm` = " . ($data[9]) . ", `36_15K_PA_rental_m` = " . $data[11];
          break;
          case 48:
          $insert = "`48_15K_PA_rental_nm` = " . ($data[9]) . ", `48_15K_PA_rental_m` = " . $data[11];
          break;
          case 60:
          $insert = "`60_15K_PA_rental_nm` = " . ($data[9]) . ", `60_15K_PA_rental_m` = " . $data[11];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_alphabet`
        SET
        `cap_id` = " . $data[2] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 20000:
        switch($data[22]){
          case 24:
          $insert = "`24_20K_PA_rental_nm` = " . ($data[9]) . ", `24_20K_PA_rental_m` = " . $data[11];
          break;
          case 36:
          $insert = "`36_20K_PA_rental_nm` = " . ($data[9]) . ", `36_20K_PA_rental_m` = " . $data[11];
          break;
          case 48:
          $insert = "`48_20K_PA_rental_nm` = " . ($data[9]) . ", `48_20K_PA_rental_m` = " . $data[11];
          break;
          case 60:
          $insert = "`60_20K_PA_rental_nm` = " . ($data[9]) . ", `60_20K_PA_rental_m` = " . $data[11];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_alphabet`
        SET
        `cap_id` = " . $data[2] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 25000:
        switch($data[22]){
          case 24:
          $insert = "`24_25K_PA_rental_nm` = " . ($data[9]) . ", `24_25K_PA_rental_m` = " . $data[11];
          break;
          case 36:
          $insert = "`36_25K_PA_rental_nm` = " . ($data[9]) . ", `36_25K_PA_rental_m` = " . $data[11];
          break;
          case 48:
          $insert = "`48_25K_PA_rental_nm` = " . ($data[9]) . ", `48_25K_PA_rental_m` = " . $data[11];
          break;
          case 60:
          $insert = "`60_25K_PA_rental_nm` = " . ($data[9]) . ", `60_25K_PA_rental_m` = " . $data[11];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_alphabet`
        SET
        `cap_id` = " . $data[2] . ",
        `updated` = NOW(),
        " . $insert . "
        ON DUPLICATE KEY UPDATE
        `updated` = NOW(),
        " . $insert . ";";
        break;
        case 30000:
        switch($data[22]){
          case 24:
          $insert = "`24_30K_PA_rental_nm` = " . ($data[9]) . ", `24_30K_PA_rental_m` = " . $data[11];
          break;
          case 36:
          $insert = "`36_30K_PA_rental_nm` = " . ($data[9]) . ", `36_30K_PA_rental_m` = " . $data[11];
          break;
          case 48:
          $insert = "`48_30K_PA_rental_nm` = " . ($data[9]) . ", `48_30K_PA_rental_m` = " . $data[11];
          break;
          case 60:
          $insert = "`60_30K_PA_rental_nm` = " . ($data[9]) . ", `60_30K_PA_rental_m` = " . $data[11];
          break;
          default:
          echo "no months defined";
          break;
        }
        $update = "INSERT INTO `team`.`rates_alphabet`
        SET
        `cap_id` = " . $data[2] . ",
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
  mail($adminEmail,"MR Alphabet Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Alphabet rates csv first pass upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
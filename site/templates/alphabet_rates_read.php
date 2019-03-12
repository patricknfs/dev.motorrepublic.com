#!/usr/bin/php
<?php

// alphabet ratebooks are standard 3 up front
// Make sure to format the value cells to be a 2 decinmal place number without commas
// Remove 18K & 25K columns if present


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
$csv = "repos/alphabet_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    $data = preg_replace('/\s+/', '', $data);
    $data = str_replace('£','',$data);
    $data = str_replace(',','',$data);
    $data = str_replace('#N/A',NULL,$data);
    if($row > 7){
      $cap_query = "SELECT `cap_id` FROM `team`.`vehicles` WHERE `cap_code` = '" . trim($data[0]) . "' LIMIT 1";
      echo $cap_query . "</n>";
      $cap_result = mysqli_query($conn, $cap_query);
      $cap_row = mysqli_fetch_assoc($cap_result);
      $capid = $cap_row['cap_id'];
      $insert ='';
      if($data[16] == 0){
        $insert .= "`24_8K_PA_rental_nm` = '" . $data[11] . "',";
        $insert .= "`36_8K_PA_rental_nm` = '" . $data[47] . "',";
        $insert .= "`48_8K_PA_rental_nm` = '" . $data[83] . "',";
        $insert .= "`60_8K_PA_rental_nm` = '" . $data[119] . "',";
        $insert .= "`24_10K_PA_rental_nm` = '" . $data[15] . "',";
        $insert .= "`36_10K_PA_rental_nm` = '" . $data[51] . "',";
        $insert .= "`48_10K_PA_rental_nm` = '" . $data[87] . "',";
        $insert .= "`60_10K_PA_rental_nm` = '" . $data[123] . "',";
        $insert .= "`24_15K_PA_rental_nm` = '" . $data[23] . "',";
        $insert .= "`36_15K_PA_rental_nm` = '" . $data[59] . "',";
        $insert .= "`48_15K_PA_rental_nm` = '" . $data[95] . "',";
        $insert .= "`60_15K_PA_rental_nm` = '" . $data[131] . "',";
        $insert .= "`24_20K_PA_rental_nm` = '" . $data[31] . "',";
        $insert .= "`36_20K_PA_rental_nm` = '" . $data[67] . "',";
        $insert .= "`48_20K_PA_rental_nm` = '" . $data[103] . "',";
        $insert .= "`60_20K_PA_rental_nm` = '" . $data[139] . "',";
        $insert .= "`24_25K_PA_rental_nm` = '" . $data[35] . "',";
        $insert .= "`36_25K_PA_rental_nm` = '" . $data[71] . "',";
        $insert .= "`48_25K_PA_rental_nm` = '" . $data[107] . "',";
        $insert .= "`60_25K_PA_rental_nm` = '" . $data[143] . "',";
        $insert .= "`24_30K_PA_rental_nm` = '" . $data[39] . "',";
        $insert .= "`36_30K_PA_rental_nm` = '" . $data[75] . "',";
        $insert .= "`48_30K_PA_rental_nm` = '" . $data[111] . "',";
        $insert .= "`60_30K_PA_rental_nm` = '" . $data[147] . "'";
      }
      else {
        $insert .= "`24_8K_PA_rental_m` = '" . $data[13] . "',";
        $insert .= "`36_8K_PA_rental_m` = '" . $data[49] . "',";
        $insert .= "`48_8K_PA_rental_m` = '" . $data[85] . "',";
        $insert .= "`60_8K_PA_rental_m` = '" . $data[121] . "',";
        $insert .= "`24_10K_PA_rental_m` = '" . $data[17] . "',";
        $insert .= "`36_10K_PA_rental_m` = '" . $data[53] . "',";
        $insert .= "`48_10K_PA_rental_m` = '" . $data[89] . "',";
        $insert .= "`60_10K_PA_rental_m` = '" . $data[125] . "',";
        $insert .= "`24_15K_PA_rental_m` = '" . $data[25] . "',";
        $insert .= "`36_15K_PA_rental_m` = '" . $data[61] . "',";
        $insert .= "`48_15K_PA_rental_m` = '" . $data[97] . "',";
        $insert .= "`60_15K_PA_rental_m` = '" . $data[133] . "',";
        $insert .= "`24_20K_PA_rental_m` = '" . $data[33] . "',";
        $insert .= "`36_20K_PA_rental_m` = '" . $data[69] . "',";
        $insert .= "`48_20K_PA_rental_m` = '" . $data[105] . "',";
        $insert .= "`60_20K_PA_rental_m` = '" . $data[141] . "',";
        $insert .= "`24_25K_PA_rental_m` = '" . $data[37] . "',";
        $insert .= "`36_25K_PA_rental_m` = '" . $data[73] . "',";
        $insert .= "`48_25K_PA_rental_m` = '" . $data[109] . "',";
        $insert .= "`60_25K_PA_rental_m` = '" . $data[145] . "',";
        $insert .= "`24_30K_PA_rental_m` = '" . $data[41] . "',";
        $insert .= "`36_30K_PA_rental_m` = '" . $data[77] . "',";
        $insert .= "`48_30K_PA_rental_m` = '" . $data[113] . "',";
        $insert .= "`60_30K_PA_rental_m` = '" . $data[149] . "'";
      }
      $update = "INSERT INTO `team`.`rates_alphabet`
      SET
      `cap_id` = '" . $capid  . "',
      `CO2` = '" . $data[154] . "',
      `p11d_price` = '" . str_replace('£','',$data[5]) . "',
      `updated` = NOW(),
      `lcv` = " . ((substr($data[0], -1) == 'L')?1:0) . ",
      " . $insert . "
      ON DUPLICATE KEY UPDATE
      `updated` = NOW(),
      " . $insert . ";";
      echo $update . "\n";
      $result2 = mysqli_query($conn, $update);
    }
    $row++;
    unset($insert);
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
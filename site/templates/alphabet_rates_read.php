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
    if($row > 6){
      $cap_query = "SELECT `cap_id` FROM `team`.`vehicles` WHERE `cap_code` = '" . trim($data[0]) . "' LIMIT 1";
      echo $cap_query . "</n>";
      $cap_result = mysqli_query($conn, $cap_query);
      $cap_row = mysqli_fetch_assoc($cap_result);
      $capid = $cap_row['cap_id'];
      $insert ='';
      if($data[33] == 0){
        $insert .= "`24_8K_PA_rental_nm` = '" . $data[8] . "',";
        $insert .= "`36_8K_PA_rental_nm` = '" . $data[36] . "',";
        $insert .= "`48_8K_PA_rental_nm` = '" . $data[64] . "',";
        $insert .= "`60_8K_PA_rental_nm` = '" . $data[92] . "',";
        $insert .= "`24_10K_PA_rental_nm` = '" . $data[12] . "',";
        $insert .= "`36_10K_PA_rental_nm` = '" . $data[40] . "',";
        $insert .= "`48_10K_PA_rental_nm` = '" . $data[68] . "',";
        $insert .= "`60_10K_PA_rental_nm` = '" . $data[96] . "',";
        $insert .= "`24_15K_PA_rental_nm` = '" . $data[20] . "',";
        $insert .= "`36_15K_PA_rental_nm` = '" . $data[48] . "',";
        $insert .= "`48_15K_PA_rental_nm` = '" . $data[76] . "',";
        $insert .= "`60_15K_PA_rental_nm` = '" . $data[104] . "',";
        $insert .= "`24_20K_PA_rental_nm` = '" . $data[24] . "',";
        $insert .= "`36_20K_PA_rental_nm` = '" . $data[52] . "',";
        $insert .= "`48_20K_PA_rental_nm` = '" . $data[80] . "',";
        $insert .= "`60_20K_PA_rental_nm` = '" . $data[108] . "',";
        $insert .= "`24_30K_PA_rental_nm` = '" . $data[28] . "',";
        $insert .= "`36_30K_PA_rental_nm` = '" . $data[56] . "',";
        $insert .= "`48_30K_PA_rental_nm` = '" . $data[84] . "',";
        $insert .= "`60_30K_PA_rental_nm` = '" . $data[112] . "'";
      }
      else {
        $insert .= "`24_8K_PA_rental_m` = '" . $data[10] . "',";
        $insert .= "`36_8K_PA_rental_m` = '" . $data[38] . "',";
        $insert .= "`48_8K_PA_rental_m` = '" . $data[66] . "',";
        $insert .= "`60_8K_PA_rental_m` = '" . $data[94] . "',";
        $insert .= "`24_10K_PA_rental_m` = '" . $data[14] . "',";
        $insert .= "`36_10K_PA_rental_m` = '" . $data[42] . "',";
        $insert .= "`48_10K_PA_rental_m` = '" . $data[70] . "',";
        $insert .= "`60_10K_PA_rental_m` = '" . $data[98] . "',";
        $insert .= "`24_15K_PA_rental_m` = '" . $data[22] . "',";
        $insert .= "`36_15K_PA_rental_m` = '" . $data[50] . "',";
        $insert .= "`48_15K_PA_rental_m` = '" . $data[78] . "',";
        $insert .= "`60_15K_PA_rental_m` = '" . $data[106] . "',";
        $insert .= "`24_20K_PA_rental_m` = '" . $data[26] . "',";
        $insert .= "`36_20K_PA_rental_m` = '" . $data[54] . "',";
        $insert .= "`48_20K_PA_rental_m` = '" . $data[82] . "',";
        $insert .= "`60_20K_PA_rental_m` = '" . $data[110] . "',";
        $insert .= "`24_30K_PA_rental_m` = '" . $data[30] . "',";
        $insert .= "`36_30K_PA_rental_m` = '" . $data[58] . "',";
        $insert .= "`48_30K_PA_rental_m` = '" . $data[86] . "',";
        $insert .= "`60_30K_PA_rental_m` = '" . $data[114] . "'";
      }
      $update = "INSERT INTO `team`.`rates_alphabet`
      SET
      `cap_id` = '" . $capid  . "',
      `CO2` = '" . $data[15] . "',
      `p11d_price` = '" . str_replace('£','',$data[3]) . "',
      `updated` = NOW(),
      `lcv` = " . ((substr($data[21], -1) == 'L')?1:0) . ",
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
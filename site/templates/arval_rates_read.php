#!/usr/bin/php
<?php

// Arval ratebooks are standard 3 up front

// 15K $ 25K need to be calculated. Make sure that values are indicated as nominal in out docs.

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Arval CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_arval`";
$result = mysqli_query($conn, $truncate);
$row = 1;

if (($handle = fopen("inc/arval_rates.csv", "r")) !== FALSE) {
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    $data = str_replace(',', '', $rawdata);
    $data = str_replace('£','',$data);
    $data = str_replace('#N/A',NULL,$data);
    if($row > 3){
      $update = "INSERT INTO `team`.`rates_arval`
        (
        `cap_id`,
        `CO2`,
        `vehicle_list_price`,
        `vehicle_otr_price`,
        `p11d_price`,
        `updated`,
        `24_8K_PA_rental_m`,
        `24_8K_PA_rental_nm`,
        `24_10K_PA_rental_m`,
        `24_10K_PA_rental_nm`,
        `24_15K_PA_rental_m`,
        `24_15K_PA_rental_nm`,
        `24_20K_PA_rental_m`,
        `24_20K_PA_rental_nm`,
        `24_25K_PA_rental_m`,
        `24_25K_PA_rental_nm`,
        `24_30K_PA_rental_m`,
        `24_30K_PA_rental_nm`,
        `36_8K_PA_rental_m`,
        `36_8K_PA_rental_nm`,
        `36_10K_PA_rental_m`,
        `36_10K_PA_rental_nm`,
        `36_15K_PA_rental_m`,
        `36_15K_PA_rental_nm`,
        `36_20K_PA_rental_m`,
        `36_20K_PA_rental_nm`,
        `36_25K_PA_rental_m`,
        `36_25K_PA_rental_nm`,
        `36_30K_PA_rental_m`,
        `36_30K_PA_rental_nm`,
        `48_8K_PA_rental_m`,
        `48_8K_PA_rental_nm`,
        `48_10K_PA_rental_m`,
        `48_10K_PA_rental_nm`,
        `48_15K_PA_rental_m`,
        `48_15K_PA_rental_nm`,
        `48_20K_PA_rental_m`,
        `48_20K_PA_rental_nm`,
        `48_25K_PA_rental_m`,
        `48_25K_PA_rental_nm`,
        `48_30K_PA_rental_m`,
        `48_30K_PA_rental_nm`,
        `60_8K_PA_rental_m`,
        `60_8K_PA_rental_nm`,
        `60_10K_PA_rental_m`,
        `60_10K_PA_rental_nm`,
        `60_15K_PA_rental_m`,
        `60_15K_PA_rental_nm`,
        `60_20K_PA_rental_m`,
        `60_20K_PA_rental_nm`,
        `60_25K_PA_rental_m`,
        `60_25K_PA_rental_nm`,
        `60_30K_PA_rental_m`,
        `60_30K_PA_rental_nm`)
        VALUES (
        " . $data[4] . ",
        " . $data[56] . ",
        " . $data[10] . ",
        " . $data[10] . ",
        " . $data[6] . ",
        NOW(),
        " . ($data[10]+3.85) . ",
        " . ($data[8]+5+3.85) . ",
        " . ($data[13]+3.85) . ",
        " . ($data[11]+5+3.85) . ",
        " . ((($data[13]+$data[16]+10)/2)+3.85) . ",
        " . ((($data[11]+$data[14]+10)/2)+5+3.85) . ",
        " . ($data[16]+3.85) . ",
        " . ($data[14]+5+3.85) . ",
        " . ((($data[16]+$data[19]+10)/2)+3.85) . ",
        " . ((($data[14]+$data[17]+10)/2)+5+3.85) . ",
        " . ($data[19]+3.85) . ",
        " . ($data[17]+5+3.85) . ",
        # End of 24M
        " . ($data[22]+2.63) . ",
        " . ($data[20]+5+2.63) . ",
        " . ($data[25]+2.63) . ",
        " . ($data[23]+5+2.63) . ",
        " . ((($data[25]+$data[28]+10)/2)+2.63) . ",
        " . ((($data[23]+$data[26]+10)/2)+5+2.63) . ",
        " . ($data[28]+2.63) . ",
        " . ($data[26]+5+2.63) . ",
        " . ((($data[28]+$data[31]+10)/2)+2.63) . ",
        " . ((($data[26]+$data[29]+10)/2)+5+2.63). ",
        " . ($data[31]+2.63) . ",
        " . ($data[29]+5+2.63) . ",
        # End of 36M
        " . ($data[34]+2) . ",
        " . ($data[32]+5+2) . ",
        " . ($data[37]+2) . ",
        " . ($data[35]+5+2) . ",
        " . ((($data[37]+$data[40]+10)/2)+2) . ",
        " . ((($data[35]+$data[38]+10)/2)+5+2) . ",
        " . ($data[40]+2) . ",
        " . ($data[38]+5+2) . ",
        " . ((($data[40]+$data[43]+10)/2)+2) . ",
        " . ((($data[38]+$data[41]+10)/2)+5+2) . ",
        " . ($data[43]+2) . ",
        " . ($data[41]+5+2) . ",
        # End of 48M
        " . ($data[46]+1.62) . ",
        " . ($data[44]+5+1.62) . ",
        " . ($data[49]+1.62) . ",
        " . ($data[47]+5+1.62) . ",
        " . ((($data[49]+$data[52]+10)/2)+1.62)  . ",
        " . ((($data[47]+$data[50]+10)/2)+5+1.62)  . ",
        " . ($data[52]+1.62) . ",
        " . ($data[50]+5+1.62) . ",
        " . ((($data[52]+$data[55]+10)/2)+1.62) . ",
        " . ((($data[50]+$data[53]+10)/2)+5+1.62) . ",
        " . ($data[55]+1.62) . ",
        " . ($data[53]+5+1.62) . ")
        ON DUPLICATE KEY UPDATE
          `cap_id` = " . $data[4] . "
        ;
      ";
      echo $update . "<br />";
      $result2 = mysqli_query($conn, $update);
    }
    $row++;
  }
  $AdminMessage .= $row . " rows inserted\n";
  mail($adminEmail,"MR Arval Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Arval rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
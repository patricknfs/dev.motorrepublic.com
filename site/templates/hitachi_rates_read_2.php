#!/usr/bin/php
<?php

// Hitachi ratebooks are standard 3 up front

// 15K $ 25K need to be calculated. Make sure that values are indicated as nominal in out docs.
// Calculated by adding rates before and after plus 10, then dividing by 2.

/*

Do not forget to add in an extra £5 for non-maintained agreements. This has not been accounted for yet.

*/

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Hitachi CSV Upload Report\n";
// Now open the local file and loop through it.
// $truncate = "TRUNCATE TABLE `team`.`rates_hitachi`";
// $result = mysqli_query($conn, $truncate);
$row = 1;

if (($handle = fopen("inc/hitachi_rates_all.csv", "r")) !== FALSE) {
  // fgets($handle);

  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($data);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    $data = str_replace('£','',$data);
    $data = str_replace('#N/A',NULL,$data);
    if($row > 1){
      $update = "INSERT INTO `team`.`rates_hitachi`
        (
        `cap_id`,
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
        " . $data[1] . ",
        NOW(),
        " . ($data[8]+3.85) . ",
        " . ($data[9]+3.85) . ",
        " . ($data[11]+3.85) . ",
        " . ($data[12]+3.85) . ",
        " . ($data[11]+$data[14]+10+3.85)/2 . ",
        " . ($data[12]+$data[15]+10+3.85)/2 . ",
        " . ($data[14]+3.85) . ",
        " . ($data[15]+3.85) . ",
        " . ($data[14]+$data[17]+10+3.85)/2 . ",
        " . ($data[15]+$data[18]+10+3.85)/2 . ",
        " . ($data[17]+3.85) . ",
        " . ($data[18]+3.85) . ",
        # End of 24M
        " . ($data[20]+2.63) . ",
        " . ($data[21]+2.63) . ",
        " . ($data[23]+2.63) . ",
        " . ($data[24]+2.63) . ",
        " . ($data[23]+$data[26]+10+2.63)/2 . ",
        " . ($data[24]+$data[27]+10+2.63)/2 . ",
        " . ($data[26]+2.63) . ",
        " . ($data[27]+2.63) . ",
        " . ($data[26]+$data[29]+10+2.63)/2 . ",
        " . ($data[27]+$data[30]+10+2.63)/2 . ",
        " . ($data[29]+2.63) . ",
        " . ($data[30]+2.63) . ",
        # End of 36M
        " . ($data[32]+2) . ",
        " . ($data[33]+2) . ",
        " . ($data[35]+2) . ",
        " . ($data[36]+2) . ",
        " . ($data[35]+$data[38]+10+2)/2 . ",
        " . ($data[36]+$data[39]+10+2)/2 . ",
        " . ($data[38]+2) . ",
        " . ($data[39]+2) . ",
        " . ($data[38]+$data[41]+10+2)/2 . ",
        " . ($data[39]+$data[42]+10+2)/2 . ",
        " . ($data[41]+2) . ",
        " . ($data[42]+2) . ",
        # End of 48M
        " . ($data[44]+1.62) . ",
        " . ($data[45]+1.62) . ",
        " . ($data[47]+1.62) . ",
        " . ($data[48]+1.62) . ",
        " . ($data[47]+$data[50]+10+1.62)/2  . ",
        " . ($data[48]+$data[51]+10+1.62)/2  . ",
        " . ($data[50]+1.62) . ",
        " . ($data[51]+1.62) . ",
        " . ($data[50]+$data[53]+10+1.62)/2 . ",
        " . ($data[51]+$data[54]+10+1.62)/2 . ",
        " . ($data[53]+1.62) . ",
        " . ($data[54]+1.62) . ")
        ON DUPLICATE KEY UPDATE
          `cap_id` = " . $data[4] . "
        ;
      ";
      echo $update . "<br />";
      $result2 = mysqli_query($conn, $update);
    }
    $row++;
  }
  $AdminMessage .= $num . " rows inserted\n";
  mail($adminEmail,"MR Hitachi Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Hitachi rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
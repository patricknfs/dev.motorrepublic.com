#!/usr/bin/php
<?php

// Arval ratebooks are standard 3 up front

// 12K, 15K $ 25K need to be calculated. Make sure that values are indicated as nominal in out docs.

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
if (($handle = fopen("inc/arval_rates_cars.csv", "r")) !== FALSE) {
  fgets($handle);
  print_r($handle);
  $num = count($handle);
  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    
    $data = preg_replace('/\s+/', '', $rawdata);
    $data = str_replace('£','',$data);
    $data = str_replace('#N/A',NULL,$data);
    if($row > 3){
      $update = "INSERT INTO `team`.`rates_arval`
        (
        `cap_id`,
        `updated`,
        `24_8K_PA_rental`,
        `24_8K_PA_service`,
        `24_10K_PA_rental`,
        `24_10K_PA_service`,
        `24_15K_PA_rental`,
        `24_15K_PA_service`,
        `24_20K_PA_rental`,
        `24_20K_PA_service`,
        `24_25K_PA_rental`,
        `24_25K_PA_service`,
        `24_30K_PA_rental`,
        `24_30K_PA_service`,
        `36_8K_PA_rental`,
        `36_8K_PA_service`,
        `36_10K_PA_rental`,
        `36_10K_PA_service`,
        `36_15K_PA_rental`,
        `36_15K_PA_service`,
        `36_20K_PA_rental`,
        `36_20K_PA_service`,
        `36_25K_PA_rental`,
        `36_25K_PA_service`,
        `36_30K_PA_rental`,
        `36_30K_PA_service`,
        `48_8K_PA_rental`,
        `48_8K_PA_service`,
        `48_10K_PA_rental`,
        `48_10K_PA_service`,
        `48_15K_PA_rental`,
        `48_15K_PA_service`,
        `48_20K_PA_rental`,
        `48_20K_PA_service`,
        `48_25K_PA_rental`,
        `48_25K_PA_service`,
        `48_30K_PA_rental`,
        `48_30K_PA_service`,
        `60_8K_PA_rental`,
        `60_8K_PA_service`,
        `60_10K_PA_rental`,
        `60_10K_PA_service`,
        `60_15K_PA_rental`,
        `60_15K_PA_service`,
        `60_20K_PA_rental`,
        `60_20K_PA_service`,
        `60_25K_PA_rental`,
        `60_25K_PA_service`,
        `60_30K_PA_rental`,
        `60_30K_PA_service`)
        VALUES (
        " . $data[4] . ",
        NOW(),
        " . $data[8] . ", // 8K
        " . $data[9] . ", // 8K
        " . $data[11] . ",
        " . $data[12] . ",
        " . $data[11]+$data[14]/2 . ",
        " . $data[12]+$data[15]/2 . ",
        " . $data[14] . ",
        " . $data[15] . ",
        " . $data[14]+$data[17]/2 . ",
        " . $data[15]+$data[18]/2 . ",
        " . $data[17] . ",
        " . $data[18] . ",
        // End of 24M
        " . $data[20] . ",
        " . $data[21] . ",
        " . $data[23] . ",
        " . $data[24] . ",
        " . $data[23]+$data[26]/2 . ",
        " . $data[24]+$data[27]/2 . ",
        " . $data[26] . ",
        " . $data[27] . ",
        " . $data[26]+$data[29]/2 . ",
        " . $data[27]+$data[30]/2 . ",
        " . $data[29] . ",
        " . $data[30] . ",
        // End of 36M
        " . $data[32] . ",
        " . $data[33] . ",
        " . $data[35] . ",
        " . $data[36] . ",
        " . $data[35]+$data[38]/2 . ",
        " . $data[36]+$data[39]/2 . ",
        " . $data[38] . ",
        " . $data[39] . ",
        " . $data[38]+$data[41]/2 . ",
        " . $data[39]+$data[42]/2 . ",
        " . $data[41] . ",
        " . $data[42] . ",
        // End of 48M
        " . $data[44] . ",
        " . $data[45] . ",
        " . $data[47] . ",
        " . $data[48] . ",
        " . $data[47]+$data[50]/2  . ",
        " . $data[48]+$data[51]/2  . ",
        " . $data[50] . ",
        " . $data[51] . ",
        " . $data[50]+$data[53]/2 . ",
        " . $data[51]+$data[54]/2 . ",
        " . $data[53] . ",
        " . $data[54] . ")
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
  mail($adminEmail,"MR Arval Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Arval rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
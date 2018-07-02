#!/usr/bin/php
<?php

// Hitachi ratebooks are standard 3 up front, no commissions

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
// Open remote file
// $ch = file("https://mojo.affilired.com/callback/affiliate.php?private_key=B6999833687CBCA403A4C5EBD85633B9&from_date=" . $yesterday . "&to_date=" . $yesterday . "&separator=",FILE_IGNORE_NEW_LINES);
// // $ch = file("https://mojo.affilired.com/callback/affiliate.php?private_key=B6999833687CBCA403A4C5EBD85633B9&from_date=2017/06/14&to_date=2017/04/28&separator=",FILE_IGNORE_NEW_LINES);

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Hitachi CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_hitachi`";
$result = mysqli_query($conn, $truncate);
$row = 1;
if (($handle = fopen("inc/hitachi_rates_cars.csv", "r")) !== FALSE) {
  fgets($handle);

  while (($rawdata = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($data);
    $num = count($rawdata);
    $data = preg_replace('/\s+/', '', $rawdata);
    $data = str_replace('£','',$data);
    $data = str_replace('#N/A',NULL,$data);
    if($row > 3){
      $update = "INSERT INTO `team`.`rates_hitachi`
        (
        `cap_id`,
        `updated`,
        `24_8K_PA_rental`,
        `24_8K_PA_service`,
        `24_10K_PA_rental`,
        `24_10K_PA_service`,
        `24_20K_PA_rental`,
        `24_20K_PA_service`,
        `24_30K_PA_rental`,
        `24_30K_PA_service`,
        `36_8K_PA_rental`,
        `36_8K_PA_service`,
        `36_10K_PA_rental`,
        `36_10K_PA_service`,
        `36_20K_PA_rental`,
        `36_20K_PA_service`,
        `36_30K_PA_rental`,
        `36_30K_PA_service`,
        `48_8K_PA_rental`,
        `48_8K_PA_service`,
        `48_10K_PA_rental`,
        `48_10K_PA_service`,
        `48_20K_PA_rental`,
        `48_20K_PA_service`,
        `48_30K_PA_rental`,
        `48_30K_PA_service`,
        `60_8K_PA_rental`,
        `60_8K_PA_service`,
        `60_10K_PA_rental`,
        `60_10K_PA_service`,
        `60_20K_PA_rental`,
        `60_20K_PA_service`,
        `60_30K_PA_rental`,
        `60_30K_PA_service`)
        VALUES (
        " . $data[4] . ",
        NOW(),
        " . $data[8] . ",
        " . $data[9] . ",
        " . $data[11] . ",
        " . $data[12] . ",
        " . $data[14] . ",
        " . $data[15] . ",
        " . $data[17] . ",
        " . $data[18] . ",
        " . $data[20] . ",
        " . $data[21] . ",
        " . $data[23] . ",
        " . $data[24] . ",
        " . $data[26] . ",
        " . $data[27] . ",
        " . $data[29] . ",
        " . $data[30] . ",
        " . $data[32] . ",
        " . $data[33] . ",
        " . $data[35] . ",
        " . $data[36] . ",
        " . $data[38] . ",
        " . $data[39] . ",
        " . $data[41] . ",
        " . $data[42] . ",
        " . $data[44] . ",
        " . $data[45] . ",
        " . $data[47] . ",
        " . $data[48] . ",
        " . $data[50] . ",
        " . $data[51] . ",
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
  mail($adminEmail,"MR Hitachi Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Hitachi rates csv upload","The csv upload has failed for some reason","From: MR Server");
}
$conn->close();
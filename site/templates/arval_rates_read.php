#!/usr/bin/php
<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
// Open remote file
// $ch = file("https://mojo.affilired.com/callback/affiliate.php?private_key=B6999833687CBCA403A4C5EBD85633B9&from_date=" . $yesterday . "&to_date=" . $yesterday . "&separator=",FILE_IGNORE_NEW_LINES);
// // $ch = file("https://mojo.affilired.com/callback/affiliate.php?private_key=B6999833687CBCA403A4C5EBD85633B9&from_date=2017/06/14&to_date=2017/04/28&separator=",FILE_IGNORE_NEW_LINES);

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

  while ((str_replace('£','',$data = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r(str_replace('£','',$data);
    $num = count(str_replace('£','',$data);
    if($row > 3){
      $update = "REPLACE INTO `team`.`rates_arval`
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
        '" . $data[4] . "',
        NOW(),
        '" . str_replace('£','',$data[8]) . "',
        '" . str_replace('£','',$data[9]) . "',
        '" . str_replace('£','',$data[11]) . "',
        '" . str_replace('£','',$data[12]) . "',
        '" . str_replace('£','',$data[14]) . "',
        '" . str_replace('£','',$data[15]) . "',
        '" . str_replace('£','',$data[17]) . "',
        '" . str_replace('£','',$data[18]) . "',
        '" . str_replace('£','',$data[20]) . "',
        '" . str_replace('£','',$data[21]) . "',
        '" . str_replace('£','',$data[23]) . "',
        '" . str_replace('£','',$data[24]) . "',
        '" . str_replace('£','',$data[26]) . "',
        '" . str_replace('£','',$data[27]) . "',
        '" . str_replace('£','',$data[29]) . "',
        '" . str_replace('£','',$data[30]) . "',
        '" . str_replace('£','',$data[32]) . "',
        '" . str_replace('£','',$data[33]) . "',
        '" . str_replace('£','',$data[35]) . "',
        '" . str_replace('£','',$data[36]) . "',
        '" . str_replace('£','',$data[38]) . "',
        '" . str_replace('£','',$data[39]) . "',
        '" . str_replace('£','',$data[41]) . "',
        '" . str_replace('£','',$data[42]) . "',
        '" . str_replace('£','',$data[44]) . "',
        '" . str_replace('£','',$data[45]) . "',
        '" . str_replace('£','',$data[47]) . "',
        '" . str_replace('£','',$data[48]) . "',
        '" . str_replace('£','',$data[50]) . "',
        '" . str_replace('£','',$data[51]) . "',
        '" . str_replace('£','',$data[53]) . "',
        '" . str_replace('£','',$data[54]) . "')
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
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
$AdminMessage = "MR CSV Upload Report\n";
// Now open the local file and loop through it.
$row = 1;
if (($handle = fopen("/cap_cars.csv", "r")) !== FALSE) {
  fgets($handle);

  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($data);
    $num = count($data);
    $truncate = "TRUNCATE TABLE `team`.`vehicles`";
    $results = mysqli_query($conn, $truncate);
    $result->close();
    $insert = "INSERT INTO `team`.`vehicles` (`cap_code`,`cap_id`,`manufacturer`,`model``description`) VALUES (" . $data[0] . "," . $data[1] . "," . $data[2] . "," . $data[4] . "," . $data[8] . ")";
    $result2->close();
    $row++;
  }
  $AdminMessage .= $num . " rows inserted\n";
  mail($adminEmail,"Dootet - Affilired Commission Monitor",$AdminMessage,"From: Dootet Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR cap vehicle csv upload","The csv update has failed for some reason","From: MR Server");
}
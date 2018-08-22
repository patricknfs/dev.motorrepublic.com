#!/usr/bin/php
<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`vehicles`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$row2 = 1;

if (($handle = fopen("inc/cap_cars.csv", "r")) !== FALSE) {
  fgets($handle);
  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    if($data[11] == "Y"){
      $insert = "INSERT INTO `team`.`vehicles` (`cap_code`,`cap_id`,`manufacturer`,`model`,`description`) VALUES ('" . $data[0] . "','" . $data[1] . "','" . $data[2] . "','" . $data[4] . "','" . $data[8] . "')";
      // echo $insert . "<br />"
      $result = mysqli_query($conn, $insert);
      $row++;
    }
  }
  echo $row . " inserted\n";
  mail($adminEmail,"CAP cars upload",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR cap cars csv upload","The csv update has failed for some reason","From: MR Server");
}

if (($handle2 = fopen("inc/cap_lcvs.csv", "r")) !== FALSE) {
  fgets($handle2);
  while (($data2 = fgetcsv($handle2, 0, ",")) !== FALSE) {
    if($data2[11] == "Y"){
      $insert2 = "INSERT INTO `team`.`vehicles` (`cap_code`,`cap_id`,`manufacturer`,`model`,`description`) VALUES ('" . $data[0] . "','" . $data[1] . "','" . $data[2] . "','" . $data[4] . "','" . $data[8] . "')";
      // echo $insert . "<br />"
      $result2 = mysqli_query($conn, $insert2);
      $row2++;
    }
  }
  echo $row2 . " inserted\n";
  mail($adminEmail,"CAP LCV\'s upload",$AdminMessage,"From: MR Server");
  fclose($handle2);
}
else {
	mail($adminEmail,"Problem - MR cap lcvs csv upload","The csv update has failed for some reason","From: MR Server");
}
$AdminMessage .= $row+$row2 . " rows inserted\n";
$conn->close();
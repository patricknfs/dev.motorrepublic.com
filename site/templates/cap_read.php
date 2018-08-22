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
    // print_r($data);
    $num = count($data);
    echo "car rows count is " . $num;
    if($data[11] == "Y"){
      $insert = "INSERT INTO `team`.`vehicles` (`cap_code`,`cap_id`,`manufacturer`,`model`,`description`) VALUES ('" . $data[0] . "','" . $data[1] . "','" . $data[2] . "','" . $data[4] . "','" . $data[8] . "')";
      // echo $insert . "<br />"
      $result2 = mysqli_query($conn, $insert);
      $rows++;
    }
    echo $rows . " inserted";
  }
  $AdminMessage .= $num . " rows inserted\n";
  mail($adminEmail,"CAP cars upload",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR cap cars csv upload","The csv update has failed for some reason","From: MR Server");
}

if (($handle = fopen("inc/cap_lcvs.csv", "r")) !== FALSE) {
  fgets($handle);

  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($data);
    $num2 = count($data);
    echo "van rows count is " . $num2;
    if($data[11] == "Y"){
      $insert = "INSERT INTO `team`.`vehicles` (`cap_code`,`cap_id`,`manufacturer`,`model`,`description`) VALUES ('" . $data[0] . "','" . $data[1] . "','" . $data[2] . "','" . $data[4] . "','" . $data[8] . "')";
      // echo $insert . "<br />"
      $result2 = mysqli_query($conn, $insert);
      $row2++;
    }
    echo $rows2 . " inserted";
  }
  $AdminMessage .= $num . " rows inserted\n";
  mail($adminEmail,"CAP LCV\'s upload",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR cap lcvs csv upload","The csv update has failed for some reason","From: MR Server");
}
$conn->close();
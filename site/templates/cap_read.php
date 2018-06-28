<?php

#!/usr/bin/php
<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/inc/config.php';
require_once(PPW_PATH . "/inc/conn.php");
// Open remote file
// $ch = file("https://mojo.affilired.com/callback/affiliate.php?private_key=B6999833687CBCA403A4C5EBD85633B9&from_date=" . $yesterday . "&to_date=" . $yesterday . "&separator=",FILE_IGNORE_NEW_LINES);
// // $ch = file("https://mojo.affilired.com/callback/affiliate.php?private_key=B6999833687CBCA403A4C5EBD85633B9&from_date=2017/06/14&to_date=2017/04/28&separator=",FILE_IGNORE_NEW_LINES);

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");

// Now open the local file and loop through it.
$row = 1;
if (($handle = fopen("/affilired.csv", "r")) !== FALSE) {
    fgets($handle);

    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    	// print_r($data);
      $num = count($data);
      if($data[9] == "Pending"){
				$query = "UPDATE `brains`.`clicks` SET `trans_date` = '" . ared2mysql($data[5]) . "', `booking_date` = '" . ared2mysql($data[12]) . "', `sale_value` = `sale_value` + " . $data[7] . ", `comm` = `comm` + " . $data[6] . ", `sales_number` = `sales_number`+1 WHERE `id` = '" . $data[4] . "' LIMIT 1";
				echo $query . "\n\r";
				$results = mysqli_query($conn, $query);
			}
			elseif ($data[9] == "Cancelled") {
				$select_query = "SELECT `comm` FROM `brains`.`clicks` WHERE `id` = " . $data[4] . " LIMIT 1"; 
				$result2 = mysqli_query($conn2, $select_query);
				$value = mysqli_fetch_object($result2);
				if ($data[6] <= $value->comm) {
					$query = "UPDATE `brains`.`clicks` SET `trans_date` = '" . ared2mysql($data[10]) . "', `booking_date` = '0000-00-00 00:00:00', `sale_value` = `sale_value` - " . $data[7] . ", `comm` = `comm` - " . $data[6] . ", `sales_number` = `sales_number`-1 WHERE `id` = '" . $data[4] . "' LIMIT 1";
					echo $query . "\n\r";
					$results = mysqli_query($conn2, $query);
				}
				else{
					echo "Check click id " . $data[4] . " for correct cancellation information. Should have been ordered and cancelled the same day";
				}
				$result2->close();
			}
			else{
				$AdminMessage .= "No rows inserted\n";
			}
      $row++;
    }
    mail($adminEmail,"Dootet - Affilired Commission Monitor",$AdminMessage,"From: Dootet Server");
    fclose($handle);
}
else {
	mail($adminEmail,"Problem - Dootet - Affilired Commission Monitor","The commission update has failed for some reason","From: Dootet Server");
}
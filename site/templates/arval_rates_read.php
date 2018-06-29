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

  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    // print_r($data);
    $num = count($data);
    if($row > 3){
      $update = "REPLACE INTO `team`.`rates_arval`
        (`id`,
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
        VALUES
        <{cap_id:" . $data[4] . " }>,
        <{updated: NOW() }>,
        <{24_8K_PA_rental:" . $data[8] . "  }>,
        <{24_8K_PA_service:" . $data[9] . "  }>,
        <{24_10K_PA_rental:" . $data[11] . "  }>,
        <{24_10K_PA_service:" . $data[12] . "  }>,
        <{24_20K_PA_rental:" . $data[14] . "  }>,
        <{24_20K_PA_service:" . $data[15] . "  }>,
        <{24_30K_PA_rental:" . $data[17] . "  }>,
        <{24_30K_PA_service:" . $data[18] . "  }>,
        <{36_8K_PA_rental:" . $data[20] . "  }>,
        <{36_8K_PA_service:" . $data[21] . "  }>,
        <{36_10K_PA_rental:" . $data[23] . "  }>,
        <{36_10K_PA_service:" . $data[24] . "  }>,
        <{36_20K_PA_rental:" . $data[26] . "  }>,
        <{36_20K_PA_service:" . $data[27] . "  }>,
        <{36_30K_PA_rental:" . $data[29] . "  }>,
        <{36_30K_PA_service:" . $data[30] . "  }>,
        <{48_8K_PA_rental:" . $data[32] . "  }>,
        <{48_8K_PA_service:" . $data[33] . "  }>,
        <{48_10K_PA_rental:" . $data[35] . "  }>,
        <{48_10K_PA_service:" . $data[36] . "  }>,
        <{48_20K_PA_rental:" . $data[38] . "  }>,
        <{48_20K_PA_service:" . $data[39] . "  }>,
        <{48_30K_PA_rental:" . $data[41] . "  }>,
        <{48_30K_PA_service:" . $data[42] . "  }>,
        <{60_8K_PA_rental:" . $data[44] . "  }>,
        <{60_8K_PA_service:" . $data[45] . "  }>,
        <{60_10K_PA_rental:" . $data[47] . "  }>,
        <{60_10K_PA_service:" . $data[48] . "  }>,
        <{60_20K_PA_rental:" . $data[50] . "  }>,
        <{60_20K_PA_service:" . $data[51] . "  }>,
        <{60_30K_PA_rental:" . $data[53] . "  }>,
        <{60_30K_PA_service:" . $data[54] . "  }>)
        // ON DUPLICATE KEY UPDATE
        //   `cap_id` = " . $data[4] . "
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
<?php
// $csv = "repos/mailing_north_uk.csv";#
$csv = "repos/mailing_south_uk.csv";

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Slice Report\n";
// Now open the local file and loop through it.

if (($handle = fopen($csv, "r")) !== FALSE) {
  $row = 1;
  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    // $data = array_map('trim',$data);
    // echo $data[0]; // company
    // echo $data[1]; // town
    // echo $data[2]; // county
    // echo $data[3]; // postcode
    // echo $data[4]; // prefix
    // echo $data[5]; // fname
    // echo $data[6]; // sname
    // echo $data[7]; // jobrole
    // echo $data[8]; // email
    $postcode = explode(' ', trim($data[3]));
    $pc_bhams_worcsn = array('B14','B27','B30','B31','B38','B40','B45','B47','B48','B49','B50','B60','B61','B80','B90','B91','B92','B93','B94','B95','B96','B97','B98','DY13','WR9');
   
    if(in_array($postcode[0], $pc_bhams_worcsn)){
      echo $postcode[0] . "\n";
      $file = fopen("pc_bhams_worcsn.csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1]]);
    }
  }
}
fclose($handle);
fclose($file);
?>
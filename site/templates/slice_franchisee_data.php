<?php
$csv = "repos/mailing_north_uk.csv";#


date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Slice Report\n";

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
    $pc_warks = array('CV1','CV10','CV11','CV12','CV13','CV2','CV21','CV22','CV23','CV3','CV31','CV32','CV33','CV34','CV35','CV36','CV37','CV4','CV47','CV5','CV6','CV7','CV8','CV9');
    $pc_cardiff = array('CF1','CF10','CF11','CF14','CF15','CF23','CF24','CF3','CF37','CF38','CF39','CF40','CF41','CF43','CF44','CF45','CF46','CF47','CF48','CF5','CF61','CF62','CF63','CF64','CF71','CF72','CF81','CF82','CF83','NP1','NP10','NP11','NP12','NP13','NP15','NP16','NP18','NP19','NP2','NP20','NP24','NP25','NP26','NP3','NP4','NP44','NP5','NP6','NP9');

    if(in_array($postcode[0], $pc_bhams_worcsn)){
      echo $postcode[0] . "\n";
      $file = fopen("pc_bhams_worcsn.csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1]]);
    }
    elseif(in_array($postcode[0], $pc_warks)){
      echo $postcode[0] . "\n";
      $file = fopen("warks.csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1]]);
    }
    elseif(in_array($postcode[0], $pc_cardiff)){
      echo $postcode[0] . "\n";
      $file = fopen("cardiff.csv","a");
      
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
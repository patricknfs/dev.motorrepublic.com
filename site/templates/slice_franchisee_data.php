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
    $pc_maidstone = array('ME1','ME10','ME11','ME12','ME14','ME15','ME16','ME17','ME18','ME19','ME2','ME20','ME3','ME4','ME5','ME6','ME7','ME8','ME9');
    $pc_canary_wharf = array('E10','E11','E12','E13','E14','E15','E16','E17','E18','E1W','E2','E3','E5','E6','E7','E8','E9','E98');
    $pc_reading = array('OX10','OX11','RG1','RG10','RG11','RG12','RG13','RG16','RG2','RG3','RG30','RG31','RG4','RG40','RG41','RG42','RG45','RG5','RG6','RG7','RG8');
    $pc_sheffield_north = array('DN12','S1','S2','S3','S30','S31','S35','S36','S4','S5','S60','S61','S62','S63','S64','S65','S70','S71','S72','S73','S74','S75','S9','S96');
    $pc_bristol = array('BS1','BS10','BS11','BS12','BS 13','BS14','BS15','BS16','BS17','BS18','BS19','BS2','BS20','BS21','BS3','BS30','BS31','BS32','BS34','BS35','BS36','BS37','BS4','BS41','BS48','BS49','BS5','BS6','BS7','BS8','BS9','BS99');
    $pc_dartford = array('BR5','BR7','BR8','DA1','DA10','DA11','DA12','DA13','DA14','DA15','DA16','DA17','DA18','DA2','DA3','DA4','DA5','RM20','DA7','DA8','DA9','RM20','SE18','SE2','SE28','SE9');
    $pc_portsmouth_iow = array('PO1','PO10','PO11','PO18','PO19','PO2','PO3','PO30','PO31','PO32','PO33','PO34','PO35','PO36','PO37','PO38','PO39','PO4','PO40','PO41','PO5','PO6','PO7','PO8','PO9');
    $pc_ayrshire = array('G45','G46','G76','G77','G78','G79','KA1','KA10','KA11','KA12','KA13','KA14','KA15','KA16','KA17','KA18','KA19','KA2','KA20','KA21','KA22','KA23','KA24','KA25','KA26','KA27','KA28','KA29','KA3','KA30','KA4','KA5','KA6','KA7','KA8','KA9','PA1','PA10','PA11','PA12','PA13','PA14','PA15','PA16','PA17','PA18','PA19','PA2','PA3','PA4','PA5','PA6','PA7','PA8','PA9');
    $pc_norwich = array('IP25','NR1','NR10','NR11','NR12','NR13','NR14','NR15','NR17','NR18','NR19','NR2','NR20','NR21','NR22','NR23','NR24','NR25','NR26','NR27','NR28','NR29','NR3','NR30','NR31','NR32','NR4','NR5','NR6','NR7','NR8','NR9','PE37');

    if(in_array($postcode[0], $pc_bhams_worcsn)){
      echo $postcode[0] . "\n";
      $file = fopen("m_bhams_worcsn_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_warks)){
      echo $postcode[0] . "\n";
      $file = fopen("m_warks_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_cardiff)){
      echo $postcode[0] . "\n";
      $file = fopen("m_cardiff_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_maidstone)){
      echo $postcode[0] . "\n";
      $file = fopen("m_maidstone_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_canary_wharf)){
      echo $postcode[0] . "\n";
      $file = fopen("m_canary_wharf_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_reading)){
      echo $postcode[0] . "\n";
      $file = fopen("m_reading_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_sheffield_north)){
      echo $postcode[0] . "\n";
      $file = fopen("m_sheffield_north_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_bristol)){
      echo $postcode[0] . "\n";
      $file = fopen("m_bristol_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_dartford)){
      echo $postcode[0] . "\n";
      $file = fopen("m_dartford_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_portsmouth_iow)){
      echo $postcode[0] . "\n";
      $file = fopen("m_portsmouth_iow_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_ayrshire)){
      echo $postcode[0] . "\n";
      $file = fopen("m_ayrshire_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    elseif(in_array($postcode[0], $pc_norwich)){
      echo $postcode[0] . "\n";
      $file = fopen("m_norwich_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
    else {
      echo $postcode[0] . "\n";
      $file = fopen("m_unassigned_" . date('dmY') . ".csv","a");
      
      $num = count($data);
      $row++;
      echo $data[0] . "\n" . $data[1] . "\n";
      fputcsv($file, [$data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8]]);
    }
  }
}
fclose($handle);
fclose($file);
?>
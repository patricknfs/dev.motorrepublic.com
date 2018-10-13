#!/usr/bin/php
<?php

// alphabet ratebooks are standard 3 up front

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

//Open local file to write to
// $fp = fopen("/var/www/vhosts/dootet.com/stats.dootet.com/data/affilired.csv", "w");
$adminEmail = "patrick.ogorman@nationalfleetservices.net";
$AdminMessage = "MR Alphabet CSV Upload Report\n";
// Now open the local file and loop through it.
$truncate = "TRUNCATE TABLE `team`.`rates_alphabet`";
$result = mysqli_query($conn, $truncate);
$row = 1;
$csv = "inc/alphabet_rates_all.csv";
if (($handle = fopen($csv , "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
    // $data = preg_replace('/\s+/', '', $rawdata);
    // $data = str_replace('£','',$data);
    // $data = str_replace('#N/A',NULL,$data);
    if($row > 7){
      if($data[43] == 0){
        $insert = "`24_8K_PA_rental_nm` = " . ($data[8]);
        $insert .= ",`36_8K_PA_rental_nm` = " . ($data[36]);
        $insert .= ",`48_8K_PA_rental_nm` = " . ($data[64]);
        $insert .= ",`60_8K_PA_rental_nm` = " . ($data[92]);
        $insert .= ",`24_10K_PA_rental_nm` = " . ($data[12]);
        $insert .= ",`36_10K_PA_rental_nm` = " . ($data[40]);
        $insert .= ",`48_10K_PA_rental_nm` = " . ($data[68]);
        $insert .= ",`60_10K_PA_rental_nm` = " . ($data[96]);
        $insert .= ",`24_15K_PA_rental_nm` = " . ($data[20]);
        $insert .= ",`36_15K_PA_rental_nm` = " . ($data[48]);
        $insert .= ",`48_15K_PA_rental_nm` = " . ($data[76]);
        $insert .= ",`60_15K_PA_rental_nm` = " . ($data[104]);
        $insert .= ",`24_20K_PA_rental_nm` = " . ($data[24]);
        $insert .= ",`36_20K_PA_rental_nm` = " . ($data[52]);
        $insert .= ",`48_20K_PA_rental_nm` = " . ($data[80]);
        $insert .= ",`60_20K_PA_rental_nm` = " . ($data[108]);
        $insert .= ",`24_30K_PA_rental_nm` = " . ($data[28]);
        $insert .= ",`36_30K_PA_rental_nm` = " . ($data[56]);
        $insert .= ",`48_30K_PA_rental_nm` = " . ($data[84]);
        $insert .= ",`60_30K_PA_rental_nm` = " . ($data[112]);
      }
      else {
        $insert .= ",`24_8K_PA_rental_m` = " . $data[10];
        $insert .= ",`36_8K_PA_rental_m` = " . $data[38];
        $insert .= ",`48_8K_PA_rental_m` = " . $data[66];
        $insert .= ",`60_8K_PA_rental_m` = " . $data[94];
        $insert .= ",`24_10K_PA_rental_m` = " . $data[14];
        $insert .= ",`36_10K_PA_rental_m` = " . $data[42];
        $insert .= ",`48_10K_PA_rental_m` = " . $data[70];
        $insert .= ",`60_10K_PA_rental_m` = " . $data[98];
        $insert .= ",`24_15K_PA_rental_m` = " . $data[22];
        $insert .= ",`36_15K_PA_rental_m` = " . $data[50];
        $insert .= ",`48_15K_PA_rental_m` = " . $data[78];
        $insert .= ",`60_15K_PA_rental_m` = " . $data[106];
        $insert .= ",`24_20K_PA_rental_m` = " . $data[26];
        $insert .= ",`36_20K_PA_rental_m` = " . $data[54];
        $insert .= ",`48_20K_PA_rental_m` = " . $data[82];
        $insert .= ",`60_20K_PA_rental_m` = " . $data[110];
        $insert .= ",`24_30K_PA_rental_m` = " . $data[30];
        $insert .= ",`36_30K_PA_rental_m` = " . $data[58];
        $insert .= ",`48_30K_PA_rental_m` = " . $data[86];
        $insert .= ",`60_30K_PA_rental_m` = " . $data[114];
      }
      $update = "INSERT INTO `team`.`rates_alphabet`
      SET
      `cap_id` = " . $data[1] . ",
      `CO2` = " . $data[15] . ",
      `vehicle_list_price` = " . $data[23] . ",
      `vehicle_otr_price` = " . $data[32] . ",
      `p11d_price` = " . $data[35] . ",
      `updated` = NOW(),
      " . $insert . "
      ON DUPLICATE KEY UPDATE
      `updated` = NOW(),
      " . $insert . ";";
      echo $update . "<br />";
      $result2 = mysqli_query($conn, $update);
    }
    $row++;
  }
  echo "number of rows is: " . $row;
  $AdminMessage .= $row . " rows inserted\n";
  $AdminMessage .= "First pass upload"; 
  mail($adminEmail,"MR Alphabet Upload Monitor",$AdminMessage,"From: MR Server");
  fclose($handle);
}
else {
	mail($adminEmail,"Problem - MR Alphabet rates csv first pass upload","The csv upload has failed for some reason","From: MR Server");
}
// // Second pass
// if (($handle2 = fopen($csv , "r")) !== FALSE) {
//   while (($rawdata2 = fgetcsv($handle2, 0, ",")) !== FALSE) {
//     $data2 = preg_replace('/\s+/', '', $rawdata2);
//     if($row > 1){
//       if($data2[68] != 0){
//         switch($data2[67]){
//           case 24:
//           switch($data2[68]){
//             case 16000:
//             $mileage2 = 8000;
//             break;
//             case 20000:
//             $mileage2 = 10000;
//             break;
//             case 30000:
//             $mileage2 = 15000;
//             break;
//             case 40000:
//             $mileage2 = 20000;
//             break;
//             case 50000:
//             $mileage2 = 25000;
//             break;
//             case 60000:
//             $mileage2 = 30000;
//             break;
//             default:
//             echo $data2[68] . "mileage profile is not coded into 24 month mileage specifier";
//           }
//           break;
//           case 36:
//           switch($data2[68]){
//             case 24000:
//             $mileage2 = 8000;
//             break;
//             case 30000:
//             $mileage2 = 10000;
//             break;
//             case 45000:
//             $mileage2 = 15000;
//             break;
//             case 60000:
//             $mileage2 = 20000;
//             break;
//             case 75000:
//             $mileage2 = 25000;
//             break;
//             case 90000:
//             $mileage2 = 30000;
//             break;
//             default:
//             echo $data2[68] . "mileage profile is not coded into 36 month mileage specifier";
//           }
//           break;
//           case 48:
//           switch($data2[68]){
//             case 32000:
//             $mileage2 = 8000;
//             break;
//             case 40000:
//             $mileage2 = 10000;
//             break;
//             case 60000:
//             $mileage2 = 15000;
//             break;
//             case 80000:
//             $mileage2 = 20000;
//             break;
//             case 100000:
//             $mileage2 = 25000;
//             break;
//             case 120000:
//             $mileage2 = 30000;
//             break;
//             default:
//             echo $data2[68] . "mileage profile is not coded into 48 month mileage specifier";
//           }
//           break;
//           default:
//           echo $data2[67] . "monthly profile not coded";
//         }
//         switch($mileage2){
//           case 8000:
//           if($data2[70] == 0){
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_8K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 36:
//               $insert = "`36_8K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 48:
//               $insert = "`48_8K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 60:
//               $insert = "`60_8K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           else {
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_8K_PA_rental_m` = " . $data2[47];
//               break;
//               case 36:
//               $insert = "`36_8K_PA_rental_m` = " . $data2[47];
//               break;
//               case 48:
//               $insert = "`48_8K_PA_rental_m` = " . $data2[47];
//               break;
//               case 60:
//               $insert = "`60_8K_PA_rental_m` = " . $data2[47];
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           $update = "INSERT INTO `team`.`rates_alphabet`
//           SET
//           `cap_id` = " . $data2[1] . ",
//           `CO2` = " . $data2[15] . ",
//           `vehicle_list_price` = " . $data2[23] . ",
//           `vehicle_otr_price` = " . $data2[32] . ",
//           `p11d_price` = " . $data2[35] . ",
//           `updated` = NOW(),
//           " . $insert . "
//           ON DUPLICATE KEY UPDATE
//           `updated` = NOW(),
//           " . $insert . ";";
//           break;
//           case 10000:
//           if($data2[70] == 0){
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_10K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 36:
//               $insert = "`36_10K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 48:
//               $insert = "`48_10K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 60:
//               $insert = "`60_10K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           else {
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_10K_PA_rental_m` = " . $data2[47];
//               break;
//               case 36:
//               $insert = "`36_10K_PA_rental_m` = " . $data2[47];
//               break;
//               case 48:
//               $insert = "`48_10K_PA_rental_m` = " . $data2[47];
//               break;
//               case 60:
//               $insert = "`60_10K_PA_rental_m` = " . $data2[47];
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           $update = "INSERT INTO `team`.`rates_alphabet`
//           SET
//           `cap_id` = " . $data2[1] . ",
//           `CO2` = " . $data2[15] . ",
//           `vehicle_list_price` = " . $data2[23] . ",
//           `vehicle_otr_price` = " . $data2[32] . ",
//           `p11d_price` = " . $data2[35] . ",
//           `updated` = NOW(),
//           " . $insert . "
//           ON DUPLICATE KEY UPDATE
//           `updated` = NOW(),
//           " . $insert . ";";
//           break;
//           case 15000:
//           if($data2[70] == 0){
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_15K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 36:
//               $insert = "`36_15K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 48:
//               $insert = "`48_15K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 60:
//               $insert = "`60_15K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           else {
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_15K_PA_rental_m` = " . $data2[47];
//               break;
//               case 36:
//               $insert = "`36_15K_PA_rental_m` = " . $data2[47];
//               break;
//               case 48:
//               $insert = "`48_15K_PA_rental_m` = " . $data2[47];
//               break;
//               case 60:
//               $insert = "`60_15K_PA_rental_m` = " . $data2[47];
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           $update = "INSERT INTO `team`.`rates_alphabet`
//           SET
//           `cap_id` = " . $data2[1] . ",
//           `CO2` = " . $data2[15] . ",
//           `vehicle_list_price` = " . $data2[23] . ",
//           `vehicle_otr_price` = " . $data2[32] . ",
//           `p11d_price` = " . $data2[35] . ",
//           `updated` = NOW(),
//           " . $insert . "
//           ON DUPLICATE KEY UPDATE
//           `updated` = NOW(),
//           " . $insert . ";";
//           break;
//           case 20000:
//           if($data2[70] == 0){
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_20K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 36:
//               $insert = "`36_20K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 48:
//               $insert = "`48_20K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 60:
//               $insert = "`60_20K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           else {
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_20K_PA_rental_m` = " . $data2[47];
//               break;
//               case 36:
//               $insert = "`36_20K_PA_rental_m` = " . $data2[47];
//               break;
//               case 48:
//               $insert = "`48_20K_PA_rental_m` = " . $data2[47];
//               break;
//               case 60:
//               $insert = "`60_20K_PA_rental_m` = " . $data2[47];
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           $update = "INSERT INTO `team`.`rates_alphabet`
//           SET
//           `cap_id` = " . $data2[1] . ",
//           `CO2` = " . $data2[15] . ",
//           `vehicle_list_price` = " . $data2[23] . ",
//           `vehicle_otr_price` = " . $data2[32] . ",
//           `p11d_price` = " . $data2[35] . ",
//           `updated` = NOW(),
//           " . $insert . "
//           ON DUPLICATE KEY UPDATE
//           `updated` = NOW(),
//           " . $insert . ";";
//           break;
//           case 25000:
//           if($data2[70] == 0){
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_25K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 36:
//               $insert = "`36_25K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 48:
//               $insert = "`48_25K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 60:
//               $insert = "`60_25K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           else {
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_25K_PA_rental_m` = " . $data2[47];
//               break;
//               case 36:
//               $insert = "`36_25K_PA_rental_m` = " . $data2[47];
//               break;
//               case 48:
//               $insert = "`48_25K_PA_rental_m` = " . $data2[47];
//               break;
//               case 60:
//               $insert = "`60_25K_PA_rental_m` = " . $data2[47];
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           $update = "INSERT INTO `team`.`rates_alphabet`
//           SET
//           `cap_id` = " . $data2[1] . ",
//           `CO2` = " . $data2[15] . ",
//           `vehicle_list_price` = " . $data2[23] . ",
//           `vehicle_otr_price` = " . $data2[32] . ",
//           `p11d_price` = " . $data2[35] . ",
//           `updated` = NOW(),
//           " . $insert . "
//           ON DUPLICATE KEY UPDATE
//           `updated` = NOW(),
//           " . $insert . ";";
//           break;
//           case 30000:
//           if($data2[70] == 0){
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_30K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 36:
//               $insert = "`36_30K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 48:
//               $insert = "`48_30K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               case 60:
//               $insert = "`60_30K_PA_rental_nm` = " . ($data2[47]);
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           else {
//             switch($data2[67]){
//               case 24:
//               $insert = "`24_30K_PA_rental_m` = " . $data2[47];
//               break;
//               case 36:
//               $insert = "`36_30K_PA_rental_m` = " . $data2[47];
//               break;
//               case 48:
//               $insert = "`48_30K_PA_rental_m` = " . $data2[47];
//               break;
//               case 60:
//               $insert = "`60_30K_PA_rental_m` = " . $data2[47];
//               break;
//               default:
//               echo "no months defined";
//               break;
//             }
//           }
//           $update = "INSERT INTO `team`.`rates_alphabet`
//           SET
//           `cap_id` = " . $data2[1] . ",
//           `CO2` = " . $data2[15] . ",
//           `vehicle_list_price` = " . $data2[23] . ",
//           `vehicle_otr_price` = " . $data2[32] . ",
//           `p11d_price` = " . $data2[35] . ",
//           `updated` = NOW(),
//           " . $insert . "
//           ON DUPLICATE KEY UPDATE
//           `updated` = NOW(),
//           " . $insert . ";";
//           break;
//           default;
//           echo "Ratebook fault";
//         }
//         echo $update . "<br />";
//         $result2 = mysqli_query($conn, $update);
//       }
//       $row++;
//     }
//   }
//   echo "number of rows is: " . $row;
//   $AdminMessage .= $row . " rows inserted\n";
//   $AdminMessage .= "Second pass upload"; 
//   mail($adminEmail,"MR Alphabet Upload Monitor",$AdminMessage,"From: MR Server");
//   fclose($handle2);
// }
// else {
// 	mail($adminEmail,"Problem - MR Alphabet rates csv second pass upload","The csv upload has failed for some reason","From: MR Server");
// }
$conn->close();
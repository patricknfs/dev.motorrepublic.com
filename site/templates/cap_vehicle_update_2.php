<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
include "inc/functions.php";
// include "inc/manufacturer.php";
try
{
  $username = '173210';
  $password = 'NfS4Je';
  $date = date('Y/m/d');
  $client = get_soap_client_2();

  $query = "SELECT * FROM `team`.`vehicles`";
  $result = $conn->query($query) or die(mysqli_error($conn));
  // $prefix = $cap_ids = '';
  // foreach($result AS $vehicle) 
  // {
  //   $capidList .= $prefix . '"' . $vehicle . '"';
  //   $prefix = ', ';
  // }
  $capidset = array();
  while ($data = mysqli_fetch_array($result)) 
  {
    $capidset[] = $data['cap_id'];
  }
  // $capidList = implode(",", array_chunk($capidset, 1000));
  // $specdatelist = implode(",",array_chunk($specdateset,1000));
  $capidlist = array_chunk($capidset, 1000);
  $specdatelist = str_repeat("2019/03/24,",1000);
  $specdatelist = rtrim($specdatelist,',');
  foreach($capidlist AS $capidchunk)
  {
    // print_r($capidchunk);
    // echo $specdatelist;
    implode(",",$capidchunk);
    $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capidList' => $capidchunk, 'specDateList' => $specdatelist, 'techDataList' => 'CC,ENGINEPOWER_PS,CO2,MPG_COMBINED,INSURANCEGROUP1-50,STANDARDMANWARRANTY_MILEAGE,STANDARDMANWARRANTY_YEARS', 'returnVehicleDescription' => true, 'returnCaPcodeTechnicalItems' => true,  'returnCostNew' => true ); //define your parameters here
    $client->GetBulkTechnicalData($params);
    // echo "Response:\n" . $client->__getLastResponse() . "\n";
    $data_x = $client->__getLastResponse();
    $xml = str_replace(array("diffgr:","msdata:"),'', trim($data_x));
    $data = new SimpleXMLElement($xml);
    print_r($xml);
    // $groups = array_unique($data->xpath('//SE/Dc_Description'));
    // $equipment = $data->xpath('//SE');
    $cc = $data->xpath('//CC');
    print_r($cc);
    $co2 = $data->xpath('//CO2');
    $enginepower_ps = $data->xpath('//ENGINEPOWER_PS');
    $mpg_combined = $data->xpath('//MPG_COMBINED');
    $insurancegroup150 = $data->xpath('//INSURANCEGROUP150');
    $standardmanwarranty_mileage = $data->xpath('//STANDARDMANWARRANTY_MILEAGE');
    $standardmanwarranty_years = $data->xpath('//STANDARDMANWARRANTY_YEARS');
    $bodystyle = $data->xpath('//BodyStyle');

    $query2 = "UPDATE `team`.`vehicles` SET `cc` = '" . trim($cc[0]) . "', `co2` = '" . trim($co2[0]) . "', `enginepower_ps` = '" . trim($enginepower_ps[0]) . "', `mpg_combined` = '" . trim($mpg_combined[0]) . "', `insurancegroup1-50` = '" . trim($insurancegroup150[0]) ."', `standardmanwarranty_mileage` = '" . trim($standardmanwarranty_mileage[0]) . "', `standardmanwarranty_years` = '" . trim($standardmanwarranty_years[0]) . "', `bodystyle` = '" . trim($bodystyle[0]) . "'"; 
    echo $query2;
  }
  print_r($capidList);
  print_r($specdatelist);

  $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capidList' => $capidList, 'specDateList' => $date, 'techDataList' => 'CC,ENGINEPOWER_PS,CO2,MPG_COMBINED,INSURANCEGROUP1-50,STANDARDMANWARRANTY_MILEAGE,STANDARDMANWARRANTY_YEARS', 'returnVehicleDescription' => true, 'returnCaPcodeTechnicalItems' => true,  'returnCostNew' => true ); //define your parameters here
  $client->GetBulkTechnicalData($params);
  // echo "Response:\n" . $client->__getLastResponse() . "\n";
  $data_x = $client->__getLastResponse();
  $xml = str_replace(array("diffgr:","msdata:"),'', trim($data_x));
  $data = new SimpleXMLElement($xml);
  print_r($xml);
  // $groups = array_unique($data->xpath('//SE/Dc_Description'));
  // $equipment = $data->xpath('//SE');
  $cc = $data->xpath('//CC');
  print_r($cc);
  $co2 = $data->xpath('//CO2');
  $enginepower_ps = $data->xpath('//ENGINEPOWER_PS');
  $mpg_combined = $data->xpath('//MPG_COMBINED');
  $insurancegroup150 = $data->xpath('//INSURANCEGROUP150');
  $standardmanwarranty_mileage = $data->xpath('//STANDARDMANWARRANTY_MILEAGE');
  $standardmanwarranty_years = $data->xpath('//STANDARDMANWARRANTY_YEARS');
  $bodystyle = $data->xpath('//BodyStyle');

  $query2 = "UPDATE `team`.`vehicles` SET `cc` = '" . trim($cc[0]) . "', `co2` = '" . trim($co2[0]) . "', `enginepower_ps` = '" . trim($enginepower_ps[0]) . "', `mpg_combined` = '" . trim($mpg_combined[0]) . "', `insurancegroup1-50` = '" . trim($insurancegroup150[0]) ."', `standardmanwarranty_mileage` = '" . trim($standardmanwarranty_mileage[0]) . "', `standardmanwarranty_years` = '" . trim($standardmanwarranty_years[0]) . "', `bodystyle` = '" . trim($bodystyle[0]) . "'"; 
  echo $query2;

  // if ($result = $conn->query($query)) 
  // {
  //   printf("Select returned %d rows.\n", $result->num_rows);
  //   $result = $conn->query($query) or die(mysqli_error($conn));
  //   // $row = 0;
  //   // foreach($result AS $vehicle)
  //   // {
  //     $cap_id = $vehicle['cap_id'];
  //     $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capidList' => $cap_id, 'specDateList' => $date, 'techDataList' => 'CC,ENGINEPOWER_PS,CO2,MPG_COMBINED,INSURANCEGROUP1-50,STANDARDMANWARRANTY_MILEAGE,STANDARDMANWARRANTY_YEARS', 'returnVehicleDescription' => true, 'returnCaPcodeTechnicalItems' => true,  'returnCostNew' => true ); //define your parameters here
  //     $client->GetBulkTechnicalData($params);
  //     // echo "Response:\n" . $client->__getLastResponse() . "\n";
  //     $data_x = $client->__getLastResponse();
  //     $xml = str_replace(array("diffgr:","msdata:"),'', trim($data_x));
  //     $data = new SimpleXMLElement($xml);
  //     // $groups = array_unique($data->xpath('//SE/Dc_Description'));
  //     // $equipment = $data->xpath('//SE');
  //     $cc = $data->xpath('//CC');
  //     $co2 = $data->xpath('//CO2');
  //     $enginepower_ps = $data->xpath('//ENGINEPOWER_PS');
  //     $mpg_combined = $data->xpath('//MPG_COMBINED');
  //     $insurancegroup150 = $data->xpath('//INSURANCEGROUP150');
  //     $standardmanwarranty_mileage = $data->xpath('//STANDARDMANWARRANTY_MILEAGE');
  //     $standardmanwarranty_years = $data->xpath('//STANDARDMANWARRANTY_YEARS');
  //     $bodystyle = $data->xpath('//BodyStyle');

  //     $query2 = "UPDATE `team`.`vehicles` SET `cc` = '" . trim($cc[0]) . "', `co2` = '" . trim($co2[0]) . "', `enginepower_ps` = '" . trim($enginepower_ps[0]) . "', `mpg_combined` = '" . trim($mpg_combined[0]) . "', `insurancegroup1-50` = '" . trim($insurancegroup150[0]) ."', `standardmanwarranty_mileage` = '" . trim($standardmanwarranty_mileage[0]) . "', `standardmanwarranty_years` = '" . trim($standardmanwarranty_years[0]) . "', `bodystyle` = '" . trim($bodystyle[0]) . "' WHERE `cap_id` = '" . $cap_id . "'"; 
  //     // echo $query2;
  //     $result2 = $conn->query($query2) or die(mysqli_error($conn));
  //     echo "row number: " . $row . "\n";
  //     echo $cap_id . "\n";
  //   //   $row++;
  //   // // }
  //   /* free result set */
  //   $result->close();
  //   $result2->close();
  // }
}
catch(SoapFault $e){ 
  echo $e->getCode(). '<br />'. $e->getMessage();
}
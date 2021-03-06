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
  $client = get_soap_client_2();

  $query = "SELECT * FROM `team`.`vehicles`";
  $result = $conn->query($query) or die(mysqli_error($conn));

  $yesterday = date('Y/m/d',strtotime("-1 days")) . ",";

  $capidset = array();
  while ($data = mysqli_fetch_array($result)) 
  {
    $capidset[] = $data['cap_id'];
  }
  $capidlist = array_chunk($capidset, 700);
  $specdatelist = str_repeat($yesterday,700);
  $specdatelist = rtrim($specdatelist,',');
  foreach($capidlist AS $capidchunk)
  {
    $capidchunks = implode(",",$capidchunk);
    $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capidList' => $capidchunks, 'specDateList' => $specdatelist, 'techDataList' => 'CC,ENGINEPOWER_PS,CO2,MPG_COMBINED,INSURANCEGROUP1-50,STANDARDMANWARRANTY_MILEAGE,STANDARDMANWARRANTY_YEARS', 'returnVehicleDescription' => true, 'returnCaPcodeTechnicalItems' => true,  'returnCostNew' => true ); //define your parameters here
    $client->GetBulkTechnicalData($params);
    // echo "Response:\n" . $client->__getLastResponse() . "\n";
    $data_x = $client->__getLastResponse();
    $xml = str_replace(array("diffgr:","msdata:"),'', trim($data_x));
    $data = new SimpleXMLElement($xml);

    $xml_root = $data->xpath('//Tech_Table');
    foreach($xml_root AS $vehicle)
    {
      $capid = $vehicle->CAPID;
      $cc = $vehicle->CC;
      $co2 = $vehicle->CO2;
      $enginepower_ps = $vehicle->ENGINEPOWER_PS;
      $mpg_combined = $vehicle->MPG_COMBINED;
      $insurancegroup150 = $vehicle->INSURANCEGROUP150;
      $standardmanwarranty_mileage = $vehicle->STANDARDMANWARRANTY_MILEAGE;
      $standardmanwarranty_years = $vehicle->STANDARDMANWARRANTY_YEARS;
      $bodystyle = $vehicle->BodyStyle;

      $query2 = "UPDATE `team`.`vehicles` SET `cc` = '" . trim($cc[0]) . "', `co2` = '" . trim($co2[0]) . "', `enginepower_ps` = '" . trim($enginepower_ps[0]) . "', `mpg_combined` = '" . trim($mpg_combined[0]) . "', `insurancegroup1-50` = '" . trim($insurancegroup150[0]) ."', `standardmanwarranty_mileage` = '" . trim($standardmanwarranty_mileage[0]) . "', `standardmanwarranty_years` = '" . trim($standardmanwarranty_years[0]) . "', `bodystyle` = '" . trim($bodystyle[0]) . "' WHERE `cap_id` = '" . $capid . "'"; 
      // echo $query2;
      $result2 = $conn->query($query2) or die(mysqli_error($conn));
    }
  }
}
catch(SoapFault $e){ 
  echo $e->getCode(). '<br />'. $e->getMessage();
}
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
  $date = date('c');
  $client = get_soap_client_2();

  $query = "SELECT * FROM `team`.`vehicles`";
  if ($result = $conn->query($query)) {
    printf("Select returned %d rows.\n", $result->num_rows);
    $result = $conn->query($query) or die(mysqli_error($conn));
    foreach($result AS $vehicle) {
      $cap_id = $vehicle['cap_id'];
      $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capidList' => $cap_id, 'specDateList' => $date, 'techDataList' => 'CC,ENGINEPOWER_PS,CO2,MPG_COMBINED,INSURANCEGROUP1-50,STANDARDMANWARRANTY_MILEAGE,STANDARDMANWARRANTY_YEARS', 'returnVehicleDescription' => true, 'returnCaPcodeTechnicalItems' => true,  'returnCostNew' => true ); //define your parameters here
      $client->GetBulkTechnicalData($params);
      $data = $client->__getLastResponse();
      // $xml = str_replace(array("diffgr:","msdata:"),'', trim($data));
      // $data = new SimpleXMLElement($xml);
      $xml = simplexml_load_string($data);
      // $groups = array_unique($data->xpath('//SE/Dc_Description'));
      // $equipment = $data->xpath('//SE');
      $cc = $xml->xpath('//CC');
      var_dump((string)$cc[0]);
      $co2 = $data->xpath('//CO2');
      print_r($co2);
      $enginepower_ps = '';
      $mpg_combined = '';
      $insurancegroup150 = ''; 
      $standardmanwarranty_mileage = '';
      $standardmanwarranty_years = '';
      $bodystyle = $data->xpath('//BodyStyle');

      $query2 = "UPDATE `team`.`vehicles` SET `cc` = '" . $cc . "', `co2` = '" . $co2 . "', `enginepower_ps` = '$enginepower_ps', `mpg_combined` = '" . $mpg_combined . "', `insurancegroup1-50` = '" . $insurancegroup150 ."', `standardmanwarranty_mileage` = '" . $standardmanwarranty_mileage . "', `standardmanwarranty_years` = '" . $standardmanwarranty_years . "', `bodystyle` = '" . $bodystyle . "' WHERE `cap_id` = '" . $cap_id . "'"; 
      echo $query2;
      // $result2 = $conn->query($query2) or die(mysqli_error($conn));
    }
    /* free result set */
    $result->close();
    $result2->close();
  }
}
catch(Exception $e){ 
  echo $e->getCode(). '<br />'. $e->getMessage();
}
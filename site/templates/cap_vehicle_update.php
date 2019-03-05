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
  if ($result = $conn->query($query)) {
    printf("Select returned %d rows.\n", $result->num_rows);
    $result = $conn->query($query) or die(mysqli_error($conn));
    foreach($result AS $vehicle) {
      $cap_id = $vehicle['cap_id'];
      $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capidList' => $cap_id, 'specDateList' => $date, 'techDataList' => 'CC,ENGINEPOWER_PS,CO2,MPG_COMBINED,INSURANCEGROUP1-50,STANDARDMANWARRANTY_MILEAGE,STANDARDMANWARRANTY_YEARS', 'returnVehicleDescription' => true, 'returnCaPcodeTechnicalItems' => true,  'returnCostNew' => true ); //define your parameters here
      $client->GetBulkTechnicalData($params);
      echo "Response:\n" . $client->__getLastResponse() . "\n";
      $data = $client->__getLastResponse();
      $xml = str_replace(array("diffgr:","msdata:"),'', trim($data));
      $data = new SimpleXMLElement($xml);
      // $groups = array_unique($data->xpath('//SE/Dc_Description'));
      // $equipment = $data->xpath('//SE');
      $cc = $data->xpath('//CC');
      $co2 = $data->xpath('//CO2');
      $enginepower_ps = $data->xpath('//ENGINEPOWER_PS');
      $mpg_combined = $data->xpath('//MPG_COMBINED');
      $insurancegroup150 = $data->xpath('//INSURANCEGROUP150');
      $standardmanwarranty_mileage = $data->xpath('//STANDARDMANWARRANTY_MILEAGE');
      $standardmanwarranty_years = $data->xpath('//STANDARDMANWARRANTY_YEARS');
      $bodystyle = $data->xpath('//BodyStyle');

      $query2 = "UPDATE `team`.`vehicles` SET `cc` = '" . $cc[0] . "', `co2` = '" . $co2[0] . "', `enginepower_ps` = '$enginepower_ps', `mpg_combined` = '" . $mpg_combined . "', `insurancegroup1-50` = '" . $insurancegroup150 ."', `standardmanwarranty_mileage` = '" . $standardmanwarranty_mileage . "', `standardmanwarranty_years` = '" . $standardmanwarranty_years . "', `bodystyle` = '" . $bodystyle[0] . "' WHERE `cap_id` = '" . $cap_id . "'"; 
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
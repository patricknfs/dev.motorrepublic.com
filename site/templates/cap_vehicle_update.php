<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
include "inc/functions.php";
// include "inc/manufacturer.php";

// $params = array('subscriberId' => $username, 'password' => $password, 'database' => $carlcv, 'capid' => $input->urlSegment(), 'seDate' => $date, 'justCurrent' => true ); //define your parameters here
// $client->GetBulkTechnicalDataResponse($params);
// $data = $client->__getLastResponse();
// $xml = str_replace(array("diffgr:","msdata:"),'', trim($data));
// $data = new SimpleXMLElement($xml);
// $groups = array_unique($data->xpath('//SE/Dc_Description'));
// $equipment = $data->xpath('//SE');

if ($result = $mysqli->query("SELECT * FROM `team`.`vehicles`")) {
  printf("Select returned %d rows.\n", $result->num_rows);

  /* free result set */
  $result->close();
}

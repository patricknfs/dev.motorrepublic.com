<?php
// vehicle.php
include "power_search.php";
// $products = $pages->find("$selector, limit=12, sort=sequence, sort=colour");

// $pagination = $products->renderPager(array(
//   'nextItemLabel' => "Next",
//   'previousItemLabel' => "Prev",
//   'listMarkup' => "<ul class='MarkupPagerNav pagination text-center'role='navigation' aria-label='Pagination'>{out}</ul>",
//   'currentItemClass' => "current",
//   'itemMarkup' => "<li class='{class}'>{out}</li>",
//   'linkMarkup' => "<a href='{url}'><span>{out}</span></a>"  
// ));
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
include "inc/functions.php";
include "inc/manufacturer.php";
// print_r($_POST);
// if(isset($input->urlSegment1)) {
//   $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`deal_notes` FROM `team`.`rates_combined` WHERE `cap_id` = " . $input->urlSegment1 . " ORDER BY `rental` ASC LIMIT 1";
//   echo $query;
//   $result = $conn->query($query) or die(mysqli_error($conn));
//   $data = $result->fetch_assoc();

//   $bch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+2)), 2, '.', ',');
//   $pch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+2)*1.2), 2, '.', ',');
//   $bch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+2))*3), 2, '.', ',');
//   $pch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+2)*1.2)*3), 2, '.', ',');

//   $hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));
// }
// else {
//   echo "<p>Vehicle not available. Please contact the team</p>";
// }

try
{
  $username = '173210';
  $password = 'NfS4Je';
  $date = date('c');
  $client = get_soap_client_2();

  $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capid' => $input->urlSegment1, 'seDate' => $date, 'justCurrent' => true ); //define your parameters here
  $client->GetStandardEquipment($params);
  $data = $client->__getLastResponse();
  $xml = str_replace(array("diffgr:","msdata:"),'', trim($data));
  $data = new SimpleXMLElement($xml);
  $groups = array_unique($data->xpath('//SE/Dc_Description'));
  $equipment = $data->xpath('//SE');

  $params2 = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capid' => $input->urlSegment1, 'techDate' => $date, 'justCurrent' => true ); //define your parameters here
  $client->GetTechnicalData($params2);
  $data2 = $client->__getLastResponse();
  $xml2 = str_replace(array("diffgr:","msdata:"),'', trim($data2));
  $data2 = new SimpleXMLElement($xml2);
  $groups2 = array_unique($data2->xpath('//Tech/Dc_Description'));
  $tech_data = $data2->xpath('//Tech');

  if(isset($input->urlSegment1)) {
    $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2` FROM `team`.`rates_combined_terse` WHERE `cap_id` = " . $input->urlSegment1 . " ORDER BY `rental` ASC LIMIT 1";
    // echo $query;
    $result = $conn->query($query) or die(mysqli_error($conn));
    $data = $result->fetch_assoc();
  
    $bch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+8)), 2, '.', ',');
    $pch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+8)*1.2), 2, '.', ',');
    $bch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+8))*9), 2, '.', ',');
    $pch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+8)*1.2)*9), 2, '.', ',');
  
    $hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));
  }
  else {
    echo "<p>Vehicle not available. Please contact the team</p>";
  }

}
catch(Exception $e){ 
    echo $e->getCode(). '<br />'. $e->getMessage();
}

ob_start();
include('views/vehicle_main.php');
$page->main = ob_get_clean();
include("./main.php");
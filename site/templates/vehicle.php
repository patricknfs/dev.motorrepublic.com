<?php
// vehicle.php
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
include "power_search.php";
$_GET['vid'] = $input->urlSegment();
try
{
  $username = '173210';
  $password = 'NfS4Je';
  $date = date('c');
  $client = get_soap_client_2();



  if(null !== $input->urlSegment()) {
    $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`lcv`,`upfront`, `special` FROM `team`.`rates_combined_terse` WHERE `cap_id` = " . $input->urlSegment() . " ORDER BY `rental` ASC LIMIT 1";
    // echo $query;
    $result = $conn->query($query) or die(mysqli_error($conn));
    $data = $result->fetch_assoc();
  

    if($data['special'] == 1){
      $bch_rental = number_format($data['rental'], 2, '.', ',');
      $pch_rental = number_format(($data['rental']*1.2), 2, '.', ',');
      $bch_initial = (($data['special_upfront'])?$data['special_upfront']:number_format(($data['rental'] * $data['upfront']), 2, '.', ','));
      $pch_initial = number_format((($data['rental'] * $data['upfront'])*1.2), 2, '.', ',');
    }
    else {
      $bch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+8)), 2, '.', ',');
      $pch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+8)*1.2), 2, '.', ',');
      $bch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+8))*9), 2, '.', ',');
      $pch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+8)*1.2)*9), 2, '.', ',');
    }
    // $hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));
    $vehicle_type = ($data['lcv'] == 1?"LCV":"CAR");
    $manufacturer = $data['manufacturer'];
    $_GET['manufacturer'] = $manufacturer;
    $model = $data['model'];
    $_GET['model'] = $model;
    $descr = $data['descr'];
    $_GET['description_1'] = $descr;
    $special = $data['special'];
    $term = str_replace("M", '', $data['term'])-1;
    $mileage = str_replace("K",",000",$data['mileage']);
    $hashcode = strtoupper(md5("173210NfS4Je" . $vehicle_type . $data['cap_id']));
  } else {
    echo "<p>Vehicle not available. Please contact the team</p>";
  }
}
catch(Exception $e){ 
    echo $e->getCode(). '<br />'. $e->getMessage();
}

$params = array('subscriberId' => $username, 'password' => $password, 'database' => $data['lcv'] == 1?"LCV":"CAR", 'capid' => $input->urlSegment(), 'seDate' => $date, 'justCurrent' => true ); //define your parameters here
$client->GetStandardEquipment($params);
$data = $client->__getLastResponse();
$xml = str_replace(array("diffgr:","msdata:"),'', trim($data));
$data = new SimpleXMLElement($xml);
$groups = array_unique($data->xpath('//SE/Dc_Description'));
$equipment = $data->xpath('//SE');

$params2 = array('subscriberId' => $username, 'password' => $password, 'database' => $data['lcv'] == 1?"LCV":"CAR", 'capid' => $input->urlSegment(), 'techDate' => $date, 'justCurrent' => true ); //define your parameters here
$client->GetTechnicalData($params2);
$data2 = $client->__getLastResponse();
$xml2 = str_replace(array("diffgr:","msdata:"),'', trim($data2));
$data2 = new SimpleXMLElement($xml2);
$groups2 = array_unique($data2->xpath('//Tech/Dc_Description'));
$tech_data = $data2->xpath('//Tech');

ob_start();
include('views/vehicle_main.php');
$page->main = ob_get_clean();
include("./main.php");
<?php
// vehicles.php

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
// print_r($_POST);
if(isset($input->urlSegment1)) {
  $query = "SELECT `id`,`cap_id`,`cap_code`,`source`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`deal_notes` FROM `team`.`rates_combined` WHERE `cap_id` = " . $input->urlSegment1 . " ORDER BY `rental` ASC LIMIT 1";
}
else {
  echo "<p>Vehicle not available. Please contact the team</p>";
}

echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));
$data = $result->fetch_assoc();

$bch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+2)), 2, '.', ',');
$pch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+2)*1.2), 2, '.', ',');
$bch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+2))*3), 2, '.', ',');
$pch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+2)*1.2)*3), 2, '.', ',');

$hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));

try
    {   
        $username = '173210';
        $password = 'NfS4Je';
        $date = date('Y-m-dTH:m:s.v');
        $client = get_soap_client();
        $params = array('subscriberId' => $username, 'password' => $password, 'database' => 'car', 'capid' => $input->urlSegment1, 'seDate' => $date, 'justCurrent' => true ); //define your parameters here
        $client->GetStandardEquipment($params);
        $data = $client->__getLastResponse();
        $xml    = str_replace(array("diffgr:","msdata:"),'', trim($data));
        $data = new SimpleXMLElement($xml);
        $marques  = $data->xpath('//Table');
        foreach($marques as $item){
            echo "ManCode: " . $item->CMan_Code . " and Manufacturer: " . $item->CMan_Name . "<br />";
            $range_params = array('justCurrentRanges' => true,'subscriberId' => $username, 'password' => $password, 'database' => 'car', 'manCode' => $item->CMan_Code, 'bodyStyleFilter' => '' ); //define your parameters here
            $client->GetCapRange_IncludeOnRunout($range_params);
            $data_range = $client->__getLastResponse();
            $xml_range    = str_replace(array("diffgr:","msdata:"),'', trim($data_range));
            // echo "<pre>";
            //     print_r($xml_range);
            // echo"</pre>";
            $data_range = new SimpleXMLElement($xml_range);
            $ranges  = $data_range->xpath('//Table');
            foreach($ranges as $range){
                echo "RangeCode: " . $range->CRan_Code . " Range: " . $item->CMan_Name . " " . $range->CRan_Name . "<br />";
                $mod_params = array('justCurrentModels' => true,'subscriberId' => $username, 'password' => $password, 'database' => 'car', 'manRanCodeIsMan' => false, 'manRanCode' => $range->CRan_Code, 'bodyStyleFilter' => '' ); //define your parameters here
                // $client->GetCapMod_IncludeOnRunout($mod_params);
                // $data_mod = $client->__getLastResponse();
                // $xml_mod    = str_replace(array("diffgr:","msdata:"),'', trim($data_mod));
                // echo "<pre>";
                //     print_r($xml_mod);
                // echo"</pre>";
                // $data_mod = new SimpleXMLElement($xml_mod);
                // $models  = $data_mod->xpath('//Table');
                // foreach ($models AS $model){
                //     echo "ModCode: " . $range->CRan_Code . " Model: " . $item->CMan_Name . " " . $range->CRan_Name . " " . $model->CMod_Name . "<br />";
                // }
            }
        }
    }

    catch(Exception $e){ 
        echo $e->getCode(). '<br />'. $e->getMessage();
    }

ob_start();
include('views/vehicle_main.php');
$page->main = ob_get_clean();
include("./main.php");
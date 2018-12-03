<!-- home.php -->
<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
include "power_search.php";
$manuf = $page->top_deal_manuf;
// $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2` FROM `team`.`rates_combined` WHERE `manufacturer` = '" . strtoupper($manuf) . "' GROUP BY `model` ORDER BY `rental` ASC LIMIT 6";
$query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`,`rental`, `vehicle_list_price`, `vehicle_otr_price`,`p11d_price`,`CO2` FROM `team`.`rates_combined_terse` WHERE `special` = true ORDER BY `rental` ASC LIMIT 6";
$result = $conn->query($query) or die(mysqli_error($conn));
$data = $result->fetch_assoc();
// echo $query;
ob_start();
include('views/home_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
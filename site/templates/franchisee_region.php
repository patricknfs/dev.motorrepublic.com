<?php
// franchisee_region.php
include "inc/functions.php";
$testimonial = $pages->get("template=testimonial, sort=random, limit=1");
$testimonial_blurb = truncateText($testimonial->body, 250);

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

$query = "SELECT `id`,`cap_id`,`cap_code`,`source`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`deal_notes` FROM `team`.`rates_combined` WHERE `manufacturer` LIKE 'mercedes||jaguar||bmw' GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT 4";

// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

ob_start();
include('views/franchisee_region_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
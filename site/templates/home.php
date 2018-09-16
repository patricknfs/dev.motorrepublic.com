<!-- home.php -->
<?php
$manuf = $page->top_deal_manuf;
$query = "SELECT `id`,`cap_id`,`cap_code`,`source`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`deal_notes` FROM `team`.`rates_combined` WHERE `manufacturer` = '" . $manuf . "' ORDER BY `rental` ASC LIMIT 6";
$result = $conn->query($query) or die(mysqli_error($conn));
$data = $result->fetch_assoc();
echo $query
ob_start();
include('views/home_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
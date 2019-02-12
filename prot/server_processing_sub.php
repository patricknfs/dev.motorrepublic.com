<?php
session_start();
date_default_timezone_set('GMT');
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/config.php';
require_once(PPW_PATH . "/inc/conn2.php");
require_once(PPW_PATH . "/inc/functions.php");

$tid = inputGet('tid');
mysqli_query($conn2, 'SET CHARACTER SET utf8');
$query2 = "
	SELECT `vehicle_list_price`,`vehicle_otr_price`, `p11d_price`, `CO2` FROM `rates_combined` WHERE `id` = " . $tid . " LIMIT 1
";
// echo $query2;
$result2 = $conn2->query($query2)  or die(mysqli_error());
// iterate over every row
while ($row = mysqli_fetch_assoc($result2)) {
	// for every field in the result..
	
	$row2['xml_date'] = $row['vehicle_list_price'];
	$row2['xml_date'] = $row['vehicle_otr_price'];
	$row2['xml_date'] = $row['p11d_price'];
	$row2['xml_date'] = $row['CO2'];

	$rows[] = $row2;
}
// print_r($rows);
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
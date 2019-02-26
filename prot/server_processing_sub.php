<?php
session_start();
date_default_timezone_set('GMT');
require_once $_SERVER['DOCUMENT_ROOT'] . '/site/templates/inc/config.php';
// echo $_SERVER['DOCUMENT_ROOT'];
require_once(MR_PATH . "/inc/conn.php");
require_once(MR_PATH . "/inc/functions.php");
// echo "tid is " . $_GET['tid'];
$tid = filter_input(INPUT_GET, "tid", FILTER_SANITIZE_STRING);
mysqli_query($conn, 'SET CHARACTER SET utf8');
$query2 = "SELECT `vehicle_list_price`,`vehicle_otr_price`, `p11d_price`, `CO2`, `deal_notes` FROM `rates_combined` WHERE `id` = '" . $tid . "' LIMIT 1";
// echo $query2;
$result2 = $conn->query($query2)  or die(mysqli_error($query2));
// iterate over every row
while ($row = mysqli_fetch_assoc($result2)) {
	// for every field in the result..
	$row2['vehicle_list_price'] = $row['vehicle_list_price'];
	$row2['vehicle_otr_price'] = $row['vehicle_otr_price'];
	$row2['p11d_price'] = $row['p11d_price'];
	$row2['CO2'] = $row['CO2'];
	$row2['deal_notes'] = $row['deal_notes'];

	$rows[] = $row2;
}
print_r($rows);
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
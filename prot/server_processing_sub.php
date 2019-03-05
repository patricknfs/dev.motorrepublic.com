<?php
session_start();
date_default_timezone_set('GMT');
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
require_once $_SERVER['DOCUMENT_ROOT'] . '/site/templates/inc/config.php';
// echo $_SERVER['DOCUMENT_ROOT'];
require_once(MR_PATH . "/inc/conn.php");
require_once(MR_PATH . "/inc/functions.php");
$tid = filter_input(INPUT_GET, "tid", FILTER_SANITIZE_STRING);
echo "tid is: " . $tid;
mysqli_query($conn, 'SET CHARACTER SET utf8');
$query = "SELECT `id`,`deal_notes` FROM `team`.`rates_combined` WHERE `id` = '" . $tid . "' LIMIT 1";
$result = $conn->query($query);
while ($row = mysqli_fetch_assoc($result)) {
	$row2['deal_notes'] = $row['deal_notes'];

	$rows[] = $row2;
}

$query2 = "SELECT `cc`,`co2`,`enginepower_ps`,`mpg_combined`,`insurancegroup1-50`,`standardmanwarranty_mileage`,`standardmanwarranty_years`,`bodystyle`,`p11d` FROM `team`.`vehicles` WHERE `id` = '" . $tid . "' LIMIT 1";
$result2 = $conn->query($query2);

while ($row3 = mysqli_fetch_assoc($result2)) {
	$row4['cc'] = $row['cc'];
	$row4['co2'] = $row['co2'];
	$row4['enginepower_ps'] = $row['enginepower_ps'];
	$row4['mpg_combined'] = $row['mpg_combined'];
	$row4['insurancegroup1-50'] = $row['insurancegroup1-50'];
	$row4['standardmanwarranty_mileage'] = $row['standardmanwarranty_mileage'];
	$row4['standardmanwarranty_years'] = $row['standardmanwarranty_years'];
	$row4['bodystyle'] = $row['bodystyle'];
	$row4['p11d_price'] = $row['p11d_price'];

	$rows[] .= $row4;
}
print_r($rows);
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
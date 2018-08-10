<?php
// get_row_details.php
// print_r($_GET);
header('Content-type: application/json; charset=utf-8');
session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php';
if($_GET){
  $manufacturer = $_GET['manufacturer'];
}
else {
  $manufacturer = '%';
}
// echo $manufacturer;

// $where = " WHERE `manufacturer` = '" . $manufacturer . "' ";

// $manufacturer = "ford";
$query = "SELECT `cap_id`, `cap_code`, `source`, `manufacturer`, `model`, `descr`, `term`, `mileage`, `rental`
  ORDER BY rental DESC
";
// echo $query; 
$result = $conn->query($query) or die(mysqli_error());

// iterate over every row
while ($row = mysqli_fetch_assoc($result)) {
  // for every field in the result..
  $row['source'];
  $row['cap_id'];
  $row['cap_code'];
  $row['manufacturer'];
  $row['term'];
  $row['mileage'];
  $row['model'];
  $row['descr'];
	$row['rental'];

	$rows[] = $row;
}
// print '<pre>'; 
// print_r($rows);
// print '</pre>'; 
echo json_encode($rows, JSON_PRETTY_PRINT);
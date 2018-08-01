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

$where = " WHERE `manufacturer` = '" . $manufacturer . "' ";

// $manufacturer = "ford";
$query = "SELECT 
  mr2.src AS source , mr1.man AS `manufacturer`, mr1.mod AS `model`, mr1.cap_desc AS `descr`, mr1.code AS `cap_id`, mr1.capcode AS cap_code, mr2.rent AS `rental`
  FROM
  (
    SELECT 
      `manufacturer` AS `man`, `model` AS `mod`, `description` AS `cap_desc`, `cap_id` AS `code`, `cap_code` AS `capcode`
    FROM
      `team`.`vehicles`
  ) AS mr1
  LEFT JOIN
  (
    (
      SELECT 
        'arval' AS src, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid` 
      FROM
        `team`.`rates_arval`
    )
    UNION
    (
      SELECT 
      'ald' AS src, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid` 
      FROM
        `team`.`rates_ald`
    )
    UNION
    (
      SELECT 
      'hitachi' AS src, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid` 
      FROM
        `team`.`rates_hitachi`
    )
  ) AS mr2
  WHERE `source` NOT NULL
  ON mr1.code = mr2.capid
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
  $row['model'];
  $row['descr'];
	$row['rental'];

	$rows[] = $row;
}
// print '<pre>'; 
// print_r($rows);
// print '</pre>'; 
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
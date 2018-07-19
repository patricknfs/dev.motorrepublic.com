<?php
// print_r($_GET);
// get_row_details.php
header('Content-type: application/json; charset=utf-8');
session_start();
$capid = 83661;
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once("/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php");

$query = "SELECT 
  x2.src AS source , x1.man AS `manufacturer`, x1.mod AS `model`, x1.cap_desc AS `descr`, x1.code AS `cap_id`, x2.rent AS `rental`
  FROM
  (
    SELECT 
      `manufacturer` AS `man`, `model` AS `mod`, `description` AS `cap_desc`, `cap_id` AS `code`
    FROM
      `team`.`vehicles`
    WHERE
      
  ) AS x1
  LEFT JOIN
  (
    (
    SELECT 
      'arval' AS src, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid` 
    FROM
      `team`.`rates_arval`
    WHERE
      
    )
    UNION
    (
    SELECT 
    'ald' AS src, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid` 
    FROM
      `team`.`rates_ald`
    WHERE
      
    )
    UNION
    (
    SELECT 
    'hitachi' AS src, `24_8K_PA_rental_m` AS rent, `cap_id` AS `capid` 
    FROM
      `team`.`rates_hitachi`
    WHERE
      
    )
  ) AS x2
  ON x2.capid = $capid
  ORDER BY rental DESC LIMIT 5
";
// echo $query;
$result = $conn->query($query) or die(mysqli_error());

// iterate over every row
while ($row = mysqli_fetch_assoc($result)) {
	// for every field in the result..
  $row['cap_id'];
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
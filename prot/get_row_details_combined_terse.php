<?php
// get_row_details.php
// print_r($_GET);
header('Content-type: application/json; charset=utf-8');
session_start();
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php';

$truncate = "TRUNCATE TABLE `team`.`rates_combined_terse`";
$result2 = $conn->query($truncate) or die(mysqli_error());

$query = "SELECT t1.*
  FROM (
    SELECT cap_id, src, MIN(rental) AS rent FROM team.rates_combined GROUP BY cap_id
  ) as t2 INNER JOIN team.rates_combined AS t1 ON t1.cap_id = t2.cap_id AND t1.rental = t2.rent
  GROUP BY t1.cap_id ORDER BY t1.rental ASC
";
// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));
// iterate over every row
$row = 1;

while ($row = mysqli_fetch_assoc($result)) {
  // for every field in the result..
  $insert = "INSERT INTO `team`.`rates_combined_terse` VALUES ('','" . $row['cap_id'] . "', '" . $row['cap_code'] . "', '" . $row['src'] . "', '" . $row['updated'] . "', '', '" . strtoupper($row['manufacturer']) . "', '" . strtoupper($row['model']) . "', '" . $row['descr'] . "', '" . $row['term'] . "', '" . $row['mileage'] . "', '" . $row['rental'] . "', '" . $row['vehicle_list'] . "', '" . $row['vehicle_otr'] . "', '" . $row['p11d'] . "', '" . $row['CO2_no'] . "', '" . $row['lcv'] . "', '" . $row['special'] . "', '" . $row['deal_notes'] . "', '" . $row['upfront'] . "', '" . str_replace(',','',$row['special_upfront']) . "', '" . $row['website_deal_notes'] . "', '" . $row['biz_only'] . "')";
  // echo $insert;
  $result3 = $conn->query($insert) or die(mysqli_error($conn));
  $row++;
} 
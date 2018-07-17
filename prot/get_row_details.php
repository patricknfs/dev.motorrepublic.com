<?php
// get_row_details.php

session_start();

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once("/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/conn.php");

$adg = inputGet('adg');
$adp = inputGet('adp');
$cam = inputGet('cam');
$query = "SELECT 
    x1.manufacturer AS manufacturer, x1.model AS model, x1.description AS descr, cap_code AS x1.cap_code, x2.rental AS rental
	 FROM
    (
    SELECT 
        `manufacturer`, `model`, `description`, `cap_code`
    FROM
        `team`.`vehicles`
    WHERE
        cap_id = 83661 ) as x1
        LEFT JOIN
    (
    SELECT 
        `24_8K_PA_rental_m` AS rental
    FROM
        `team`.`rates_arval`
    WHERE
        `cap_id` = 83661
    -- GROUP BY transdate
    ) AS x2 ON x2.cap_id = rdate
    -- WHERE x2.barcomm  != ''
    ORDER BY rental DESC LIMIT 5
";
echo $query;
$result = $conn2->query($query)  or die(mysqli_error());

// iterate over every row
while ($row = mysqli_fetch_assoc($result)) {
	// for every field in the result..
  $row['cap_id'],
  $row['manufacturer'],
  $row['model'],
  $row['descr']
	$row['rental'];

	$rows[] = $row;
}
print_r($rows);
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
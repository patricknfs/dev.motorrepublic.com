<?php
session_start();
date_default_timezone_set('GMT');
require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/config.php';
require_once(PPW_PATH . "/inc/conn2.php");
require_once(PPW_PATH . "/inc/functions.php");

$since = inputGet('since');
switch($since) {
	case "2009":
		$start_date = "2009-01-01";
	break;
	case "2010":
		$start_date = "2010-01-01";
	break;
	case "2011":
		$start_date = "2011-01-01";
	break;
	case "2012":
		$start_date = "2012-01-01";
	break;
  case "2013":
    $start_date = "2013-01-01";
  break;
  case "2014":
    $start_date = "2014-01-01";
  break;
  case "2015":
    $start_date = "2015-01-01";
  break;
  case "2016":
    $start_date = "2016-01-01";
  break;
  case "2017":
    $start_date = "2017-01-01";
  break;
	default:
		$start_date = "2017-01-01";
}

$adg = inputGet('adg');
$adp = inputGet('adp');
$cam = inputGet('cam');
$query = "SELECT 
    rdate AS xml_date, x2.barcomm AS comms
	 FROM
    (
    SELECT 
        rdate
    FROM
        `brains`.`refdates`
    WHERE
        DATE(rdate) >= '" . $start_date . "') as x1
        LEFT JOIN
    (
    SELECT 
        DATE(trans_date) as transdate, SUM(comm) AS barcomm
    FROM
        clever.actual
    WHERE
        trans_date >= '" . $start_date . "' AND campaign = '" . $cam . "' AND adgroup = '" . $adg . "' AND ad_provider LIKE '%" . $adp . "%'
    GROUP BY transdate
    ) AS x2 ON x2.transdate = rdate
    WHERE x2.barcomm  != ''
    ORDER BY xml_date DESC LIMIT 10
";
// echo $query;
$result = $conn2->query($query)  or die(mysqli_error());

// iterate over every row
while ($row = mysqli_fetch_assoc($result)) {
	// for every field in the result..

	$row['xml_date'] = mysql2uk2($row['xml_date']);
	$row['comms'];

	$rows[] = $row;
}
// print_r($rows);
echo json_encode($rows, JSON_PRETTY_PRINT);
?>
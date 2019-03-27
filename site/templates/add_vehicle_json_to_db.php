<?php
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once MR_PATH . "/inc/conn.php";

$truncate = "TRUNCATE TABLE `team`.`vehicle_json`";
$result2 = $conn->query($truncate) or die(mysqli_error());

$json = file_get_contents('vehicle.json');
$json_data = json_decode($json,true);

foreach($json_data AS $vehicle_json)
{
  $query = "INSERT INTO team.vehicle_json (`json_id`,`name`,`parent_id`) VALUES ('$vehicle_json[id]','$vehicle_json[name]','$vehicle_json[parent_id]')";
  $result = $conn->query($query);
}
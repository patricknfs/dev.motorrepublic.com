<?php
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once MR_PATH . "/inc/conn.php";

// Read JSON file
$json = file_get_contents('vehicle.json');

//Decode JSON
$json_data = json_decode($json,true);

//Print data
// print_r($json_data);

foreach($json_data AS $vehicle_json)
{
  $query = "INSERT INTO team.vehicle_json (`json_id`,`name`,`parent_id`) VALUES ('$vehicle_json[id]','$vehicle_json[name]','$vehicle_json[parent_id]')";
  $result = $conn->query($query);
}
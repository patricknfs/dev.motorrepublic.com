<?php
date_default_timezone_set('CET');
function get_data()
{
  require_once "/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php";
  require_once MR_PATH . "/inc/conn.php";
  require_once MR_PATH . "/inc/functions.php";
  $query = "SELECT `id`, `manufacturer` FROM `team`.`rates_combined_terse` WHERE `special` = 1 GROUP BY `manufacturer` ORDER BY `manufacturer` ASC";
  $result = mysqli_query($conn, $query);
  $marque_data = array();
  while ($row = mysqli_fetch_array($result)) {
    $marque_data[] = array(
      'id' => $row["id"],
      'name' => $row["manufacturer"],
      'parent_id' => 0
    );
  }
  $query = "SELECT `id`, `manufacturer`, `model` FROM `team`.`rates_combined_terse` WHERE `special` = 1 GROUP BY `manufacturer` ORDER BY `manufacturer` ASC";
  $result = mysqli_query($conn, $query);
  $marque_data = array();
  while ($row = mysqli_fetch_array($result)) {
    array_push($marque_data, array(
      'id' => $row["id"],
      'name' => $row["model"],
      'parent_id' => 1
    ));
  }
  return json_encode($marque_data, JSON_PRETTY_PRINT);
}

// echo "<pre>";
// print_r(get_data());
// echo "</pre>";

$vehicle_file = "vehicle.json";
if(file_put_contents($vehicle_file, get_data()))
{
  echo "file created";
}
else
{
  echo "There is an error of some sort";
}
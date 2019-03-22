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
    $query2 = "SELECT `cap_id`, `model`, `manufacturer` FROM `team`.`rates_combined_terse` WHERE `special` = 1 AND `manufacturer` = '" . $row['manufacturer'] . "' ORDER BY `manufacturer` ASC";
    $result2 = mysqli_query($conn, $query2);
    while ($row2 = mysqli_fetch_array($result2)) {
      array_push($marque_data, array(
        'id' => $row2["cap_id"],
        'name' => $row2["model"],
        'parent_id' => $row["id"]
      ));
      $query3 = "SELECT t2.cap_id, t2.bodystyle
      FROM (
        SELECT cap_id FROM team.rates_combined_terse WHERE special = 1 AND `manufacturer` = '" . $row['manufacturer'] . "'
      ) as t1 INNER JOIN team.vehicles AS t2 ON t1.cap_id = t2.cap_id
      GROUP BY t2.cap_id ORDER BY t2.manufacturer ASC";
      $result3 = mysqli_query($conn, $query3);
      while ($row3 = mysqli_fetch_array($result3)) {
        echo $row['id'] . "<br />";
        array_push($marque_data, array(
          'id' => $row3["cap_id"] . "-2",
          'name' => $row3["bodystyle"],
          'parent_id' => $row2["cap_id"]
        ));
      }
    }
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
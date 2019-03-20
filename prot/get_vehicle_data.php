<?php
date_default_timezone_set('CET');
require_once "/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php";
require_once MR_PATH . "/inc/conn.php";
require_once MR_PATH . "/inc/functions.php";

function get_data()
{
  $query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`rates_combined_terse` WHERE `special` = 1 ORDER BY `manufacturer` ASC";
  $result = mysqli_query($conn, $query);
  $marque_data = array();
  while ($row = mysqli_fetch_array($result)) {
    $marque_data[] = array(
      'manufacturer' => $row["manufacturer"]
    );
  
    return json_encode($marque_data);
  }
}

echo "<pre>";
print_r(get_data());
echo "</pre>";
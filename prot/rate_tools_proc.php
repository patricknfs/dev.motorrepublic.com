<?php
// best rates_main.php

date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
echo "test";
if ($result = $mysqli->query("SELECT * FROM rates_arval WHERE `cap_id` = 71163 LIMIT 1")) {
  printf("Select returned %d rows.\n", $result->num_rows);

  /* free result set */
  $result->close();
}
?>
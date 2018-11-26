<?php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

// second query
$choice = $_GET['choice'] ?? '';
$choice = $conn->real_escape_string($choice);
  
$query2 = "SELECT DISTINCT(`model`) FROM `team`.`vehicles` WHERE `model` = " . $choice . " ORDER BY `model` ASC";
$result2 = mysqli_query($conn, $query2);
  
while ($row = mysqli_fetch_array($result2)) {
    echo "<option>" . $row{'model'} . "</option>";
}
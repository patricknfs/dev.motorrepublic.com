<?php
// manufacturer.php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);
print_r($result);
?>
<ul>
<?php
while ($row = mysqli_fetch_assoc($result)) {
  echo "<li>" . $row['manufacturer'] . "</li>";
}
?>
</ul>
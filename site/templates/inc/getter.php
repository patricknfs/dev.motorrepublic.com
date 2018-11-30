<?php
$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

// second query
if ($_GET['choice']) {
  $choice = $conn->real_escape_string($_GET['choice']);
    
  $query2 = "SELECT DISTINCT(`model`) FROM `team`.`vehicles` WHERE `manufacturer` = " . $choice . " ORDER BY `model` ASC";
  $result2 = mysqli_query($conn, $query2);
    
  while ($row = mysqli_fetch_array($result2)) {
      echo "<option>" . $row{'model'} . "</option>";
  }
}
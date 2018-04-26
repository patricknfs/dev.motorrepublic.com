<?php
// require_once($config->paths->root . 'inc/conn.php');
$conn = new mysqli("localhost", "teamplayer", "F0k0Dm%Hd^vAukib", "team");

$conn->set_charset("utf8");

if ($conn->connect_errno) {
  printf("Connection failed: %s\n", $conn->connect_error);
  exit();
}
$data = $_POST['file'];

$handle = fopen($data, "r");
$test = file_get_contents($data);
if ($handle) {
  $counter = 0;
  //instead of executing query one by one,
  //let us prepare 1 SQL query that will insert all values from the batch
  // $sql = "INSERT INTO vehicles(cap_code,manufacturer,model,description,p11d_value,co2,fuel,model_year,basic_list_price) VALUES ";
  $sql = "INSERT INTO vehicles(manufacturer,model,description,cap_code,cap_id,p11d_value,fuel,co2,mpg,ncap,euro,ins_grp) VALUES ";
  // echo $sql;
  while (($line = fgets($handle)) !== false) {
    $sql .= "($line),";
    $counter++;
  }
  $sql = substr($sql, 0, strlen($sql) - 1);
  echo $sql;
  if (($result = $conn->query($sql)) !== FALSE)
  {
      echo "query success";
  }
  else
  {
      echo "query failure";
      echo "Error: " . $sql . "<br>" . $conn->error;
  }
  fclose($handle);
}
else {
  
}
//unlink CSV file once already imported to DB to clear directory
unlink($data);
?>
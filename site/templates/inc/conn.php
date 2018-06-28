<?php
require_once(MR_PATH . '/site/templates/inc/config.php');

$conn = new mysqli("localhost", MR_DB_USERNAME, MR_DB_PASSWORD);

$conn->set_charset("utf8");

// var_dump($conn2);

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
?>
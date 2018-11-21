<?php
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';

$conn = new mysqli("localhost", MR_DB_USERNAME, MR_DB_PASSWORD);

$conn->set_charset("utf8");

if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}
?>
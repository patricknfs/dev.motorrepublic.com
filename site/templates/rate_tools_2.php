<?php
// rate_tools.php
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
// $_SESSION['analysis'] = $conn->real_escape_string($_POST["analysis"]);
// $analysis = $_SESSION['analysis'];
// // echo $analysis . "\n";
// echo $forms->embed('vehicle_power_search'); 
date_default_timezone_set('CET');
if(!isset($_SESSION)){
  session_start();
}
ob_start();
include('views/rate_tools_2_main.php');
// include('views/functions.php');
$page->main = ob_get_clean();
include("./main.php");


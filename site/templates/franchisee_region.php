<?php
// about.php
ob_start();
include('views/franchisee_region_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
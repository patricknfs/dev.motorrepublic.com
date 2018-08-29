<?php
// about.php
ob_start();
include('views/about_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
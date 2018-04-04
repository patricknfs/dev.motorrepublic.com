<!-- home.php -->
<?php
ob_start();
include('views/home_main.php');
$page->main = ob_get_clean();

include("./main.php"); 
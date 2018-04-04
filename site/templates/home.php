<!-- home.php -->
<?php
ob_start();
include('views/main.php');
$page->main = ob_get_clean();

include("./main.php"); 
<?php
// whatwedo.php
ob_start();
include('views/whatwedo_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
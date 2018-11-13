<?php
// whatwedo.php
ob_start();
include('views/basic-page_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
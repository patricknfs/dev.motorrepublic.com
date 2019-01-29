<?php
// whatwedo.php
$image = $page->images->first();
ob_start();
include('views/whatwedo_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
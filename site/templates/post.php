<?php 
// works post template
ob_start();
include('views/post_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
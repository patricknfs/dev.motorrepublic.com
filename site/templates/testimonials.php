<?php
// testimonials.php
ob_start();
include('views/testimonials_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
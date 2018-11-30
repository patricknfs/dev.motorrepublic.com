<?php
// testimonial.php
ob_start();
include('views/testimonial_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
<?php
// franchisee_region.php
include "inc/functions.php";
$testimonial = $pages->get("template=testimonial, sort=random, limit=1");
$testimonial_blurb = truncateText($testimonial->body);

ob_start();
include('views/franchisee_region_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
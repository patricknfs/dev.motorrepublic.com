<?php 
// Simple List template
include("inc/functions.php"); 
$menu = treeMenu($page, 3, "simple_list");
ob_start();
include('views/simple_list_main.php');
$page->main = ob_get_clean();
include("./main.php"); 


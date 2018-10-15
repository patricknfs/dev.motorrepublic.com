<?php
// prize_draw.php
ob_start();
include('views/prize_draw_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
?>
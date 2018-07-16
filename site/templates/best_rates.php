<?php
// home.php
ob_start();
include('views/best_rates_main.php');
$page->main = ob_get_clean();
include("./main.php");
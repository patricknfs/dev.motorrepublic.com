<?php
// home.php
ob_start();
include('views/tools_main.php');
$page->main = ob_get_clean();
include("./main.php");
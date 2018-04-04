<!-- home.php -->
<?php
ob_start();
$page->main = ob_get_clean();
include("./main.php"); 
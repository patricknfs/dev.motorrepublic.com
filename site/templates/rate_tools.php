<?php
// rate_tools.php
date_default_timezone_set('CET');
if(!isset($_SESSION)){
  session_start();
}
ob_start();
include('views/rate_tools_main.php');
// include('views/functions.php');
$page->main = ob_get_clean();
include("./main.php");

// $_SESSION['analysis'] = $conn->real_escape_string($_POST["analysis"]);
// $analysis = $_SESSION['analysis'];
// // echo $analysis . "\n";
?>
$(document).ready(function() {
    $('#example').DataTable( {
        "processing": true,
        "serverSide": true,
        "ajax": "scripts/server_processing.php"
    } );
} );
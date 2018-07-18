<?php
// rate_tools.php
date_default_timezone_set('CET');
if(!isset($_SESSION)){
  session_start();
}
ob_start();
include('views/get_row_details.php');
// include('views/functions.php');
$page->main = ob_get_clean();
include("./main.php");

// $_SESSION['analysis'] = $conn->real_escape_string($_POST["analysis"]);
// $analysis = $_SESSION['analysis'];
// // echo $analysis . "\n";
?>
<script type="text/javascript">
  var oTable = $('#sort_table').DataTable( {
    "language": {
      "search": "_INPUT_",
      "searchPlaceholder": "Search..."
    },
    "processing": true,
    // "serverSide": true,
    "ajax": {
      "url": ".'/prot/rate_tools_proc.php",
      "data": {
        "camfilt": "<?= $camfilt; ?>",
        // "acfilt": $.cookie('acval'),
        "adpfilt": "<?= $adpfilt; ?>"
      }
    },
    "scrollY": "700px",
    "paging": false,
    "deferRender": true,
    "columns": [
      {
        "class": 'details-control',
        "data": null,
        "defaultContent": '',
        "width": "3%"
      },
      { "data": "status", "width": "6%" },
      { "data": "ad_provider" },
      { "data": "campaign", "width": "12%" },
      { "data": "adgroup", "width": "20%" },
      { "data": "clicks", "className": "dt-body-right" },
      { "data": "sales_number", "className": "dt-body-right" },
      { "data": "sale_value", "className": "dt-body-right" },
      { "data": "comm", "className": "dt-body-right" },
      { "data": "ad_cost", "className": "dt-body-right" },
      { "data": "profit", "className": "dt-body-right" },
      { "data": "profPCl", "className": "dt-body-right" },
      { "data": "commPCl", "className": "dt-body-right" },
      { "data": "costPCl", "className": "dt-body-right" },
      { "data": "commPSa", "className": "dt-body-right" },
      { "data": "avgpos", "className": "dt-body-right" },
      { "data": "qs", "className": "dt-body-center" }
    ],
  });
</script>
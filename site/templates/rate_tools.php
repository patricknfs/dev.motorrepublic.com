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
// echo $forms->embed('vehicle_power_search'); 
?>
<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Cap ID</th>
      <th>Cap Code</th>
      <th>Source</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Description</th>
      <th>Term</th>
      <th>Mileage</th>
      <th>Rental</th>
    </tr>
  </thead>
  <tbody>
										
	</tbody>
  <tfoot>
    <tr>
      <th>Cap ID</th>
      <th>Cap Code</th>
      <th>Source</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Description</th>
      <th>Term</th>
      <th>Mileage</th>
      <th>Rental</th>
    </tr>
  </tfoot>
</table>
<script type="text/javascript">
  $(document).ready(function() {
		var oTable = $('#example').DataTable( {
			"language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search..."
	    },
			// "processing": true,
      "ajax": {
      	"url": "/prot/server_processing.php",
        "type": "GET",
        "dataType": "json"
			},
      "order": [[ 8, "asc" ]],
      "scrollY": "700px",
      // "paging": false,
			// "deferRender": true,
      "serverSide": true,
      // "scroller": {
      //   "loadingIndicator": true
      // },
      // "stateSave": true,
      "scrollCollapse": true,
      "scroller": true,
		  "columns": [
        { "data": "id", "className": "dt-body-right" },
        { "data": "cap_id", "className": "dt-body-right" },
        { "data": "cap_code", "className": "dt-body-right" },
	  		{ "data": "source" },
        { "data": "manufacturer" },
        { "data": "model" },
        { "data": "descr" },
        { "data": "term"},
        { "data": "mileage" },
        { "data": "rental", "className": "dt-body-right" }
	  	]
		});	
	});
</script>
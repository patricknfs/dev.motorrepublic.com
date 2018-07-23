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
<p>form-builder/vehicle_power_search</p>
<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Source</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Description</th>
      <th>Cap ID</th>
      <th>Cap Code</th>
      <th>Rental</th>
    </tr>
  </thead>
  <tbody>
										
	</tbody>
  <tfoot>
    <tr>
      <th>Source</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Description</th>
      <th>Cap ID</th>
      <th>Cap Code</th>
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
			"processing": true,
      "ajax": {
      	"url": "/prot/get_row_details.php",
        "dataType": "json",
        "dataSrc": ""
			},
      "order": [[ 6, "asc" ]],
      "scrollY": "700px",
      "paging": false,
			"deferRender": true,
		  "columns": [
	  		{ "data": "source" },
        { "data": "manufacturer" },
        { "data": "model" },
        { "data": "descr" },
        { "data": "cap_id", "className": "dt-body-right" },
        { "data": "cap_code", "className": "dt-body-right" },
        { "data": "rental", "className": "dt-body-right" },
	  	]
		});	
	});
</script>
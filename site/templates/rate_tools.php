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
<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Source</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Description</th>
      <th>Cap ID</th>
      <th>Rental</th>
    </tr>
  </thead>
  <tfoot>
    <tr>
      <th>Source</th>
      <th>Manufacturer</th>
      <th>Model</th>
      <th>Description</th>
      <th>Cap ID</th>
      <th>Rental</th>
    </tr>
  </tfoot>
</table>
<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
      // "processing": true,
      // "serverSide": true,
      "dataType": "json",
      "url": "/prot/get_row_details.php"
    } );
  } );
  $(document).ready(function() {
		var oTable = $('#example').DataTable( {
			"language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search..."
	    },
			"processing": true,
      "ajax": {
      	"url": "/prot/get_row_details.php"
			},
      "scrollY": "700px",
      "paging": false,
			"deferRender": true,
		  "columns": [
	  		{ "data": "source" },
        { "data": "manufacturer" },
        { "data": "model" },
        { "data": "description" },
        { "data": "cap_id", "className": "dt-body-right" },
        { "data": "rental", "className": "dt-body-right" },
	  	],
	  	"columnDefs": [
        {
          // The `data` parameter refers to the data for the cell (defined by the
          // `data` option, which defaults to the column being worked with, in
          // this case `data: 0`.
          // "render": function ( data, type, row ) {
          //     return '<a href="actual.php?analysis=overall&since=<?= $since; ?>&level=adg&camfilt=' + data + '&adpfilt=' + row.ad_provider + '">' + data + '</a>';
          // },
          "targets": 2
        },
        { "visible": false,  "targets": [ 1 ] }
      ]
		});	
	});
</script>
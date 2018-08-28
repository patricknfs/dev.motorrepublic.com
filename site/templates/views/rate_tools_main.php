<?php
// rate_tools_main.php
?>
<table id="example" class="display" style="width:100%">
  <thead>
    <tr>
      <th>Source</th>
      <th>Cap ID</th>
      <th>Cap Code</th>
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
      <th>Source</th>
      <th>Cap ID</th>
      <th>Cap Code</th>
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
  /* Formatting function for row details - modify as you need */
  function format ( d ) {
    // `d` is the original data object for the row
    return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
        '<tr>'+
            '<td>Full name:</td>'+
            '<td>'+d.co2+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extension number:</td>'+
            '<td>'+d.p11d+'</td>'+
        '</tr>'+
        '<tr>'+
            '<td>Extra info:</td>'+
            '<td>And any further details here (images etc)...</td>'+
        '</tr>'+
    '</table>';
  };
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
      "columns": [
        {
          "className":      'details-control',
          "orderable":      false,
          "data":           null,
          "defaultContent": ''
        },
        { "data": "source" },
        { "data": "cap_id" },
        { "data": "cap_code" },
        { "data": "manufacturer" },
        { "data": "model" },
        { "data": "descr" },
        { "data": "term" },
        { "data": "mileage" },
        { "data": "rental" }
      ],
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
      "select": true
		});
    // Add event listener for opening and closing details
    $('#example tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = table.row( tr );

      if ( row.child.isShown() ) {
          // This row is already open - close it
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
          // Open this row
          row.child( format(row.data()) ).show();
          tr.addClass('shown');
      }
    });
	});
</script>
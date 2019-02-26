<?php
// rate_tools_main.php
?>
<table id="mr_rates" class="display" style="width:100%">
  <thead>
    <tr>
      <th></th>
      <th>Source</th>
      <th>Updated</th>
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
      <th></th>
      <th>Source</th>
      <th>Updated</th>
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
  // function format ( d ) {
  //   // `d` is the original data object for the row
  //   return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
  //       '<tr>'+
  //           '<td width="30%"><strong>CO2:</strong></td>'+
  //           '<td width="30%">'+d.CO2+'</td>'+
  //           '<td><strong>P11d:</strong></td>'+
  //           '<td><p>'+d.p11d_price+'</p></td>'+
  //           '<td rowspan="2"><p>'+d.deal_notes+'</p></td>'+
  //       '</tr>'+
  //       '<tr>'+
  //           '<td width="30%"><p><strong>List Price:</strong></p></td>'+
  //           '<td width="30%"><p>'+d.vehicle_list_price+'</p></td>'+
  //           '<td><p><strong>Funder OTR Price (Not to be used with other funders):</strong></p></td>'+
  //           '<td><p>'+d.vehicle_otr_price+'</p></td>'+
  //       '</tr>'+
  //   '</table>';
  // };
  $(document).ready(function() {
		var table = $('#mr_rates').DataTable( {
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
        {"data": "id"},
        {
          "className":      'details-control',
          "orderable":      false,
          "data":           null,
          "defaultContent": ''
        },
        { "data": "src" },
        { "data": "updated" },
        { "data": "cap_id" },
        { "data": "cap_code" },
        { "data": "manufacturer" },
        { "data": "model" },
        { "data": "descr" },
        { "data": "term" },
        { "data": "mileage" },
        { "data": "rental" }
      ],
      "order": [[ 10, "asc" ]],
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
    $('#mr_rates tbody').on('click', 'td.details-control', function () {
      var tr = $(this).closest('tr');
      var row = table.row( tr );
  
      if ( row.child.isShown() ) {
          row.child.hide();
          tr.removeClass('shown');
      }
      else {
          row.child( format(row.data()) ).show();
          tr.addClass('shown');
      }
    });

    function format ( rowData ) {
      var div = $('<div/>')
          .addClass( 'loading' );
          .text( 'Loading...' );
  
      $.ajax( {
        url: '/prot/server_processing_sub.php',
        data: {
          "tid":rowData.id
		    },
        dataType: 'json',

        success: function ( json ) {
          console.log(json);
          var childTable = '<table><thead><tr><td>TIME</td><td>DESC</td></tr></thead><tbody>';

          // for(var i=0;i<json.length;i++){
            childTable = childTable.concat('<tr><td>' + rowData.vehicle_list_price + '</td><td>' + rowData.vehicle_otr_price + '</td></tr>');
          // }
          
          childTable = childTable.concat('<tr><td>AA</td><td>BB</td></tr></tbody></table>');

          div
          .html( childTable )
          .removeClass( 'loading' );
        }
      } );
  
      return div;
    }
	});
</script>
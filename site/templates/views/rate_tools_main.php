<?php
// rate_tools_main.php
?>
<table id="mr_rates" class="display" style="width:100%">
  <thead>
    <tr>
      <th>id</td>
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
      <th>id</td>
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
        { "data": "id"},
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
          .addClass( 'loading' )
          .text( 'Loading...' );
  
      $.ajax( {
        url: '/prot/server_processing_sub.php',
        data: {
          "tid":rowData.id
		    },
        dataType: 'json',

        success: function ( json ) {
          // console.log(json);
          var childTable = '<table width="100%"><thead><tr><td>List Price</td><td>OTR Price</td><td>P11D</td><td>CO2</td><td>Deal Notes</td></tr></thead><tbody>';

          for(var i=0;i<json.length;i++){
            childTable = childTable.concat('<tr><td>' + json[i].vehicle_list_price + '</td><td>' + json[i].vehicle_otr_price + '</td><td>' + json[i].p11d_price + '</td><td>' + json[i].CO2 + '</td><td>' + json[i].deal_notes + '</td></tr>');
          }
          
          childTable = childTable.concat('</tbody></table>');

          div
          .html( childTable )
          .removeClass( 'loading' );
        }
      } );
      return div;
    }
	});
</script>
<?php
// actual.php
date_default_timezone_set('CET');
session_start();
// echo session_id();
// print_r($_GET);


require_once $_SERVER['DOCUMENT_ROOT'] . '/inc/config.php';
require_once(PPW_PATH . "/inc/conn2.php");
require_once(PPW_PATH . "/inc/functions.php");

$_SESSION['analysis'] = inputGet('analysis');
$analysis = $_SESSION['analysis'];
// echo $analysis . "\n";
$_SESSION['since'] = inputGet('since');
$since = $_SESSION['since'];
// echo $since . "\n";
$_SESSION['level'] = inputGet('level');

$level = $_SESSION['level'];
// echo $level . "\n";
$_SESSION['ac'] = inputGet('acfilt');
$ac = $_SESSION['ac'];
// echo $ac . "\n";
if(!empty($ac)) {
	if($level == "kw"){
		$atargets = 5;	
	}
	elseif($level == "adg"){
		$atargets = 5;	
	}
	else{
		$atargets = 3;	
	}
}
else {
	if($level == "kw"){
		$atargets = 4;	
	}
	elseif($level == "adg"){
		$atargets = 4;	
	}
	else{
		$atargets = 2;	
	}
}

// print_r($_SESSION);

$camfilt = inputGet('camfilt');
$adgfilt = inputGet('adgfilt');
$adpfilt = inputGet('adpfilt');

// ob_start();
$actualscripts = "set";
include('./views/actual_main.php');
$page->main = ob_get_clean();
include("./main.php"); 

if($level == "adg") {
	?>
	<script type="text/javascript">

		// 2017 Function for row details
		function format ( d ) {
	    $.ajax({                                      
		    url: "data/actual_stats_proc.php",       
		    data: {
		    	"adp":d.ad_provider,
		    	"adg":d.adgroup,
					"cam":d.campaign
		    },
		    dataType: "json",
		    success: function(data){
				  $.each(data, function(i, item) {
					  if (typeof item.comms !== "undefined"){
				    	var tab = document.getElementById("records_table");
				    	var row = tab.insertRow(1);
				    	var cell1 = row.insertCell(0);
							var cell2 = row.insertCell(1);
							cell1.innerHTML = item.xml_date;
							cell2.innerHTML = item.comms;
					  }
				  })
					$.ajax({                                      
				    url: "data/get_adg_row_changes.php",       
				    data: {
				    	"adp":d.ad_provider,
				    	"adg":d.adgroup,
							"cam":d.campaign
				    },
				    dataType: "json",
				    success: function(data){
						  $.each(data, function(i, item) {
							  // if (typeof item.changes !== "undefined"){
						    	var tab3 = document.getElementById("changes_table");
						    	var row = tab3.insertRow(1);
						    	var cell31 = row.insertCell(0);
						    	// cell31.style.width = '15%';
									var cell32 = row.insertCell(1);
									cell31.innerHTML = item.xml_date;
									cell32.innerHTML = item.changes;
							  // }
						  }),
						  $.ajax({                                      
								"url": "data/get_notes.php",
								"data": { 
									"adp": d.ad_provider,
									"adg": d.adgroup,
									"cam": d.campaign
								},
								dataType: "json",
								success: function(data){
									$.each(data, function(i, item) { 
										// if (typeof item.notes !== "undefined"){ 
											var tab2 = document.getElementById("notes_table");
								    	var row2 = tab2.insertRow(2);
								    	var cell21 = row2.insertCell(0);
											var cell22 = row2.insertCell(1);
											cell21.innerHTML = item.notes_date;
											cell22.innerHTML = item.notes;
										// }
									});
								},
								error: function(xhr, status, error) { console.log(status); console.log(error); },
							});
						},
						error: function(xhr, status, error) { console.log(status); console.log(error); },
					});
				},
				error: function(xhr, status, error) { console.log(status); console.log(error); },
			});
				                 		          									
	    return '<div class="slider">'+
	      '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
	        '<tr>'+
	          '<td style="vertical-align: top;" width="15%">'+
	          	'<table id="records_table"><tr><th>date</th><th>comm</th></tr>'+

							'</table>'+
						'</td>'+
						'<td style="vertical-align: top;" width="55%">'+
	          	'<table id="changes_table"><tr><th width="15%">date</th><th width="85%">changes</th></tr>'+

							'</table>'+
						'</td>'+
						'<td style="vertical-align: top;" width="30%">'+ 
							'<table id="notes_table">'+
								'<tr>'+
									'<td width="100%" colspan="2" style="padding: 0; text-align: left;">'+
										'<div id="notes_form">'+
											'<form id="notes" name="notes" action=""><fieldset>'+
												'<input type="hidden" id="adp" name="adp" value="' + d.ad_provider + '" />'+
												'<input type="hidden" id="camp" name="camp" value="' + d.campaign + '" />'+
												'<input type="hidden" id="adg" name="adg" value="' + d.adgroup + '" />'+
												'<label for="entry_date">Entry Date</label><input type="text" id="entry_date" name="entry_date" />'+
												'<label for="noted">Notes</label><textarea cols="30" rows="8" id="noted" name="noted"></textarea>'+
												'<span><input type="submit" value="submit" name="submit" class="submit_notes" />'+
											'</form>'+
										'</div>'+
									'</td>'+
								'</tr>'+						
								'<tr><th width="20%">date</th><th width="80%">notes</th></tr>'+

			 				'</table>'+
			 			'</td>'+
					'</tr>'+
				'</table>'+
	    '</div>';
		}

		$(document).ready(function() {
			
			$(document).on("submit", "#notes", function(event){
				event.preventDefault();
				
				var account = $("input#account").val();
				var adp = $("input#adp").val();
				var camp = $("input#camp").val();
				var adg = $("input#adg").val();
				var entry_date = $("input#entry_date").val();
				var noted = $("textarea#noted").val();
				
				var dataString = 'account='+ account + '&adp=' + adp + '&camp=' + camp + '&adg=' + adg + '&entry_date=' + entry_date + '&noted=' + noted; 
				//console.log(dataString); 
				
				$.ajax({  
				  type: "POST",  
				  url: "data/enter_notes.php",  
				  data: dataString,  
				  success: function() {  
				    $('#notes').html("<div style='width: 100%;' id='message'></div>");  
				    $('#message').html("<h2 style='font-size: 16px; margin-left: 100px;'>New Note Submitted</h2>")   
				    .hide()  
				    .fadeIn(1500, function() {  
				      $('#message').append("<img style='margin-left: 154px;' id='checkmark' src='../img/icons/icon_notification_success.png' />");  
				    });  
				  }   
				});
				return false;  
			}); 
			
			var oTable = $('#sort_table').DataTable( {
				"language": {
	        "search": "_INPUT_",
	        "searchPlaceholder": "Search..."
		    },
				"processing": true,
				// "serverSide": true,
	      "ajax": {
	      	"url": "data/actual_stats_proc.php",
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
			  "columnDefs": [
          {
            // The `data` parameter refers to the data for the cell (defined by the
            // `data` option, which defaults to the column being worked with, in
            // this case `data: 0`.
            "render": function ( data, type, row ) {
                return '<a href="actual.php?analysis=overall&since=<?= $since; ?>&level=kw&adgfilt=' + data + '&adpfilt=' + row.ad_provider + '">' + data + '</a>';
	            },
	            "targets": [ 4 ]
	        },
	        { "visible": false,  "targets": [ 1 ] }
	      ]
			});

			// Add event listener for opening and closing details
	    $('#sort_table tbody').on('click', 'td.details-control', function () {
	      var tr = $(this).closest('tr');
	      var row = oTable.row( tr );

	      if ( row.child.isShown() ) {
	          // This row is already open - close it
	          $('div.slider', row.child()).slideUp( function () {
	              row.child.hide();
	              tr.removeClass('shown');
	          } );
	      }
	      else {
	          // Open this row
	          row.child( format(row.data()), 'no-padding' ).show();
	          tr.addClass('shown');

	          $('div.slider', row.child()).slideDown();
	      }
	    });
		});
	</script>
	<?php
}
elseif($level == "kw") {
?>
<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#sort_table').DataTable( {
			"language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search..."
	    },
			"processing": true,
			// "serverSide": true,
      "ajax": {
    		"data": {
      		"adgfilt": "<?= $adgfilt; ?>",
      		// "acfilt": $.cookie('acval'),
      		"adpfilt": "<?= $adpfilt; ?>"
      	},
        "url": "data/actual_stats_proc.php",
      },
      "scrollY": "700px",
    	"paging": false,
			"deferRender": true,
			"columns": [
	  		{ "data": "status", "title": "S", "width": "3%" },
        { "data": "ad_provider" },
        { "data": "campaign", "width": "9%"  },
        { "data": "adgroup", "width": "20%" },
        { "data": "keyword", "width": "13%" },
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
	  	"columnDefs":[
	  		{
          "render": function ( data, type, row ) {
          	if(data === "enabled"){
              return '<div class="checkmark"></div>';
          	}
          	else {
          		return '';
          	}
          },
          "targets": 0
        },
	  	]
		});	
	});
</script>
<?php
}		
else{
?>
<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#sort_table').DataTable( {
			"language": {
        "search": "_INPUT_",
        "searchPlaceholder": "Search..."
	    },
			"processing": true,
      "ajax": {
      	"url": "data/actual_stats_proc.php"
			},
      "scrollY": "700px",
      "paging": false,
			"deferRender": true,
		  "columns": [
	  		{ "data": "status" },
        { "data": "ad_provider" },
        { "data": "campaign" },
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
	  	"columnDefs": [
        {
          // The `data` parameter refers to the data for the cell (defined by the
          // `data` option, which defaults to the column being worked with, in
          // this case `data: 0`.
          "render": function ( data, type, row ) {
              return '<a href="actual.php?analysis=overall&since=<?= $since; ?>&level=adg&camfilt=' + data + '&adpfilt=' + row.ad_provider + '">' + data + '</a>';
          },
          "targets": 2
        },
        { "visible": false,  "targets": [ 1 ] }
      ]
		});	
	});
</script>
<?php
}
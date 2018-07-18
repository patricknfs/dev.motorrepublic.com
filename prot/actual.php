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
<script type="text/javascript">
	$(document).ready(function() {
		var oTable = $('#example').DataTable( {
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
			"order": [[ 5, "desc" ]],
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
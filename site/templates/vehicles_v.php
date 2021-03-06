<?php
// vehicles.php

// $products = $pages->find("$selector, limit=12, sort=sequence, sort=colour");

// $pagination = $products->renderPager(array(
//   'nextItemLabel' => "Next",
//   'previousItemLabel' => "Prev",
//   'listMarkup' => "<ul class='MarkupPagerNav pagination text-center'role='navigation' aria-label='Pagination'>{out}</ul>",
//   'currentItemClass' => "current",
//   'itemMarkup' => "<li class='{class}'>{out}</li>",
//   'linkMarkup' => "<a href='{url}'><span>{out}</span></a>"  
// ));
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");

include "power_search.php";

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 21;
$offset = ($pageno-1) * $no_of_records_per_page;
// echo "Marque is: "  . $page->marque->title;
if ($page->marque->title != ''){
  $manuf = strtoupper($page->marque->title);
}
else {
  $manuf = $sanitizer->text($input->get->slct1);
}

// echo "Manuf is: " . $manuf;
$mdllcv = $sanitizer->text($input->get->slct2);
$lcv = "";
$mdl = "";
if(!empty($mdllcv)){
  $mdllcv = explode("-", $mdllcv);
  $mdl = $mdllcv[0];
  if($manuf){
    $lcv = $mdllcv[1];
  }
}

if($page->id == 1023) {
  $lcv2 = 1;
}
else{
  $lcv2 = 0;
}
// echo "lcv2 is: " . $lcv2;
// echo $mdl;

if( !empty($manuf) ) {
  $total_pages_sql = $conn->query("SELECT COUNT(*) FROM `team`.`rates_combined_terse` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $mdl . "%'  AND `lcv` = '" . $lcv . "' AND `special` = 1");
  // echo "SELECT COUNT(*) FROM `team`.`rates_combined_terse` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $mdl . "%'  AND `lcv` = '" . $lcv . "' AND `special` = 1";
  $total_rows = $total_pages_sql->fetch_row();
  // print_r($total_rows);
  // echo "total rows: " . $total_rows[0];
  $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
  // echo "total_pages: " . $total_pages;
  $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv`, `special`, `biz_only` FROM `team`.`rates_combined_terse` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $mdl . "%' AND `lcv` = '" . $lcv . "' AND `special` = 1 GROUP BY `cap_id` ORDER BY `special` DESC, `rental` ASC LIMIT $offset, $no_of_records_per_page";
}
else {
  $total_pages_sql = $conn->query("SELECT COUNT(*) FROM `team`.`rates_combined_terse` WHERE `lcv` = '" . $lcv2 . "' AND `special` = 1");
  $total_rows = $total_pages_sql->fetch_row();
  // print_r($total_rows);
  // echo "total rows: " . $total_rows[0];
  $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
  // echo "total_pages: " . $total_pages;
  $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv`, `special`, `biz_only` FROM `team`.`rates_combined_terse` WHERE `lcv` = '" . $lcv2 . "' AND `special` = 1 GROUP BY `cap_id` ORDER BY `special` DESC, `rental` ASC LIMIT $offset, $no_of_records_per_page";
}

// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

// unset($manuf);
// unset($mdl);
ob_start();
include('views/vehicles_main.php');
$page->main = ob_get_clean();
include("./main.php");
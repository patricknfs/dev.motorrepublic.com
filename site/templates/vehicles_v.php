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
$no_of_records_per_page = 12;
$offset = ($pageno-1) * $no_of_records_per_page;
$manuf = $sanitizer->text($input->post->slct1);
// echo $manuf;
$mdl = $sanitizer->text($input->post->slct2);
// echo $mdl;

if( !empty($manuf) ) {
  $total_pages_sql = "SELECT COUNT(*) FROM `team`.`rates_combined_terse` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $mdl . "%' AND `special` = 1 AND `lcv` = 1 GROUP BY `cap_id` ";
  $countres = $conn->query($total_pages_sql);
  $total_rows = $countres->num_rows;
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  // $manuf = filter_var($_POST['manufacturer'], FILTER_SANITIZE_STRING);
  // $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
  $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`lcv` FROM `team`.`rates_combined_terse` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $mdl . "%' AND `special` = 1 AND `lcv` = 1 GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT $offset, $no_of_records_per_page";
  // echo "if manu: " .  $query;
}
else {
  $total_pages_sql = "SELECT COUNT(*) FROM `team`.`rates_combined_terse` GROUP BY `cap_id` ";
  $countres = $conn->query($total_pages_sql);
  $total_rows = $countres->num_rows;
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv` FROM `team`.`rates_combined_terse` WHERE `special` = 1 AND `lcv` = 1 GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT $offset, $no_of_records_per_page";
  // echo "else " . $query;
}

// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

unset($manuf);
unset($mdl);
ob_start();
include('views/vehicles__v_main.php');
$page->main = ob_get_clean();
include("./main.php");
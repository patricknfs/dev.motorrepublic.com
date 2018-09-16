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

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 12;
$offset = ($pageno-1) * $no_of_records_per_page;

if( isset($_POST['manufacturer']) ) {
  $total_pages_sql = "SELECT COUNT(*) FROM `team`.`rates_combined` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $model . "%' AND `term` = '" . $months . "' AND `mileage` = '" . $mileage . "'  GROUP BY `cap_id` ";
  $countres = $conn->query($total_pages_sql);
  $total_rows = $countres->num_rows;
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  $manuf = filter_var($_POST['manufacturer'], FILTER_SANITIZE_STRING);
  $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
  $mileage = filter_var($_POST['mileage'], FILTER_SANITIZE_STRING);
  $months = filter_var($_POST['months'], FILTER_SANITIZE_STRING);
  $query = "SELECT `id`,`cap_id`,`cap_code`,`source`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`deal_notes` FROM `team`.`rates_combined` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $model . "%' AND `term` = '" . $months . "' AND `mileage` = '" . $mileage . "'  GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT $offset, $no_of_records_per_page";
}
else {
  $total_pages_sql = "SELECT COUNT(*) FROM `team`.`rates_combined` GROUP BY `cap_id` ";
  $countres = $conn->query($total_pages_sql);
  $total_rows = $countres->num_rows;
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  $query = "SELECT `id`,`cap_id`,`cap_code`,`source`,`manufacturer`,`model`,`descr`,`term`,`mileage`,min(`rental`) AS `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`,`deal_notes` FROM `team`.`rates_combined` GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT $offset, $no_of_records_per_page";
}

echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

ob_start();
include('views/vehicles_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
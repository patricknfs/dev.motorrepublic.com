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
// print_r($_POST);
if( isset($_POST['manufacturer']) ) {
  $manuf = filter_var($_POST['manufacturer'], FILTER_SANITIZE_STRING);
  $model = filter_var($_POST['model'], FILTER_SANITIZE_STRING);
  $mileage = filter_var($_POST['mileage'], FILTER_SANITIZE_STRING);
  $months = filter_var($_POST['months'], FILTER_SANITIZE_STRING);
  $query = "SELECT *, min(rental) FROM `team`.`rates_combined` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $model . "%' AND `term` = '" . $months . "' AND `mileage` = '" . $mileage . "'  GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT 12";
}
else {
  $query = "SELECT *, min(rental) FROM `team`.`rates_combined` WHERE `term` = '24M' AND `mileage` = '8K'  GROUP BY `cap_id` ORDER BY `rental` ASC LIMIT 12";
}

echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

ob_start();
include('views/vehicles_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
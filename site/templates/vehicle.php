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
if( isset($input->urlSegment1)) {
  $query = "SELECT *, min(rental) FROM `team`.`rates_combined` WHERE `cap_id` = " . $input->urlSegment1 . " LIMIT 12";
}
else {
  echo "<p>Vehicle not available. Please contact the team</p>";
}

// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

ob_start();
include('views/vehicle_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
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
if(isset($input->urlSegment1)) {
  $query = "SELECT *, min(rental) FROM `team`.`rates_combined` WHERE `cap_id` = " . $input->urlSegment1 . " ORDER BY `rental` ASC LIMIT 1";
}
else {
  echo "<p>Vehicle not available. Please contact the team</p>";
}

// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));
$data = $result->fetch_assoc();

$bch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+2)), 2, '.', ',');
$pch_rental = number_format(((($data['rental'] * $data['term']) + 300) / ($data['term']+2)*1.2), 2, '.', ',');
$bch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+2))*3), 2, '.', ',');
$pch_initial = number_format((((($data['rental'] * $data['term']) + 300) / ($data['term']+2)*1.2)*3), 2, '.', ',');

$hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));

ob_start();
include('views/vehicle_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
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

// include "power_search_2.php";

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
  if($input->get->marque)
  {
    $manufs = $sanitizer->text($input->get->marque);
    $query_man = "SELECT `name` FROM team.vehicle_json WHERE `json_id` = '" . $manufs . "' LIMIT 1";
    // echo $query_man;
    if ($result = $conn->query($query_man)) 
    {
      while ($row = $result->fetch_assoc()) 
      {
          $manuf = $row["name"];
          // echo "manuf is: " . $manuf;
      }
      $result->free();
    }
  }
  else
  {
    $manuf = $sanitizer->text($input->get->manufacturer);
  }
}

// if($input->get->model)
// {
//   $mods = $sanitizer->text($input->get->model);
//   $query_mod = "SELECT `name` FROM team.vehicle_json WHERE `json_id` = '" . $mods . "' LIMIT 1";
//   echo $query_mod;
//   if ($result_mod = $conn->query($query_mod)) 
//   {
//     while ($row_mod = $result_mod->fetch_assoc()) 
//     {
//       $mod = $row_mod["name"];
//       echo "mod is: " . $mod;
//     }
//     $result_mod->free();
//   }
// }
// else
// {
//   $mod = $sanitizer->text($input->get->model);
// }

if($input->get->bodystyle)
{
  $bodystyles = $sanitizer->text($input->get->bodystyle);
  $query_bs = "SELECT `name` FROM team.vehicle_json WHERE `json_id` = '" . $bodystyles . "' AND `parent_id` = '" . $manufs . "'";
  echo $query_bs;
  if ($result_bs = $conn->query($query_bs)) 
  {
    while ($row_bs = $result_bs->fetch_assoc()) 
    {
      $bodystyle = $row_bs["name"];
      echo "bodystyle is: " . $bodystyle;
    }
    $result_bs->free();
  }
}
else
{
  $bodystyle = $sanitizer->text($input->get->bodystyle);
}

if(!empty($manuf)) {
  $total_pages_sql = $conn->query("SELECT 
  t1.*, t2.bodystyle
  FROM
    `team`.`rates_combined_terse` AS t1
  INNER JOIN
  `team`.`vehicles` AS t2
  ON t1.cap_id = t2.cap_id
  WHERE
    t1.lcv = '0'
        AND t1.special = 1 
        AND t2.bodystyle LIKE '%" . $bodystyle . "%'
  GROUP BY t1.cap_id");
  $total_rows = $total_pages_sql->fetch_row();
  $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
  // $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv`, `special`, `biz_only` FROM `team`.`rates_combined_terse` WHERE `manufacturer` = '" . $manuf . "' AND `model` LIKE '%" . $mod . "%' AND `lcv` = '0' AND `special` = 1 GROUP BY `cap_id` ORDER BY `special` DESC, `rental` ASC LIMIT $offset, $no_of_records_per_page";
  $query = "SELECT 
  t1.*, t2.bodystyle
  FROM
    `team`.`rates_combined_terse` AS t1
  INNER JOIN
  `team`.`vehicles` AS t2
  ON t1.cap_id = t2.cap_id
  WHERE
    t1.manufacturer = '" . $manuf . "'
        AND t1.model LIKE '%" . $mod . "%'
        AND t1.lcv = '0'
        AND t1.special = 1 
        AND t2.bodystyle LIKE '%" . $bodystyle . "%'
  GROUP BY t1.cap_id
  ORDER BY t1.special DESC , t1.rental ASC
  LIMIT $offset, $no_of_records_per_page";
  echo $query;
}
elseif(!empty($bodystyle)) {
  $total_pages_sql = $conn->query("SELECT COUNT(*) FROM `team`.`rates_combined_terse` WHERE `bodystyle` LIKE '%" . $bodystyle . "%'  AND `lcv` = '0' AND `special` = 1");
  $total_rows = $total_pages_sql->fetch_row();
  $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
  $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv`, `special`, `biz_only` FROM `team`.`rates_combined_terse` WHERE `model` LIKE '%" . $mod . "%' AND `lcv` = '0' AND `special` = 1 GROUP BY `cap_id` ORDER BY `special` DESC, `rental` ASC LIMIT $offset, $no_of_records_per_page";
  echo $query;
}
else {
  $total_pages_sql = $conn->query("SELECT COUNT(*) FROM `team`.`rates_combined_terse` WHERE `lcv` = '0' AND `special` = 1");
  $total_rows = $total_pages_sql->fetch_row();
  $total_pages = ceil($total_rows[0] / $no_of_records_per_page);
  $query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv`, `special`, `biz_only` FROM `team`.`rates_combined_terse` WHERE `lcv` = '0' AND `special` = 1 GROUP BY `cap_id` ORDER BY `special` DESC, `rental` ASC LIMIT $offset, $no_of_records_per_page";
  echo $query;
}
// echo $query;
$result = $conn->query($query) or die(mysqli_error($conn));

// unset($manuf);
// unset($mdl);
ob_start();
include('views/vehicles_main.php');
$page->main = ob_get_clean();
include("./main.php");
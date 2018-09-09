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
$query = "SELECT * FROM `team`.`vehicles` LIMIT 12";
// echo $query; 
// $result = $conn->query($query) or die(mysqli_error($conn));

$result = $conn->query($query);
    if (!$result)
    {
     echo "sorry no results";
    }
    else if (is_object($result))
    {
        $sqlRowCount = $result->num_rows;
    }
    else
    {
        $sqlRowCount = 0;
    }

ob_start();
include('views/vehicles_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
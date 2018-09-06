<?php
// vehicles.php
$type = $page->name;
// echo $type;

$selector = "template=fabric,collection=" . $type;
// echo $selector;
$products = $pages->find("$selector, limit=12, sort=sequence, sort=colour");

$pagination = $products->renderPager(array(
  'nextItemLabel' => "Next",
  'previousItemLabel' => "Prev",
  'listMarkup' => "<ul class='MarkupPagerNav pagination text-center'role='navigation' aria-label='Pagination'>{out}</ul>",
  'currentItemClass' => "current",
  'itemMarkup' => "<li class='{class}'>{out}</li>",
  'linkMarkup' => "<a href='{url}'><span>{out}</span></a>"  
));
ob_start();
include('views/vehicles_main.php');
$page->main = ob_get_clean();
include("./main.php"); 
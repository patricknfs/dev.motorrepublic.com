<?php
//posts.php template
include("inc/functions.php"); 
echo $page->parent->name;
switch($page->parent->name){
  case "motor-republic-ayrshire":
  $region = "ayrshire";
  break;
  case "motor-republic-bristol":
  $region = "bristol";
  break;
  case "motor-republic-cardiff":
  $region = "cardiff";
  break;
  case "motor-republic-canary-wharf":
  $region = "canary-wharf";
  break;
  case "motor-republic-gravesend":
  $region = "gravesend";
  break;
  case "motor-republic-maidstone":
  $region = "maidstone";
  break;
  case "motor-republic-norwich":
  $region = "norwich";
  break;
  case "motor-republic-portsmouth-iow":
  $region = "portsmouth-iow";
  break;
  case "motor-republic-reading":
  $region = "reading";
  break;
  case "motor-republic-sheffield-north":
  $region = "sheffield-north";
  break;
  default: 
  $region = "No are defined";
}
$articles = $pages->get("/regions/' . $region . '/blog/, limit=10, sort=-date")->children;
wire()->addHook("Page::wordLimiter", null, "wordLimiter");
ob_start();
include('views/posts_main.php');
$page->main = ob_get_clean();
include("./main.php");
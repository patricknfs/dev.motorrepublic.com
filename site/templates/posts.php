<?php
//posts.php template
include("inc/functions.php"); 
echo $page->parent->name;
switch($page->parent->name){
  case "motor-republic-cardiff":
  $region = "cardiff";
  break;
  case "motor-republic-bristol":
  $region = "cardiff";
  break;
}
$articles = $pages->get("/regions/' . $region . '/blog/, limit=10, sort=-date")->children;
wire()->addHook("Page::wordLimiter", null, "wordLimiter");
ob_start();
include('views/posts_main.php');
$page->main = ob_get_clean();
include("./main.php");
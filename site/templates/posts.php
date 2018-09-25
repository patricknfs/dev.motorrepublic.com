<?php
//posts.php template
include("inc/functions.php"); 
$articles = $pages->get("/blog/, limit=10, sort=-date")->children;
print_r($articles);
wire()->addHook("Page::wordLimiter", null, "wordLimiter");
ob_start();
include('views/posts_main.php');
$page->main = ob_get_clean();
include("./main.php");
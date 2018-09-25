<?php
//posts.php template
include("inc/functions.php"); 
$articles = $pages->get("/regions/gravesend/blog/, limit=10, sort=-date")->children;
wire()->addHook("Page::wordLimiter", null, "wordLimiter");
ob_start();
include('views/posts_main.php');
$page->main = ob_get_clean();
include("./main.php");
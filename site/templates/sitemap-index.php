<?php
	namespace ProcessWire;

	$out =  
	    '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
	    '<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	
	$templates = "about|basic-page|franchisee-region|vehicle|vehicles|vehicle_v|post|posts|testimonila|testimonials|whatwedo";
	$key = $pages->count("template=$templates");
	$limit = 2000;

	$pageNum = ceil($key/ $limit);
	$post = $pages->get("template=sitemap-xml");

	$i = 1;

	while($pageNum >= $i){
	  $out .= "\n<sitemap>\n\t<loc>" . $post->httpUrl . "page$i/</loc>\n\t<lastmod>" . date("Y-m-d", $post->modified) . "</lastmod>\n</sitemap>";
	  $i = $i + 1;
	}

	$out .= "\n</sitemapindex>";

	header("Content-Type: text/xml");

	echo $out;
?>
<?php
	namespace ProcessWire;

	$out =  
	    '<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
	    '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	$pageArray = $pages->find("template=basic-page|blog-post|tag, limit=200");

	foreach ($pageArray as $post) {
	  $out .= "\n<url>" .
	    "\n\t<loc>" . $post->httpUrl . "</loc>" .
	    "\n\t<lastmod>" . date("Y-m-d", $post->modified) . "</lastmod>" .
	    "\n</url>";
	}

	$out .= "\n</urlset>";

	header("Content-Type: text/xml");

	echo $out;
?>
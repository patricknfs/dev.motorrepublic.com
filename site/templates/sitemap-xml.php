<?php
	namespace ProcessWire;
	$pageArray = $pages->find("template=about|basic-page|franchisee-region|vehicle|vehicles|vehicle_v|post|posts|testimonial|testimonials|whatwedo, limit=200");
	print_r($pageArray);
	// $out =  '<?xml version="1.0" encoding="UTF-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';


	// foreach ($pageArray as $post) {
	//   $out .= "\n<url>\n\t<loc>" . $post->httpUrl . "</loc>\n\t<lastmod>" . date("Y-m-d", $post->modified) . "</lastmod>\n</url>";
	// }

	// $out .= "\n</urlset>";

	// header("Content-Type: text/xml");

	// echo $out;
?>
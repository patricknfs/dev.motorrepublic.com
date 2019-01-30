<?php
	namespace ProcessWire;
	require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
	require_once(MR_PATH . "/inc/conn.php");
	$pageArray = $pages->find("template=about|basic-page|franchisee-region|vehicle|vehicles|vehicle_v|post|posts|testimonial|testimonials|whatwedo, limit=200");
	$query = "SELECT `id`,`cap_id`,`cap_code`,`src`,`manufacturer`,`model`,`descr`,`term`,`mileage`, `rental`,`vehicle_list_price`,`vehicle_otr_price`,`p11d_price`,`CO2`, `lcv`, `special` FROM `team`.`rates_combined_terse` GROUP BY `cap_id`";
	
	$result = $conn->query($query) or die(mysqli_error($conn));

	$out =  '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

	foreach ($pageArray as $post) {
	  $out .= "\n<url>\n\t<loc>" . $post->httpUrl . "</loc>\n\t<lastmod>" . date("Y-m-d", $post->modified) . "</lastmod>\n</url>";
	}

	foreach ($result as $post2) {
		$out .= "\n<url>\n\t<loc>https://motorrepublic.com/vehicle/" . $post2['cap_id'] . "</loc>\n\t<lastmod>" . date("Y-m-d", $post2->modified) . "</lastmod>\n</url>";
	}

	$out .= "\n</urlset>";

	header("Content-Type: text/xml");

	echo $out;
?>
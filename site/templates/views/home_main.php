<?php
// home_main.php
// include('inc/functions.inc');
?>
<div class="grid-x grid-padding-x">
	<div class="cell medium-6">
		<h3><?=$page->title?></h3>
	</div>
	<div class="cell medium-6">
		<div class="feature_text">
			<?=$page->body?>
		</div>
	</div>
	<div class="promo">
		<video autoplay loop muted poster="/assets/img/video-path.jpg" id="video_bg">
		<source src="<?=$config->urls->assets?>videos/multicolored-particles_zkh9ksnxr__WL.mp4" type="video/mp4">
		</video>
		<div class="grid-x">
			<div class="cell small-8" id="message">
				<h1>Title Goes Here</h1>
				<h2>Subtitle goes here.</h2>
			</div>
		</div>
	</div>
</div>

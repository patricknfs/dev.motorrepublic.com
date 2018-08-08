<?php
// home_main.php
// include('inc/functions.inc');
?>
<div class="home_content">
	<div class="feature">
		<h3><?=$page->feature_title?></h3>
		<div class="feature_img">
			<img src="">
		</div>
		<div class="feature_text">
			<?=$page->feature?>
		</div>
	</div>
	<details>
			<summary>{{ question }}</summary>
			<div>
				{{ answer | markdown }}
			</div>
		</details>
</div>

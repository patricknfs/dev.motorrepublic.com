<?php
// home_main.php
// include('inc/functions.inc');
?>
<div class="home_content">
	<div class="feature">
		<h3><?=$page->feature_title?></h3>
		<div class="feature_img">
			<img src="<?=$page->feature_image->width(560)->url?>">
		</div>
		<div class="feature_text">
			<?=$page->feature?>
		</div>
	</div>
</div>

<div class="homenav">
	<h3 class="comp_title">Quick Links</h3>
	<div class="components">
		<?php
			foreach ($subs AS $sub) {
				?>
				<div class='cat_box'>
					<a href='<?=$sub->url?>'>
						<?php
						// echo $sub->id;
						if($sub->hasChildren > 0){
							$sub_image_page = $pages->get("has_parent.id=$sub->id, template=product, product_images.tags=prod, sort=random");
							if($sub_image_page->id) {
							  $sub_image = $sub_image_page->product_images->find('tags=prod')->getRandom();
								if($sub_image) {
									?>
									<img src='<?=$sub_image->width(170)->url?>' alt='<?=$sub_image->description?>' title='<?=$sub_image->description?>'/>
									<?php
								}
								else {
									?>
									<p>No prod tagged images</p>
									<?php
								}
							}
							else {
								?>
								<p>no + pages</p>
								<?php
							}
						}
						elseif($sub->id == 1066||$sub->id == 2087||$sub->id == 2122){
							$sub_image_page = $pages->get("id=$sub->id, product_images.tags=prod, sort=random");
							// echo "si_id is: " . $sub_image_page;
							$sub_image = $sub_image_page->product_images->find('tags=prod')->getRandom();
							?>
							<img src='<?=$sub_image->width(170)->url?>' alt='<?=$sub_image->description?>' title='<?=$sub_image->description?>'/>
							<?php
						}
						elseif(count($sub->children("include=hidden")) > 0){
							$sub_image_page = $pages->get("has_parent.id=$sub->id, template=product, product_images.tags=prod, sort=random");
							if($sub_image_page->id) {
							  $sub_image = $sub_image_page->product_images->find('tags=prod')->getRandom();
								if($sub_image) {
									?>
									<img src='<?=$sub_image->width(170)->url?>' alt='<?=$sub_image->description?>' title='<?=$sub_image->description?>'/>
									<?php
								}
								else {
									?>
									<p>No prod tagged images</p>
									<?php
								}
							}
							else {
								?>
								<p>no tagged images</p>
								<?php
							}
						}
						else {
							?>
							<p>no pages</p>
							<?php
						}
						?>
						<div class="panel">
							<p itemprop="category"><?=$sub->title?></p>
						</div>
					</a>
				</div>
				<?php
			}
			?>
	</div>
</div>
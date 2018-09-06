<div class="grid-x">
	<div class="cell small-12">
		<div class="callout text-center">
			<h3><?=$page->title?></h3>
			<?=$page->body_no_editor?>
		</div>
	</div>
	<div class="cell small-12">
		<!-- <?=$pagination?> -->
	</div>
</div>
<div class="grid-x">
	<?php
	foreach($result AS $vehicle) {
	    ?>
	    <div class="cell small-6 medium-3" itemscope itemtype="http://schema.org/Product">
	    	<?php
	    	$options = array(
          'quality' => 80,
          'upscaling' => false       
        ); 
        ?>
			<a href="<?= $product->url ?>"><img src="<?= $product->images->first()->width(330,$options)->url ?>" itemprop="image"></a>
			<div class="prod_panel callout">
				<h6 class="text-center" itemprop="name">
					<?php
					 	echo $product->title;
					?>
				</h6>
			</div>
		</div>
		<?php
	}
	?>
	<div class="clearer">&nbsp</div>
</div>
<div class="grid-x">
	<div class="cell small-12">
		<!-- <?=$pagination?> -->
	</div>
</div>
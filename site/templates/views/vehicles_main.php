<div class="grid-x">
	<div class="cell small-12">
		<div class="callout text-center">
			<h3><?=$page->title?></h3>
			
		</div>
	</div>
	<div class="cell small-12">
		
	</div>
</div>
<div class="grid-x">
	<?php
	var_dump($result);
	foreach($result AS $vehicle) {
		?>
		<div class="cell small-6 medium-3" itemscope itemtype="http://schema.org/Product">
			<?php
			$options = array(
				'quality' => 80,
				'upscaling' => false       
			); 
			?>
			<div class="prod_panel callout">
				<h6 class="text-center" itemprop="name">
					<?=$vehicle->manufacturer?> <?=$vehicle->model?>
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

	</div>
</div>
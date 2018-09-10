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
	foreach($result AS $vehicle) {
		$rates_query = "SELECT `rental` FROM `team`.`rates_combined` WHERE `cap_id` = " . $vehicle['cap_id'] . " AND term = '24M' AND `mileage` = '8K' ORDER BY `rental` ASC LIMIT 1";
		$rental = $conn->query($rates_query) or die(mysqli_error($conn));
		// print_r($vehicle);
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
					<?=$vehicle['manufacturer']?> <?=$vehicle['model']?><br /><?=$rental?>
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
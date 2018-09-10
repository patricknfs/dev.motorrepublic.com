<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<div class="text-center">
				<h3><?=$page->title?></h3>
				<?php echo $forms->embed('vehicle_power_search'); ?>
			</div>
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
				<div>
					<?=$vehicle['cap_id']?>
					<h6>
						<?=$vehicle['manufacturer']?> <?=$vehicle['model']?>
					</h6>
					<p><?=$vehicle['descr']?></p>
					<h4><?=$vehicle['rental']?></h4>
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
</div>

<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<div class="text-center">
				<h3><?=$page->title?></h3>
				<?php echo $forms->embed('vehicle_power_search'); ?>
			</div>
		</div>
	</div>
	<div class="grid-x grid-padding-x small-up-2 medium-up-4">
		<?php
		foreach($result AS $vehicle) {
			$options = array(
				'quality' => 80,
				'upscaling' => false       
			); 
			?>
			<div class="cell">
				<div class="card">
				<!-- <?=$vehicle['cap_id']?> -->
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
	</div>
	<div class="grid-x">
		<div class="cell small-12">

		</div>
	</div>
</div>

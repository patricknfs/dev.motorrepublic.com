<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<div class="text-center">
				<!-- <h3><?=$page->title?></h3> -->
				<?php echo $forms->embed('vehicle_power_search'); ?>
			</div>
		</div>
	</div>
	<div class="grid-x grid-padding-x small-up-2 medium-up-4">
		<?php
		$bch = (($vehicle['rental'] * $vehicle['term']) + 300) / $vehicle['term'];
		$pch = ((($vehicle['rental'] * $vehicle['term']) + 300) / $vehicle['term'])*1.2;
		$hashcode = strtoupper(md5("173210NfS4JeCAR" . $vehicle['cap_id']));
		?>
		<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$input->urlSegment1;?>&DATE=2018/09/11&WIDTH=1024&HEIGHT=768&IMAGETEXT=&VIEWPOINT=">
		<div class="card-section">
			<h6>
				<?=$vehicle['manufacturer']?> <?=$vehicle['model']?>
			</h6>
			<p><?=$vehicle['descr']?></p>
		</div>
		<div class="card-divider">
		<h6>Business Clients £<?=$bch?></h6>
							<h6>Personal Clients £<?=round($pch, 2)?></h6>
		</div>
	</div>
	<div class="grid-x">
		<div class="cell small-12">

		</div>
	</div>
</div>

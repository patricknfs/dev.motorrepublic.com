<div class="grid-container">
	<div class="grid-x">
		<div class="cell small-12">
			<div class="text-center">
				<!-- <h3><?=$page->title?></h3> -->
				<?php echo $forms->embed('vehicle_power_search'); ?>
			</div>
		</div>
	</div>
	<div class="grid-x grid-padding-x">
		<?php
		$bch = (($data['rental'] * $data['term'] + 300) / $data['term']);
		$pch = ((($data['rental'] * $data['term']) + 300) / $data['term'])*1.2;
		$hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));
		?>
		<div class="cell small-12 medium-8">
		<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$input->urlSegment1;?>&DATE=2018/09/11&WIDTH=1024&HEIGHT=768&IMAGETEXT=&VIEWPOINT=">
		</div>
		<div class="cell small-12 medium-4">
			<div class="card">
				<h6>
					<?=$data['manufacturer']?> <?=$data['model']?>
				</h6>
				<p><?=$data['descr']?></p>
				<h6>Business Clients £<?=round($bch, 2)?></h6>
				<h6>Personal Clients £<?=round($pch, 2)?></h6>
			</div>
		</div>
	</div>
</div>

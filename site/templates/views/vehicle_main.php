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
		$bch = round((($data['rental'] * $data['term'] + 300) / $data['term']),2);
		$pch = round(((($data['rental'] * $data['term']) + 300) / $data['term'])*1.2,2);
		$hashcode = strtoupper(md5("173210NfS4JeCAR" . $input->urlSegment1));
		?>
		<div class="cell small-12 medium-8">
			<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$input->urlSegment1;?>&DATE=2018/09/11&WIDTH=800&HEIGHT=600&IMAGETEXT=&VIEWPOINT=">
		</div>
		<div class="cell small-12 medium-4">
			<div class="card card-2">
				<div class="card-section">
					<h3><?=$data['manufacturer']?> <?=$data['model']?></h3>
					<p><?=$data['descr']?></p>
					<hr>
						<h6>Business Clients - From <span class="price">£<?=$bch?></span> *</h6>
						<h6>Personal Clients - From <span class="price">£<?=$pch?></span> **</h6>
					<hr>
					<small>* Based on an initial rental of £<?=$bch*3?> followed by <?=str_replace("M", '', $data['term'])-1?> rentals of £<?=$bch?> and annual mileage of <?=str_replace("K",",000",$data['mileage'])?></small>
					<br /><small>** Based on an initial rental of £<?=$pch*3?> followed by <?=str_replace("M", '', $data['term'])-1?> rentals of £<?=$pch?> and annual mileage of <?=str_replace("K",",000",$data['mileage'])?></small>
				</div>
			</div>
		</div>
	</div>
</div>

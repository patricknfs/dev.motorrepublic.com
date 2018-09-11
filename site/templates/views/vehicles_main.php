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
		foreach($result AS $vehicle) {
			$options = array(
				'quality' => 80,
				'upscaling' => false       
			); 
			$rental = (($vehicle['rental'] * $vehicle['term']) + 300) / $vehicle['term'];
			$hashcode = md5("173210NfS4JeCAR" . $vehicle['cap_id']);
			$imagefile = $vehicle['cap_id'];
			// Get cURL resource
			$curl = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
$rawdata=curl_exec ($ch);
curl_close ($ch);
$fp = fopen($imagefile . ".jpg",'w');
fwrite($fp, $rawdata);
fclose($fp);
header ("Content-Type: image/jpg");
readfile($imagefile . ".jpg");
			?>
			<div class="cell">
				<a href="<?=$config->urls->templates?>vehicle/<?=$vehicle['cap_id']?>">
					<div class="card">
						<!-- <?=$vehicle['cap_id']?> -->
						<img src="<?=$fp?>">
						<div class="card-section">
							<h6>
								<?=$vehicle['manufacturer']?> <?=$vehicle['model']?>
							</h6>
							<p><?=$vehicle['descr']?></p>
						</div>
						<div class="card-divider">
							<h4>£<?=$rental?></h4>
						</div>
					</div>
				</a>
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

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
			// header("Content-Type: image/jpeg");
			$headers = array(
				'Content-Type: image/jpeg'
			);
			// echo $hashcode;
			// Get cURL resource
			$curl = curl_init();
			// Set some options - we are passing in a useragent too here
			curl_setopt_array($curl, array(
					CURLOPT_HTTPHEADER => $headers,
					CURLOPT_RETURNTRANSFER => 1,
					CURLOPT_BINARYTRANSFER => 1,
					CURLOPT_URL => "https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=" . strtoupper($hashcode) . "&DB=CAR&CAPID=" . $vehicle['cap_id'] . "&DATE=2018/09/11&WIDTH=1024&HEIGHT=768&IMAGETEXT=test&VIEWPOINT=",
					CURLOPT_USERAGENT => 'User Agent X',
					CURLOPT_HEADER => 0
			));
			// Send the request & save response to $resp
			$image = curl_exec($curl);
			// Close request to clear up some resources
			// print_r($image);
			curl_close($curl);
			?>
			<div class="cell">
				<a href="<?=$config->urls->templates?>vehicle/<?=$vehicle['cap_id']?>">
					<div class="card">
						<!-- <?=$vehicle['cap_id']?> -->
						<img src="<?=$image?>">
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

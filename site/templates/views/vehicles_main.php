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


			function gets($url){
				$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';              
				$headers[] = 'Connection: Keep-Alive';         
				$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8';
	
				$userAgent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/62.0.3202.94 Safari/537.36';
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_VERBOSE, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
				$output = curl_exec($ch);
				curl_close($ch);
				return $output;
		}
		$img = "https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=" . strtoupper($hashcode) . "&DB=CAR&CAPID=" . $vehicle['cap_id'] . "&DATE=2018/09/11&WIDTH=1024&HEIGHT=768&IMAGETEXT=test&VIEWPOINT=";
		// header('Content-type: image/jpeg');
		// echo gets($img);
			?>
			<div class="cell">
				<a href="<?=$config->urls->templates?>vehicle/<?=$vehicle['cap_id']?>">
					<div class="card">
						<!-- <?=$vehicle['cap_id']?> -->
						<img src="<?=gets($img)?>">
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

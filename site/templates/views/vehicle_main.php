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
		// var_dump($data);
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
						<h6>Business Clients - From <span class="price">£<?=$bch_rental?></span> * excl. VAT</h6>
						<h6>Personal Clients - From <span class="price">£<?=$pch_rental?></span> ** inc. VAT</h6>
					<hr>
					<small>* Based on an initial rental of £<?=$bch_initial?> excluding VAT followed by <?=str_replace("M", '', $data['term'])-1?> monthly rentals of £<?=$bch_rental?> and covering <?=str_replace("K",",000",$data['mileage'])?> miles annually.</small>
					<br /><small>** Based on an initial rental of £<?=$pch_initial?> including VAT followed by <?=str_replace("M", '', $data['term'])-1?> monthly rentals of £<?=$pch_rental?> and covering <?=str_replace("K",",000",$data['mileage'])?> miles annually.</small>
				</div>
			</div>
		</div>
	</div>
</div>
<section id="vehicle_details">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell small-12">
				<ul class="tabs" data-tabs id="example-tabs">
					<li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Standard Equipment</a></li>
					<li class="tabs-title"><a data-tabs-target="panel2" href="#panel2">Tab 2</a></li>
				</ul>
				<div class="tabs-content" data-tabs-content="example-tabs">
					<div class="tabs-panel is-active" id="panel1">
					<ul>
					<?php
					foreach($groups AS $group){
						echo "<li>" . $group;
						foreach($equipment as $item){
							echo $item->Dc_Description . " = " . $group . "<br />";
							if(trim($item->Dc_Description) === trim($group)){
								echo $item->Do_Description;
							}
							else {
								echo "The categories do not match";
							}
						}
						echo "</li>";
					}
					?>
					</ul>
					</div>
					<div class="tabs-panel" id="panel2">
						<p>Suspendisse dictum feugiat nisl ut dapibus.  Vivamus hendrerit arcu sed erat molestie vehicula. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.  Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

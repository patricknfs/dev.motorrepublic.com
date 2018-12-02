<section id="vehicle">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<?php
			// var_dump($data);
			?>
			<div class="cell small-12 medium-8">
				<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$input->urlSegment1;?>&DATE=2018/09/11&WIDTH=800&HEIGHT=600&IMAGETEXT=&VIEWPOINT=">
				<section id="vehicle_details">
		<!-- `			<div class="grid-container"> -->
						<div class="grid-x">
							<div class="cell small-12">
								<ul class="tabs" data-tabs id="example-tabs">
									<li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Standard Equipment</a></li>
									<li class="tabs-title"><a data-tabs-target="panel2" href="#panel2">Technical Data</a></li>
								</ul>
								<div class="tabs-content" data-tabs-content="example-tabs">
									<div class="tabs-panel is-active" id="panel1">
										<?php
										foreach($groups AS $group){
											echo "<ul><strong>" . $group . "</strong>";
											foreach($equipment as $item){
												// echo $item->Dc_Description . " = " . $group . "<br />";
												if(trim($item->Dc_Description) === trim($group)){
													echo "<li>" . $item->Do_Description . "</li>";
												}
											}
											echo "</ul>";
										}
										?>
									</div>
									<div class="tabs-panel" id="panel2">
									<?php
										foreach($groups2 AS $group2){
											echo "<ul><strong>" . $group2 . "</strong>";
											foreach($tech_data as $item2){
												// echo $item->Dc_Description . " = " . $group . "<br />";
												if(trim($item2->Dc_Description) === trim($group2)){
													echo "<li class='grid-x'><div class='cell small-3'>" . $item2->DT_LongDescription . "</div><div class='cell small-3'>".  $item2->tech_value_string . "</div></li>";
												}
											}
											echo "</ul>";
										}
										?>
									</div>
								</div>
							</div>
						</div>
					<!-- </div> -->
				</section>`
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
				<div class="cell small-12 medium-4">
					<div class="card card-2">
						<div class="card-section">
							<h4 style="color:#cc1000">More Info</h4>
							<p>Fill out the form below and we will contact you back. Or, use the live chat option bottom right</p>
							<?php echo $forms->embed('vehicle_quick_contact'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</section>

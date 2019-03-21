<?php
if($data['special'] == 1)
{
?>
<section id="vehicle">
	<div class="grid-container">
		<div class="grid-x grid-padding-x">
			<div class="cell small-12 medium-8 small-order-2 medium-order-1">
				<img class="large_vehicle_image" src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=<?=$vehicle_type?>&CAPID=<?=$input->urlSegment1;?>&DATE=2018/09/11&WIDTH=800&HEIGHT=600&IMAGETEXT=&VIEWPOINT=" alt="<?=$manufacturer?> <?=$model?> - <?=$input->urlSegment1?>" />
				<section id="vehicle_details">
					<!--<div class="grid-container"> -->
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
													echo "<li class='grid-x'><div class='cell small-6'>" . $item2->DT_LongDescription . "</div><div class='cell small-6'>".  $item2->tech_value_string . "</div></li>";
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
				</section>
			</div>
			<div class="cell small-12 medium-4 small-order-1 medium-order-2">
			<img class="small_vehicle_image" src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=<?=$vehicle_type?>&CAPID=<?=$input->urlSegment1;?>&DATE=2018/09/11&WIDTH=800&HEIGHT=600&IMAGETEXT=&VIEWPOINT=">
				<div class="card card-2">
					<div class="card-section">
						<h2><?=$manufacturer?> <?=$model?></h2>
						<p><?=$descr?></p>
						<hr>
						<h6>Business Clients - From <strong><span class="price">£<?=$bch_rental[0]?></span><span class="pence">.<?=$bch_rental[1]?></span></strong> * excl. VAT</h6>
						<?php
						if($biz_only == 0){
							?>
							<h6>Personal Clients - From <strong><span class="price">£<?=$pch_rental[0]?></span><span class="pence">.<?=$pch_rental[1]?></span></span></strong> ** inc. VAT</h6>
							<?php
						}
						// echo "biz is: " . $biz_only;
						?>
						<hr>
						<small>* Based on an initial rental of £<?=$bch_initial?> excluding VAT followed by <?=$term?> monthly rentals of £<?=$bch_rental[0]?>.<?=$bch_rental[1]?> and covering <?=$mileage?> miles annually.</small>
						<?php
						if($biz_only == 0){
							?>
							<br /><small>** Based on an initial rental of £<?=$pch_initial?> including VAT followed by <?=$term?> monthly rentals of £<?=$pch_rental[0]?>.<?=$pch_rental[1]?> and covering <?=$mileage?> miles annually.</small>
							<?php
						}
						if($website_deal_notes){
							echo "<br /><br /><h6>Additional Information</h6>";
							echo "<small>$website_deal_notes</small>";	
						}
						?>
					</div>
					<?php
					if($special == 1){
						?>
						<div class="card-section special">
							<h4>Special Deal<h4>
						</div>
						<?php
					}
					?>
				</div>
				<div class="card card-2 gen_form">
					<div class="card-section">
						<h4>Get a Quote Now</h4>
						<p>Fill out the form below and we will contact you back, or, use the live chat option bottom right</p>
						<?php echo $forms->embed('vehicle_quick_contact'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
}
?>
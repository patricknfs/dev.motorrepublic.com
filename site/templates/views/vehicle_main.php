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
				<ul class="tabs" data-tab>
					<li class="tab-title active"><a href="#panel1">Standard Equipment</a></li>
					<li class="tab-title"><a href="#panel2">Tab 2</a></li>
					<li class="tab-title"><a href="#panel3">Tab 3</a></li>
					<li class="tab-title"><a href="#panel4">Tab 4</a></li>
				</ul>
				<div class="tabs-content">
					<div class="content active" id="panel1">
						<p>This is the first panel of the basic tab example. You can place all sorts of content here including a grid.</p>
					</div>
					<div class="content" id="panel2">
						<p>This is the second panel of the basic tab example. This is the second panel of the basic tab example.</p>
					</div>
					<div class="content" id="panel3">
						<p>This is the third panel of the basic tab example. This is the third panel of the basic tab example.</p>
					</div>
					<div class="content" id="panel4">
						<p>This is the fourth panel of the basic tab example. This is the fourth panel of the basic tab example.</p>
					</div>
				</div>
			</div>
		</div>
	</div>

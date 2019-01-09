<?php
// home_main.php
?>
<section id="promo" style="background: url(<?=$config->urls->assets?>/files/1/istock-528474010_super_1200_80.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
	<!-- <div class="overlay"></div> -->
	<div class="grid-container">
		<div class="grid-x">
			<div id="hero-title" class="cell small-12 medium-4">
				<h1>Driving the Best Deals to You</h1>
			</div>
		</div>
	</div>
</section>
<?php
	$bch_rental = number_format($data['rental'], 2, '.', ',');
	$pch_rental = number_format(($data['rental']*1.2), 2, '.', ',');
	$vehicle_type = ($data['lcv'] == 1?"LCV":"CAR");
	$hashcode = strtoupper(md5("173210NfS4Je" . $vehicle_type . $data['cap_id']));
?>
<section id="block_one">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-8">
			<div class="grid-x grid-padding-x small-up-1 medium-up-2">
			<?php
			
				foreach($result AS $vehicle) {
					$options = array(
						'quality' => 80,
						'upscaling' => false       
					);
					$vehicle_type = ($vehicle['lcv'] == 1?"LCV":"CAR");
					$hashcode = strtoupper(md5("173210NfS4Je" . $vehicle_type . $vehicle['cap_id']));

					$bch_rental = number_format(((($vehicle['rental'] * $vehicle['term']) + 300) / ($vehicle['term']+8)), 2, '.', ',');
					$pch_rental = number_format(((($vehicle['rental'] * $vehicle['term']) + 300) / ($vehicle['term']+8)*1.2), 2, '.', ',');

					$bchs_rental = number_format($vehicle['rental'], 2, '.', ',');
					$pchs_rental = number_format(($vehicle['rental']*1.2), 2, '.', ',');
					
					$bch = (($vehicle['special'] == 1)?$bchs_rental:$bch_rental);
					$pch = (($vehicle['special'] == 1)?$pchs_rental:$pch_rental);
					?>
					<div class="cell">
						<a href="/vehicle/<?=$vehicle['cap_id']?>">
							<div class="card">
								<div class="card-section">
									<h4><?=$vehicle['manufacturer']?> <?=$vehicle['model']?></h4>
									<p id="veh_descr"><?=$vehicle['descr']?></p>
								</div>
								<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=<?=$vehicle_type?>&CAPID=<?=$vehicle['cap_id']?>&DATE=2018/09/11&WIDTH=400&HEIGHT=300&IMAGETEXT=&VIEWPOINT=">
								<div class="card-section">
									<h6>Business Clients: <span class="price">£<?=$bch?></span><small>/m ex VAT</small></h6>
									<h6>Personal Clients: <span class="price">£<?=$pch?></span><small>/m inc VAT</small></h6>
									<small>click for more details...</small>
								</div>
								<?php
								if($vehicle['special'] == 1){
								?>
								<div class="card-section special">
									<h4>Special Deal<h4>
								</div>
								<?php
								}
								?>
							</div>
						</a>
					</div>
				<?php
				}

			?>
		</div>
			</div>
			<div class="cell small-12 medium-4">
				<!-- <h3>Straight To The Special Deals</h3> -->
				<div class="grid-x grid-margin-x">
					<?php
						$options = array(
							'quality' => 80,
							'upscaling' => false       
						);
					?>
					<div class="cell small-12">
						<a class="dashboard-nav-card" href="/find-your-car/">
							<i class="dashboard-nav-card-icon fas fa-car fa-3x" aria-hidden="true"></i>
							<h3 class="dashboard-nav-card-title">Cars</h3>
						</a>
					</div>
					<div class="cell small-12">
						<a class="dashboard-nav-card" href="/van-leasing-hgv/">
							<i class="dashboard-nav-card-icon fas fa-shuttle-van fa-3x" aria-hidden="true"></i>
							<h3 class="dashboard-nav-card-title">Vans & Pickups</h3>
						</a>
					</div>
					<div class="cell small-12">
						<h3>Our Panel of Funders</h3>
						<img src="<?=$config->urls->assets?>graphics/who_we_work_with_email_090118.png">
					</div>
					<div class="cell small-12">
						<?=$page->regional_strength?>
					</div>
				</div>
				
			</div>
		</div>
	</div>
</section>
<!-- <section id="block_two">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell small-12 medium-6">
				<h1>Focus on the Tesla phenomenon</h1>
				<p>It's a T. It goes "tuh". We're rescuing ya. You've killed me! Oh, you've killed me! I had more, but you go ahead.</p>
				<p>When I was first asked to make a film about my nephew, Hubert Farnsworth, I thought "Why should I? " Then later, Leela made the film. <strong> But if I did make it, you can bet there would have been more topless women on motorcycles.</strong> <em> Roll film!</em> Why would a robot need to drink?</p>
			</div>
			<div class="cell small-12 medium-6"></div>
		</div>
	</div>
</section> -->
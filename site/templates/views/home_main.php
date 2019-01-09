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
				<a href="/vehicle/<?=$data['cap_id']?>">
					<div class="card">
						<div class="card-section">
							<!-- <h3>Hot Deals</h3> -->
							<h3>
								<?=$data['manufacturer']?> <?=$data['model']?>
							</h3>
							<p><?=$data['descr']?></p>
						</div>
						<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=<?=$vehicle_type?>&CAPID=<?=$data['cap_id']?>&DATE=2018/09/11&WIDTH=400&HEIGHT=300&IMAGETEXT=&VIEWPOINT=">
						<div class="card-section">
							<h6>Business Clients: <span class="price">£<?=$bch_rental?></span><small>/mth excl. VAT</small></h6>
							<h6>Personal Clients: <span class="price">£<?=$pch_rental?></span><small>/mth inc. VAT</small></h6>
							<small>click for more details...</small>
						</div>
						<div class="card-section special">
							<h4>Special Deal<h4>
						</div>
					</div>
				</a>
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
					<div class="cell small-12 medium-6">
						<a class="dashboard-nav-card" href="/find-your-car/">
							<i class="dashboard-nav-card-icon fas fa-car fa-3x" aria-hidden="true"></i>
							<h3 class="dashboard-nav-card-title">Car Deals</h3>
						</a>
					</div>
					<div class="cell small-12 medium-6">
						<a class="dashboard-nav-card" href="/van-leasing-hgv/">
							<i class="dashboard-nav-card-icon fas fa-shuttle-van fa-3x" aria-hidden="true"></i>
							<h3 class="dashboard-nav-card-title">Van & Pickup Deals</h3>
						</a>
					</div>
					<div class="cell small-12 medium-6">
						<h3>Our Panel of Funders</h3>
						<img src="<?=$config->urls->assets?>graphics/who_we_work_with_email_090118.png">
					</div>
					<div class="cell small-12 medium-6">
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
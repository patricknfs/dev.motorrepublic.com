<?php
// home_main.php
?>
<section id="promo" style="background: url(<?=$config->urls->assets?>/files/1/istock-528474010_super_1200_80.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
	<!-- <div class="overlay"></div> -->
	<div class="grid-container">
		<div class="grid-x">
			<div id="hero-title" class="cell small-12 medium-4">
				<h1 class="hero-header">Driving the Best Deals to You</h1>
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
			<div class="cell small-12 medium-6" style="background: url('<?=$config->urls->assets . "images/mercedes_a-class_2018_120219_600.jpg"?>')  no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
				<div class="grid-x ">	
					<div id="car_specials" class="cell small-3">
						<h1>Car Specials</h1>
					</div>
					<div class="cell auto">&nbsp;</div>
				</div>
			</div>
			<div class="cell small-12 medium-6" style="background: url('<?=$config->urls->assets . 'images/ford_transit_120219_600.jpg'?>')  no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
				<div class="grid-x">	
					<div id="van_specials" class="cell small-3">
						<h1>Van &amp; Pickup Specials</h1>
					</div>
				</div>
				<div class="cell auto">&nbsp;</div>
			</div>
		</div>
	</div>
</section>
<section id="block_three">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-6">
				<a class="dashboard-nav-card" href="/find-your-car/">
					<i class="dashboard-nav-card-icon fas fa-car fa-3x" aria-hidden="true"></i>
					<h3 class="dashboard-nav-card-title">Cars</h3>
				</a>
			</div>
			<div class="cell small-12 medium-6">
				<a class="dashboard-nav-card" href="/van-leasing-hgv/">
					<i class="dashboard-nav-card-icon fas fa-shuttle-van fa-3x" aria-hidden="true"></i>
					<h3 class="dashboard-nav-card-title">Vans & Pickups</h3>
				</a>
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
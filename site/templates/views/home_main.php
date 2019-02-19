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
			<div class="cell small-12 medium-6">
				<a href="/vehicles/"><img src="<?=$config->urls->assets?>images/mercedes_a-class_2018_140219_600.png" alt="Van Pickup and HGV lease"/></a>
			</div>
			<div class="cell small-12 medium-6">
				<a href="/van-leasing-hgv/"><img src="<?=$config->urls->assets?>images/ford_transit_140219_600.png" alt="Car Lease"/></a>
			</div>
		</div>
	</div>
</section>
<section id="block_marques">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-6 grid-margin-y">
				<div class="cell small-12">
					<a href="http://dev.motorrepublic.com/van-leasing-hgv/?slct1=BMW&slct2=-undefined"><img src="<?=$config->urls->assets?>graphics/bmw_specials_600.png" /></a>
				</div>
				<div class="cell small-12 medium-6">
					<a href="http://dev.motorrepublic.com/van-leasing-hgv/?slct1=MERCEDES&slct2=-undefined"><img src="<?=$config->urls->assets?>graphics/mercedes_specials_600.png" /></a>
				</div>
				<div class="cell small-12 medium-6">
					<a href="http://dev.motorrepublic.com/van-leasing-hgv/?slct1=LAND+ROVER&slct2=-undefined"><img src="<?=$config->urls->assets?>graphics/landrover_specials_600.png" /></a>
				</div>
				<div class="cell small-12 medium-6">

				</div>
				<div class="cell small-12 medium-6">

				</div>
				<div class="cell small-12 medium-6">

<<<<<<< HEAD
=======
						</div>
					</div>
					<div class="card-section">
						<h3>Our Panel of Funders</h3>
						<img src="<?=$config->urls->assets?>graphics/who_we_work_with_email_090118.png">
					</div>
>>>>>>> master
				</div>
			</div>
			<div class="cell small-12 medium-6 card">
				<div class="card-section">
					<?=$page->body?>
				</div>
			</div>
		</div>
	</div>
</section>

<section id="block_three">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-6">
				<a class="dashboard-nav-card" href="/vehicles/">
					<i class="dashboard-nav-card-icon fas fa-car fa-3x" aria-hidden="true"></i>
					<h3 class="dashboard-nav-card-title">Latest Car Specials</h3>
				</a>
			</div>
			<div class="cell small-12 medium-6">
				<a class="dashboard-nav-card" href="/van-leasing-hgv/">
					<i class="dashboard-nav-card-icon fas fa-shuttle-van fa-3x" aria-hidden="true"></i>
					<h3 class="dashboard-nav-card-title">Latest Vans & Pickup Specials</h3>
				</a>
			</div>
		</div>
	</div>
</section>
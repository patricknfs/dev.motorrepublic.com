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

<section id="block_one">
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-8">
				<h3>Straight To The Deals</h3>
				<div class="grid-x grid-margin-x">
					<?php
						$options = array(
							'quality' => 80,
							'upscaling' => false       
						);
					?>
					<div class="cell small-12 medium-4">
						<a href="/vehicle/<?=$vehicle['cap_id']?>">
							<div class="card">
								<div class="card-section">
									<h4>Cars</h4>
								</div>
								<div class="home_deals card-image">
									<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$vehicle['cap_id']?>&DATE=2018/09/11&WIDTH=300&HEIGHT=225&IMAGETEXT=&VIEWPOINT=">
								</div>
							</div>
						</a>
					</div>
					<div class="cell small-12 medium-4">
						<a href="/vehicle/<?=$vehicle['cap_id']?>">
							<div class="card">
								<div class="card-section">
									<h4>Vans</h4>
								</div>
								<div class="home_deals card-image">
									<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$vehicle['cap_id']?>&DATE=2018/09/11&WIDTH=300&HEIGHT=225&IMAGETEXT=&VIEWPOINT=">
								</div>
							</div>
						</a>
					</div>
					<div class="cell small-12 medium-4">
						<a href="/vehicle/<?=$vehicle['cap_id']?>">
							<div class="card">
								<div class="card-section">
									<h4>Pickups</h4>
								</div>
								<div class="home_deals card-image">
									<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$vehicle['cap_id']?>&DATE=2018/09/11&WIDTH=300&HEIGHT=225&IMAGETEXT=&VIEWPOINT=">
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
			<div class="cell small-12 medium-4">
				<div id="message">
					<h2>Deal of the Day</h2>
					<img src="<?=$config->urls->assets?>images/ford_fiesta_st2.jpg">
					<h4>THE ALL NEW FIESTA ST2</h4>
					<p>Available in stock now from £215.99 inc. VAT</p>
					<p><a href="#">More details...</a></p>
				</div>
				<h3>Magazine Article</h3>
				<p>Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends. </p>
				<h3>Regional Strength?</h3>
				<p>Your bones don't break, mine do. That's clear. Your cells react to bacteria and viruses differently than mine. You don't get sick, I do. That's also clear. But for some reason, you and I react the exact same way to water. We swallow it too fast, we choke. We get some in our lungs, we drown. However unreal it may seem, we are connected, you and I. We're on the same curve, just on opposite ends. </p>
			</div>
		</div>
	</div>
</section>
<section id="block_two">
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
</section>
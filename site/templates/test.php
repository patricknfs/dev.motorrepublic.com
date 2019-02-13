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
					<div class="cell small-12 card">
						<div class="card-section">
							<h3>Our Panel of Funders</h3>
							<img src="<?=$config->urls->assets?>graphics/who_we_work_with_email_090118.png">
						</div>
					</div>
					<div class="cell small-12 card">
						<div class="card-section">
							<?=$page->regional_strength?>
						</div>
					</div>
				</div>
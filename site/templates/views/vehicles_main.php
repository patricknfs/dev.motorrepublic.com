<section id="vehicles">
	<div class="grid-container">
		<!-- <div class="grid-x">
			<div class="cell small-12">
				<div class="text-center">
					<?=$form_out?>
				</div>
			</div>
		</div> -->
		<div class="grid-x align-center">
			<nav aria-label="Pagination">
				<ul class="pagination text-center">
					<li><a href="?pageno=1">First</a></li>
					<li class="pagination-previous <?php if($pageno <= 1){ echo 'disabled'; } ?>">
						<a href="<?php echo ($pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1)) ?>">Previous <span class="show-for-sr">page</span></a>
					</li>
					<li class="pagination-next <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
						<a href="
							<?php
							if($pageno >= $total_pages){
								echo "#";
							}
							else {
								if(!empty($manuf)){
									echo "&slct1=" . $manuf . "&slct2=" . $mdl;
								}
								else{
									echo "undefined";
								}
								echo "?pageno=" . ($pageno + 1);
							}
							?> 
							aria-label="Next page">Next <span class="show-for-sr">page</span>
						</a>
					</li>
					<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
				<ul>
			</nav>
		</div>
		<div class="grid-x grid-padding-x small-up-1 medium-up-3">
			<?php
			if($total_rows > 0){
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
									<h3><?=$vehicle['manufacturer']?> <?=$vehicle['model']?></h3>
									<p id="veh_descr"><?=$vehicle['descr']?></p>
								</div>
								<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=<?=$vehicle_type?>&CAPID=<?=$vehicle['cap_id']?>&DATE=2018/09/11&WIDTH=400&HEIGHT=300&IMAGETEXT=&VIEWPOINT=" alt="<?=$vehicle['manufacturer']?> <?=$vehicle['model']?> - <?=$vehicle['cap_id']?>">
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
			}
			else {
				echo "<h2>This vehicle is either a special purchase or not currently available. Please call the number above or use live chat to speak to an expert.</h2>";
			}
			?>
		</div>
		<div class="grid-x">
			<div class="cell small-12">

			</div>
		</div>
	</div>
	<div class="grid-x align-center">
		<nav class="nav_pagination" aria-label="Pagination">
			<ul class="pagination text-center">
				<li><a href="?pageno=1">First</a></li>
				<li class="pagination-previous <?php if($pageno <= 1){ echo 'disabled'; } ?>">
					<a href="<?php echo ($pageno <= 1 ? '#' : '?pageno=' . ($pageno - 1)) ?>">Previous <span class="show-for-sr">page</span></a>
				</li>
				<li class="pagination-next <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
					<a href="<?php echo ($pageno >= $total_pages ? '#' : '?pageno=' . ($pageno + 1)) ?>"  aria-label="Next page">Next <span class="show-for-sr">page</span></a>
				</li>
				<li><a href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
			<ul>
		</nav>
	</div>
</section>

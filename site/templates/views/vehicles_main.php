<section id="vehicles">
	<div class="grid-container">
		<div class="grid-x">
			<div class="cell small-12">
				<div class="text-center">
					<?=$form_out?>
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
		<div class="grid-x grid-padding-x small-up-2 medium-up-4">
			<?php
			foreach($result AS $vehicle) {
				$options = array(
					'quality' => 80,
					'upscaling' => false       
				);

				$bch_rental = number_format(((($vehicle['rental'] * $vehicle['term']) + 300) / ($vehicle['term']+8)), 2, '.', ',');
				$pch_rental = number_format(((($vehicle['rental'] * $vehicle['term']) + 300) / ($vehicle['term']+8)*1.2), 2, '.', ',');

				$hashcode = strtoupper(md5("173210NfS4JeCAR" . $vehicle['cap_id']));
				?>
				<div class="cell">
					<a href="/vehicle/<?=$vehicle['cap_id']?>">
						<div class="card">
							<div class="card-section">
								<h6>
									<?=$vehicle['manufacturer']?> <?=$vehicle['model']?>
								</h6>
								<p><?=$vehicle['descr']?></p>
							</div>
							<img src="https://soap.cap.co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=<?=$hashcode?>&DB=CAR&CAPID=<?=$vehicle['cap_id']?>&DATE=2018/09/11&WIDTH=300&HEIGHT=225&IMAGETEXT=&VIEWPOINT=">
							<div class="card-section">
								<h6>Business Clients<br /><span class="price">£<?=$bch_rental?></span>/mth excl. VAT</h6>
								<h6>Personal Clients<br /><span class="price">£<?=$pch_rental?></span>/mth inc. VAT</h6>
								<small>click for more details...</small>
							</div>
						</div>
					</a>
				</div>
			<?php
			}
			?>
		</div>
		<div class="grid-x">
			<div class="cell small-12">

			</div>
		</div>
	</div>
</section>

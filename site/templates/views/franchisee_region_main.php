<?php
// basic-page_main.php
?>
<section id="intro" style="background: url(<?=$config->urls->assets?>images/banner_bg.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-3 medium-9">

      </div>
      <div class="cell small-9 medium-3">
        <h3><?php echo $page->title; ?></h3>
        <img src="<?=$page->profile_image->url?>" alt="<?=$page->profile_image->description?>" />
        <h4><?=$page->franchisee_name?></h4>
        <p>Phone: <?=$page->franchisee_telno?></p>
        <p>Mobile: <?=$page->franchisee_mobno?></p>
        <p>Email: <a href="mailto:<?=$page->franchisee_email?>"><?=$page->franchisee_email?></a></p>
        </div>
    </div>
  </div>
</section>
<section id="content">
  <div class="grid-container">
    <h2>My Favourite Deals</h2>
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
							<h6>Business Clients<br /><span class="price">£<?=$bch_rental?></span> excl. VAT</h6>
							<h6>Personal Clients<br /><span class="price">£<?=$pch_rental?></span> inc. VAT</h6>
							<small>click for more details...</small>
						</div>
					</div>
				</a>
			</div>
		<?php
		}
		?>
      </div>
    </div>
  </div>
</section>
<section id="testimonial">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-12 medium-12">
        <!-- In this container, add blockquote-left or blockquote-right to make the blockquote left / -->
        <div class="blockquote-container">
          <div class="callout">
            <h4 class="blockquote-title"><?=$testimonial->title?></h4>
            <blockquote>
              <span class="blockquote-content"><?=$testimonial_blurb?>... <a href="<?=$testimonial->url?>">more details</a></i></span>
            </blockquote>
            <div class="sig">
              <cite><?=$testimonial->sig?></cite>
            </div>
          </div>
        </div>
      </div>
      <div class="cell small-12 medium-4">
        <?=$page->body?>
      </div>
    </div>
  </div>
</section>
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
    <div class="grid-x grid-padding-x small-up-2 medium-up-4">
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
$testimonial = $pages->find("template=testimonial, sort=random, limit=1");
print_r($testimonial);
?>
<section id="testimonial">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-12 medium-12">
        <h1><?php echo $testimonial->title; ?></h1>
        <?=$testimonial->body?>
        <div class="sig">
          <?=$testimonial->sig?>
        </div>
      </div>
    </div>
  </div>
</section>
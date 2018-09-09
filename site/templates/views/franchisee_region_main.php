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
    <div class="grid-x grid-padding-x small-up-2 medium-up-3">
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>This is a row of cards.</h4>
            <p>This row of cards is embedded in an X-Y Block Grid.</p>
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
            <h4>This is a card.</h4>
            <p>It has an easy to override visual style, and is appropriately subdued.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="grid-x grid-padding-x small-up-2 medium-up-3">
    <div class="cell">
      <div class="card">
        <img src="assets/img/generic/rectangle-1.jpg">
        <div class="card-section">
          <h4>This is a row of cards.</h4>
          <p>This row of cards is embedded in an Flex Block Grid.</p>
        </div>
      </div>
    </div>
    <div class="cell">
      <div class="card">
        <img src="assets/img/generic/rectangle-1.jpg">
        <div class="card-section">
          <h4>This is a card.</h4>
          <p>It has an easy to override visual style, and is appropriately subdued.</p>
        </div>
      </div>
    </div>
    <div class="cell">
      <div class="card">
        <img src="assets/img/generic/rectangle-1.jpg">
        <div class="card-section">
          <h4>This is a card.</h4>
          <p>It has an easy to override visual style, and is appropriately subdued.</p>
        </div>
      </div>
    </div>
</div>
</section>
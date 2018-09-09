<?php
// basic-page_main.php
?>
<section id="intro" style="background: url(<?=$config->urls->assets?>images/banner_bg.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-4 medium-9">

      </div>
      <div class="cell small-8 medium-3">
        <h3><?php echo $page->title; ?></h3>
        <img src="<?=$page->profile_image->url?>" alt="<?=$page->profile_image->description?>" />
        <h4><?=$page->franchisee_name?></h4>
        <p>Phone: <?=$page->franchisee_telno?></p>
        <p>Mobile: <?=$page->franchisee_mobno?></p>
        <p><a href="mailto:<?=$page->franchisee_email?>">Email: <?=$page->franchisee_email?></a></p>
        </div>
    </div>
  </div>
</section>
<?php
// basic-page_main.php
?>
<section id="intro" style="background: url(<?=$config->urls->assets?>images/banner_bg.jpg)">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-6 medium-4">
        <h3><?php echo $page->title; ?></h3>
        <img src="<?=$page->profile_image->url?>" alt="<?=$page->profile_image->description?>" />
        <?=$page->body?>
        </div>
    </div>
  </div>
</section>
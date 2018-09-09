<?php
// basic-page_main.php
?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell">
      <h3><?php echo $page->title; ?></h3>
      <img src="<?=$page->profile_image->url?>" />
      <?=$page->body?>
      </div>
  </div>
</div>
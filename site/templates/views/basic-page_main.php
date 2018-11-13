<?php
// basic-page_main.php
?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell">
      <h1><?=$page->title; ?></h1>
      <?php
      $image = $page->images->first();
      ?>
      <img src="<?=$images->url?>" />
      <?=$page->body?>
      </div>
  </div>
</div>
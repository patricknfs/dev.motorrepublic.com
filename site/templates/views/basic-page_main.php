<?php
// basic-page_main.php
?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell">
      <h1><?=$page->title; ?></h1>
      <img src="<?=$page->images->first()->size(600)?>" />
      <?=$page->body?>
      </div>
  </div>
</div>
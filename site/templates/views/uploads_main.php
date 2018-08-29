<?php
// basic-page_main.php
?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell">
      <h1><?php echo $page->title; ?></h1>
      <?php echo $forms->embed('specials_upload');?>
      </div>
  </div>
</div>
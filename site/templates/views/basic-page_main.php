<?php
// basic-page_main.php
?>
<section>
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell">
        <?php
        $image = $page->images->first();
        ?>
        <img class="floatright" src="<?=$image->url?>" />
        <h1><?=$page->title?></h1>
        <?=$page->body?>
        </div>
    </div>
  </div>
</section>
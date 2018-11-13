<?php
// whatwedo_main.php
$image = $page->images->first();
?>
<section id="whatwedo">
  <div class="grid-container full" style="background-image: url('<?=$image->url?>)">
  <h1><?=$page->title?></h1>  
  <?=$page->summary?>
  </div>
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell">
        <?=$page->body?>
        </div>
    </div>
  </div>
</section>
<?php
// whatwedo_main.php
$image = $page->images->first();
?>
<section id="whatwedo">
  <div class="grid-container full" style="background: url('<?=$image->url?>')  no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
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
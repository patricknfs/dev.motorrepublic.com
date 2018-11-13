<?php
// whatwedo_main.php
$image = $page->images->first();
?>
<section id="whatwedo">
  <div style="background: url('<?=$image->url?>')  no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="grid-container hero">
      <div class="grid-x hero">
        <div class="cell small-12 medium-6">
          <h1><?=$page->title?></h1>  
          <?=$page->summary?>
        </div>
        <div class="cell small-12 medium-6">
        
        </div>
      </div>
    </div>
</div>
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell">
        <?=$page->body?>
        </div>
    </div>
  </div>
</section>
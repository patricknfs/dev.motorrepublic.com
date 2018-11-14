<?php
// whatwedo_main.php
$image = $page->images->first();
?>
<section id="whatwedo">
  <div class="hero" style="background: url('<?=$image->url?>')  no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="grid-container">
      <div class="grid-x hero">
        <div class="cell small-12 medium-6">
          <div class="hero_overlay">
            <h1><?=$page->title?></h1>  
            <?=$page->summary?>
          </div>
        </div>
        <div class="cell small-12 medium-6">
        
        </div>
      </div>
    </div>
  </div>
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-12 medium-6">
        <?=$page->body?>
      </div>
      <div class="cell small-12 medium-6">
        <?=$page->body1?>
      </div>
      <div class="cell">
        <?=$page->body2?>
      </div>
    </div>
  </div>
</section>
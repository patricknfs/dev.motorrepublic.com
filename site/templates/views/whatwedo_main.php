<?php
// whatwedo_main.php
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
    <div class="grid-x grid-margin-x">
      <div class="cell small-12 medium-6">
        <?php
        $homepage = $pages->get(1006)
        if($page->id == 1159){
          echo $homepage->regional_strength;
        }
        else {
          echo $page->body;
        }
        ?>
      </div>
      <div class="cell small-12 medium-6">
        <?=$page->body3?>
      </div>
      <div class="cell">
        <?=$page->body?>
      </div>
    </div>
  </div>
</section>
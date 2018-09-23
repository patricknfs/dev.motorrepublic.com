<?php
// testimonials_main.php
?>
<div class="grid-container">
  <div class="grid-x">
    <div class="cell">
      <h1><?php echo $page->title; ?></h1>
      <?=$page->body?>
      <div class="sig">
        <?php
        $max_testimonials = 1;
        $testimonial = $pages->find("template=testimonial, sort=random, limit=$max");
        ?>
        <?=$testimonial->body?>
        <?=$testimonial->sig?>
      </div>
    </div>
  </div>
</div>
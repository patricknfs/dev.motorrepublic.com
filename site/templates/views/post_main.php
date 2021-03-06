<?php
// post_main.php template
?>
<section id="post">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-12 blog" itemscope itemtype="http://schema.org/BlogPosting">
        <h1 itemprop='name'><?=$page->title?></h1>
        <?php
        if($page->date){
          echo "<p><small>" . $page->date . "</small></p>";
        }
        ?>
        <div class="grid-x grid-margin-x">
          <div class="cell small-6">
            <img src="<?=$page->images->first()->url?>" />
          </div>
          <div class="cell small-6">
            <span itemprop='articleBody'><?=$page->body?></span>
          </div>
        </div>
      </div>
      <?php 
      if(count($page->images) > 1){
        foreach ($page->images as $id => $image) {
          ?>
          <div class="cell small-6 medium-4 blog_img">
            <img src="<?=$image->url?>" alt="<?=$image->description?>" title="<?=$image->description?>">
          </div>
          <?php
        }
      }
      ?>
      <hr />
      <div class="cell small-12">
        <?=$page->comments->renderForm(array('requireSecurityField' => 'security_field'))?>
        <?=$page->comments->render()?>
      </div>
    </div>
  </div>
</section>
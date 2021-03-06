<?php
//posts_main.php template
?>
<section id="posts">
  <div class="grid-container" itemscope itemtype="http://schema.org/Blog">
    <div class="grid-x small-12">
      <h1>The Latest News from <?=$page->parent->title?></h1>
    </div>
    <div class="grid-x small-12">
      <?php
      //$rev_articles = array_reverse( $articles );
      foreach ($articles as $article) { ?>
        <div class="article-item grid-container">
          <div class="grid-x">
            <div class="cell small-12 medium-4">
              <a href="<?=$article->url?>">
                <img src="<?=$article->images->first()->url?>" />
              </a>
            </div>
            <div class="cell small-12 medium-8" itemprop="blogPost">
              <a href="<?=$article->url?>">
                <h3 ><?= $article->title ?></h3>
              </a>
              <p><?=$article->summary?> <i><a href="<?=$article->url?>">read more...</a></i></p>
            </div>	
          </div>
        </div>
        <hr />
      <?php 
      }
      ?>
    </div>
  </div>
</section>
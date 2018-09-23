<?php
// basic-page_main.php
?>
<section id="intro" style="background: url(<?=$config->urls->assets?>images/banner_bg.jpg) no-repeat center center; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
  <div class="grid-container">
    <div class="grid-x">
      <div class="cell small-3 medium-9">

      </div>
      <div class="cell small-9 medium-3">
        <h3><?php echo $page->title; ?></h3>
        <img src="<?=$page->profile_image->url?>" alt="<?=$page->profile_image->description?>" />
        <h4><?=$page->franchisee_name?></h4>
        <p>Phone: <?=$page->franchisee_telno?></p>
        <p>Mobile: <?=$page->franchisee_mobno?></p>
        <p>Email: <a href="mailto:<?=$page->franchisee_email?>"><?=$page->franchisee_email?></a></p>
        </div>
    </div>
  </div>
</section>
<section id="content">
  <div class="grid-container">
    <div class="grid-x grid-padding-x small-up-2 medium-up-4">
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
      <div class="cell">
        <div class="card">
          <img src="assets/img/generic/rectangle-1.jpg">
          <div class="card-section">
          <h4>BMW 440D</h4>
            <p>This is a quick description.</p>
          </div>
          <div class="card-divider">
            £240/mth 15k 3+25 profile 
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="testimonial">
  <div class="grid-container">
    <div class="grid-x">
      <!-- slider code -->
      <div class="orbit testimonial-slider-container" role="region" aria-label="testimonial-slider" data-orbit>
        <ul class="orbit-container">
          <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
          <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
          <!-- content slide 1 -->
          <li class="is-active orbit-slide">
            <div class="testimonial-slide row">
              <div class="small-12 large-9 column">
                <div class="row align-middle testimonial-slide-content">
                  <div class="small-12 medium-4 column hide-for-small-only profile-pic">
                    <img src="https://placeimg.com/300/300/nature">
                  </div>
                  <div class="small-12 medium-8 column testimonial-slide-text">
                    <p class="testimonial-slide-quotation">Hide when guests come over instantly break out into full speed gallop across the house for no reason mrow touch water with paw then recoil in horror.</p>
                    <div class="testimonial-slide-author-container">
                      <div class="small-profile-pic show-for-small-only">
                        <img src="https://placeimg.com/50/50/nature">
                      </div>
                      <p class="testimonial-slide-author-info">Fleas Witherspoon<br><i class="subheader">Cat World Inc.</i></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!--content slide 2 -->
          <li class="orbit-slide">
            <div class="testimonial-slide row">
              <div class="small-12 large-9 column">
                <div class="row align-middle testimonial-slide-content">
                  <div class="small-12 medium-4 column hide-for-small-only profile-pic">
                    <img src="https://placeimg.com/300/300/architecture">
                  </div>
                  <div class="small-12 medium-8 column testimonial-slide-text">
                    <p class="testimonial-slide-quotation">Hide when guests come over instantly break out into full speed gallop across the house for no reason mrow touch water with paw then recoil in horror.</p>
                    <div class="testimonial-slide-author-container">
                      <div class="small-profile-pic show-for-small-only">
                        <img src="https://placeimg.com/50/50/architecture">
                      </div>
                      <p class="testimonial-slide-author-info">Fleas Witherspoon<br><i class="subheader">Cat World Inc.</i></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- content slide 3 -->
          <li class="orbit-slide">
            <div class="testimonial-slide row">
              <div class="small-12 large-9 column">
                <div class="row align-middle testimonial-slide-content">
                  <div class="small-12 medium-4 column hide-for-small-only profile-pic">
                    <img src="https://placeimg.com/300/300/animals">
                  </div>
                  <div class="small-12 medium-8 column testimonial-slide-text">
                    <p class="testimonial-slide-quotation">Hide when guests come over instantly break out into full speed gallop across the house for no reason mrow touch water with paw then recoil in horror.</p>
                    <div class="testimonial-slide-author-container">
                      <div class="small-profile-pic show-for-small-only">
                        <img src="https://placeimg.com/50/50/animals">
                      </div>
                      <p class="testimonial-slide-author-info">Fleas Witherspoon<br><i class="subheader">Cat World Inc.</i></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <!-- content slide 4 -->
          <li class="orbit-slide">
            <div class="testimonial-slide row">
              <div class="small-12 large-9 column">
                <div class="row align-middle testimonial-slide-content">
                  <div class="small-12 medium-4 column hide-for-small-only profile-pic">
                    <img src="https://placeimg.com/300/300/any">
                  </div>
                  <div class="small-12 medium-8 column testimonial-slide-text">
                    <p class="testimonial-slide-quotation">Hide when guests come over instantly break out into full speed gallop across the house for no reason mrow touch water with paw then recoil in horror.</p>
                    <div class="testimonial-slide-author-container">
                      <div class="small-profile-pic show-for-small-only">
                        <img src="https://placeimg.com/50/50/any">
                      </div>
                      <p class="testimonial-slide-author-info">Fleas Witherspoon<br><i class="subheader">Cat World Inc.</i></p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <!-- slider close -->
    </div>
  </div>
</section>
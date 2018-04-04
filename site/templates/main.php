<!-- main.php -->
<?php 
if($page->id == '2087'){
  header('Content-Type: application/pdf');
  header('Content-Disposition: inline; filename="xrp-catalogue.pdf"');
}
ERROR_REPORTING(E_ALL);
// if($input->get->theme) {
//  // set the theme
//  $session->theme = $sanitizer->pageName($input->get->theme); 
// }
// else {
//   $css = 'main.min.css'; 
// }
// setup defaults when none specified
if(empty($page->main)) $page->main = $page->body;
?>
<!DOCTYPE html>
<html lang="en">
  <head itemscope itemtype="http://schema.org/Thing">
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta itemprop="description" name="description" content="">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:title" content="">
    <meta name="twitter:description" content="">
    <title>
      <?php
      if ($page->get("title") == "Home") {
        echo "Motor Republic Vehicle Leasing";
      }
      else {
        echo $page->get("title");
      }
      ?>
    </title>
    <?php
    // if($session->theme == 'white') {
    //  $css = 'white.min.css';
    // }
    // elseif($session->theme == 'grey') {
    //  $css = 'main.min.css';
    // } else {
    //  $css = 'main.min.css'; 
    // }
    $css = 'main.min.css';
    ?>
    <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/<?=$css?>" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans:300|Open+Sans:400" />
    <!-- <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/main.min.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://i.icomoon.io/public/c88de6d4a5/DWSiteGenesis/style.css"> -->
  </head>
  <body <?php if($page->get("id") == 1){
    echo "id='home'"; 
  }
  ?> 
  >
   <header class="navigation" role="banner">
      <div class="navigation-wrapper">
        <div id="logoimg">
          <object data="<?=$config->urls->assets?>graphics/logo.svg" type="image/svg+xml">
            <img src="<?=$config->urls->assets?>graphics/logo.png" alt="Protec Fuel Pumps" title="Protec Fuel Pumps"/>
          </object>
        </div>
        <div class="menu-container">
          <div class="menu">
            <?php
            $treeMenu = $modules->get("MarkupSimpleNavigation"); // load the module
            $options = array(
              'parent_class' => '',
              'current_class' => '',
              'has_children_class' => '',
              'levels' => false,
              'levels_prefix' => 'level-',
              'max_levels' => null,
              'firstlast' => false,
              'collapsed' => false,
              'show_root' => true,
              'selector' => '',
              'outer_tpl' => '<ul id="" class="">||',
              'inner_tpl' => '<ul class="">||</ul>',
              'list_tpl' => '<li%s>||</li>||</li>',
              'list_field_class' => '',
              'item_tpl' => '<a href="{url}">{title}</a>',
              'item_current_tpl' => '<a href="{url}">{title}</a>',
              'xtemplates' => '',
              'xitem_tpl' => '<span>{title}</span>',
              'xitem_current_tpl' => '<span>{title}</span>'
            );
            echo $treeMenu->render($options);
            ?>
            <div class="navigation-tools">
            <div class="search-bar">
              <form action="<?=$config->urls->root?>search/" role="search">
                <input type="search" placeholder="Enter Search" name="q" />
                <button type="submit">
                  <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>
		<div class="wrapper">
      <?php
      if($page->id != 1){
        ?>
        <div class="breadcrumb">
          <?php
          // foreach($page->parents()->append($page) as $parent) {
          foreach($page->parents() as $parent) {
            echo "<a href='{$parent->url}'>{$parent->title}</a> ";
          }
          ?>
        </div>
        <?php
      }
      if($page->id == 1){
        ?>
        <div>
          <?php 
          if($page->main){
            echo $page->main;
          }
          if($page->client){
            echo $page->client;
          }
          ?>
        </div>
        <?php
      }
      else {
        ?>
        <article>
          <?php 
          if($page->main){
            echo $page->main;
          }
          if($page->client){
            echo $page->client;
          }
          ?>
        </article>
        <aside>
          <?php
          include('sidebar.php');
          if($sidebar){
            if ($page->id != 1) {
              echo $sidebar;
            }
          }
          ?>
        </aside>
        <?php
      }
      ?>
		</div>
    <footer class="footer" role="contentinfo">
      <div class="footer-logo">
        <object data="<?=$config->urls->assets?>graphics/logo_small.svg" type="image/svg+xml">
          <img src="<?=$config->urls->assets?>graphics/logo_small.png" alt="Protec Fuel Pumps" title="Protec Fuel Pumps"/>
        </object>
      </div>
      <div class="footer-links">
        <ul>
          <!-- Begin MailChimp Signup Form -->
          <div id="mc_embed_signup">
          <form action="//protecfuelpumps.us14.list-manage.com/subscribe/post?u=81d0d523bcd6b29cfd3be472b&amp;id=6bfe5a4b78" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
              <div id="mc_embed_signup_scroll">
            <h3>Subscribe to our newsletter</h3>
          <div class="indicates-required"><small><span class="asterisk">*</span> indicates required</small></div>
          <div class="mc-field-group">
            <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span></label>
            <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
          </div>
          <div class="mc-field-group">
            <label for="mce-FNAME">First Name <span class="asterisk">*</span></label>
            <input type="text" value="" name="FNAME" class="" id="mce-FNAME">
          </div>
          <div class="mc-field-group">
            <label for="mce-LNAME">Last Name <span class="asterisk">*</span></label>
            <input type="text" value="" name="LNAME" class="" id="mce-LNAME">
          </div>
            <div id="mce-responses" class="clear">
              <div class="response" id="mce-error-response" style="display:none"></div>
              <div class="response" id="mce-success-response" style="display:none"></div>
            </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
              <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_81d0d523bcd6b29cfd3be472b_6bfe5a4b78" tabindex="-1" value=""></div>
              <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
              </div>
          </form>
          </div>
          <!--End mc_embed_signup-->
        </ul>
        <ul>
          <li><h3>Content</h3></li>
          <li><a href="/about-us/">About Us</a></li>
          <li><a href="/all-products/">Products</a></li>
          <li><a href="/contact/">Contact</a></li>
          <li><a href="/privacy/">Privacy Policy</a></li>
          <li><h3>Follow Us</h3></li>
          <!-- <li><a href="javascript:void(0)">Facebook</a></li> -->
          <li><a href="https://twitter.com/protecfuelpumps">Twitter</a></li>
          <!-- <li><a href="javascript:void(0)">YouTube</a></li> -->
        </ul>
        <ul>
          <li>
            <div class="tw">
              <h3>Latest Tweets</h3>
              <?php
              $options = array(
                'limit' => 3, 
                'cacheSeconds' => 600, // 10 minutes
                'showDate' => 'before',
                'dateFormat' => 'F j g:i a - '
              ); 
              $t = $modules->get('MarkupTwitterFeed'); 
              echo $t->render($options);
              ?>
            </div>
          </li>
        </ul>
      </div>
      <hr>
      <div class="distribution_title">
        <p>Protec products are also available from these distributors</p>
      </div>
      <div class="distribution">
        <ul>
          <li><img src="<?=$config->urls->assets?>graphics/logo_premier.png"></li>
          <li><img src="<?=$config->urls->assets?>graphics/logo_asnu.png"></li>
          <li><img src="<?=$config->urls->assets?>graphics/logo_advanced.png"></li>
          <li><a href="http://www.isa-racing.com"><img src="<?=$config->urls->assets?>graphics/logo_isa-racing.png"></a></li>
          <li><a href="http://www.demon-tweeks.co.uk"><img src="<?=$config->urls->assets?>graphics/logo_demon-tweaks.png"></a></li>
        </ul>
      </div>
    </footer>
    
    <?php
    
    ?>
	</body>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
	<?php
  if ($page->id == 1074) {
    ?>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRbP0cMxwBeFZFe4WCGwzHWYz-w2sPIiA"></script>
    <script type="text/javascript">
      function initialize() {
      var map_canvas = document.getElementById('map_canvas');
      var myLatlng = new google.maps.LatLng(52.45135748,-2.04321563);
        var map_options = {
          center: myLatlng,
          zoom: 16,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
        var marker = new google.maps.Marker({
          position: myLatlng,
          map: map,
          title: 'Protec Fuel Pumps'
        });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <?php
  }
  ?>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-86844698-1', 'auto');
    ga('send', 'pageview');

  </script>
  <script type="text/javascript" src="<?=$config->urls->templates?>scripts/built.min.js"></script>
  <?php
  if($page->product_images){
  ?>
  <script type="text/javascript">
    $('#open-popup').magnificPopup({
      items: [
        <?php
        foreach ($page->product_images as $gallery_image) {
          echo "{src: '" . $gallery_image->height(600)->url . "'},";
        }
        ?>
      ],
      gallery: {
        enabled: true
      },
      type: 'image' // this is default type
    });
  </script>
  <?php
  }
  ?>
</html>
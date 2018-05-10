<!-- main.php -->
<?php 
ERROR_REPORTING(E_ALL);
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
        echo " Vehicle Leasing";
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
    $css = 'css/app.css';
    ?>
    <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/styles.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans:300|Open+Sans:400" />
    <!-- <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/main.min.css" /> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://i.icomoon.io/public/c88de6d4a5/DWSiteGenesis/style.css"> -->
  </head>
  <body>
   <header class="navigation" role="banner">
      <div class="navigation-wrapper">
        <div id="logoimg">
          <object data="<?=$config->urls->assets?>graphics/logo.svg" type="image/svg+xml">
            <img src="<?=$config->urls->assets?>graphics/logo.png" alt="Motor Republic" title="Motor Republic"/>
          </object>
        </div>
        <nav class="uk-navbar uk-navbar-container" uk-navbar>
          <div class="uk-navbar-left">
            <?php
            $treeMenu = $modules->get("MarkupSimpleNavigation"); // load the module
            $options = array(
              'parent_class' => '',
              'current_class' => '',
              'has_children_class' => 'uk-parent',
              'levels' => false,
              'levels_prefix' => 'level-',
              'max_levels' => null,
              'firstlast' => false,
              'collapsed' => false,
              'show_root' => true,
              'selector' => '',
              'outer_tpl' => '<ul id="" class="uk-navbar-nav">||',
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
          </nav>
        </div>
      </div>
    </header>
		<div class="wrapper">
        <?=$page->main?>
		</div>
    <footer class="footer" role="contentinfo">
      <div class="footer-logo">
        <object data="<?=$config->urls->assets?>graphics/logo_small.svg" type="image/svg+xml">
          <img src="<?=$config->urls->assets?>graphics/logo_small.png" alt="Motor Republic" title="Motor Republic"/>
        </object>
      </div>
      <div class="footer-links">
        <ul>
          <!-- Begin MailChimp Signup Form -->
          <div id="mc_embed_signup">
          
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
          <li><a href="#">Twitter</a></li>
          <!-- <li><a href="javascript:void(0)">YouTube</a></li> -->
        </ul>
        <ul>
          <li>

          </li>
        </ul>
      </div>
      <hr>
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
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-86844698-1', 'auto');
    ga('send', 'pageview');

  </script>
  <script type="text/javascript" src="<?=$config->urls->templates?>/js/foundation.min.js"></script>
</html>
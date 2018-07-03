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
    <footer>

    </footer>
    
    <?php
    
    ?>
	</body>
</html>
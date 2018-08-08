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
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/styles.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans:300|Open+Sans:400" />
  </head>
  <body>
    <div class="slide-menu">
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
      <!--<div class="navigation-tools">
        <div class="search-bar">
          <form action="<?=$config->urls->root?>search/" role="search">
            <input type="search" placeholder="Enter Search" name="q" />
            <button type="submit">
              <img src="https://raw.githubusercontent.com/thoughtbot/refills/master/source/images/search-icon.png" alt="Search Icon">
            </button>
          </form>
        </div>
      </div> -->
    </div>
    <div class="page-wrap">

          <div for="toggle" class="handle"></div>

          <div class="content">

            <!-- <h1>Mobile Slide-In Menu</h1>
          
            <p>SASS-built off-canvas menu</p>
            <p>...</p>
            <p>...</p>
            <p>...</p>
            <p>...</p>
            <p>...</p> -->
          </div>
        </div>
    <header class="navigation" role="banner">
      <div class="navigation-wrapper">
        <div id="logoimg">
          <a class="svg" href="/">
            <object data="<?=$config->urls->assets?>graphics/logo.svg" type="image/svg+xml">
              <img src="<?=$config->urls->assets?>graphics/logo.png" alt="Motor Republic Vehicle Leasing" title="Motor Republic Vehicle Leasing"/>
            </object>
          </a>
        </div>

        <div class="page-wrap">

          <div for="toggle" class="handle"></div>

          <div class="content">

            <!-- <h1>Mobile Slide-In Menu</h1>
          
            <p>SASS-built off-canvas menu</p>
            <p>...</p>
            <p>...</p>
            <p>...</p>
            <p>...</p>
            <p>...</p> -->
          </div>
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
  <script type="text/javascript">
    $('.handle').click(function() {
      $('body').toggleClass('slide');
    });
  </script>
</html>
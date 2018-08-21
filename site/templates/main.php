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
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/css/app.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans:300|Open+Sans:400" />
  </head>
  <body>
    <header>
      <div>
      <div id="logoimg">
        <img src="<?=$config->urls->assets?>/graphics/logo.svg" alt="Logo" />
      </div> 
      </div>
      <nav role="navigation">
        <div class="title-bar" data-responsive-toggle="example-animated-menu" data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle></button>
          <div class="title-bar-title">Menu</div>
        </div>
        <div class="top-bar" id="example-animated-menu" data-animate="hinge-in-from-top spin-out">
           
          <div class="top-bar-left">
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
              'show_root' => false,
              'selector' => '',
              'outer_tpl' => '<ul id="" class="dropdown menu" data-dropdown-menu>||',
              'inner_tpl' => '<ul class="menu vertical">||</ul>',
              'list_tpl' => '<li%s>||</li>||</li>',
              'list_field_class' => 'menu-text',
              'item_tpl' => '<a class="header__nav__item__link" href="{url}">{title}</a>',
              'item_current_tpl' => '<a href="{url}">{title}</a>',
              'xtemplates' => '',
              'xitem_tpl' => '<span>{title}</span>',
              'xitem_current_tpl' => '<span>{title}</span>'
            );
            echo $treeMenu->render($options);
            ?>
          </div>
          <div class="top-bar-right">
            <ul class="menu">
              <li><input type="search" placeholder="Search"></li>
              <li><button type="button" class="button">Search</button></li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- <div class="top-bar" id="example-animated-menu" data-animate="hinge-in-from-top spin-out">
        <div class="top-bar-left">
          <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">Site Title</li>
            <li>
              <a href="#">One</a>
              <ul class="menu vertical">
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
              </ul>
            </li>
            <li><a href="#">Two</a></li>
            <li><a href="#">Three</a></li>
          </ul>
        </div>
      </div> -->
    </header>

    <div class="content">
      <?php
      if($page->main){
        echo $page->main;
      }
      ?>
    </div>
    <footer>
      <p>Test</p>
    </footer>
  </body>
  <script type="text/javascript" src="<?=$config->urls->templates?>styles/js/foundation.min.js" ></script>
  <script type="text/javascript" src="<?=$config->urls->templates?>styles/js/app.js" ></script>
</html>
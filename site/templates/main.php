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

    <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/styles.min.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans:300|Open+Sans:400" />
  </head>
  <body>
    <header>
      <div class="header_logo">
        <img src="<?=$config->urls->assets?>/graphics/logo.svg" alt="Logo" />
      </div>
      <nav role="navigation">
        <a href="javascript:void(0);" class="ic menu">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </a>
      <a href="javascript:void(0);" class="ic close"></a>
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
          'outer_tpl' => '<ul id="" class="header__nav__list">||',
          'inner_tpl' => '<ul class="">||</ul>',
          'list_tpl' => '<li%s>||</li>||</li>',
          'list_field_class' => 'header__nav__item',
          'item_tpl' => '<a class="header__nav__item__link" href="{url}">{title}</a>',
          'item_current_tpl' => '<a href="{url}">{title}</a>',
          'xtemplates' => '',
          'xitem_tpl' => '<span>{title}</span>',
          'xitem_current_tpl' => '<span>{title}</span>'
        );
        echo $treeMenu->render($options);
        ?>
      </nav>
      <nav role="navigation">
    <a href="javascript:void(0);" class="ic menu">
      <span class="line"></span>
      <span class="line"></span>
      <span class="line"></span>
    </a>
    <a href="javascript:void(0);" class="ic close"></a>
    <ul class="main-nav">
      <li class="top-level-link">
        <a><span>Home</span></a>      
      </li> 
      
      <li class="top-level-link">
        <a class="mega-menu"><span>Products</span></a>
        <div class="sub-menu-block">
          <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4">
              <h2 class="sub-menu-head">Clothing</h2>
              <ul class="sub-menu-lists">
                <li><a>Mens</a></li>
                <li><a>Womens</a></li>
                <li><a>Kids</a></li>
                <li><a>New Born</a></li>
                <li><a>View All</a></li>
              </ul>           
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
              <h2 class="sub-menu-head">Handbags</h2>
              <ul class="sub-menu-lists">
                <li><a>Wallets</a></li>
                <li><a>Athletic bag</a></li>
                <li><a>Backpack</a></li>
                <li><a>Bucket Bag</a></li>
                <li><a>View All</a></li>
              </ul>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
              <h2 class="sub-menu-head">Shoes</h2>
              <ul class="sub-menu-lists">
                <li><a>Mens</a></li>
                <li><a>Womens</a></li>
                <li><a>Kids</a></li>
                <li><a>View All</a></li>
              </ul>
            </div>
          </div>
          
          <div class="row banners-area">
            <div class="col-md-6 col-lg-6 col-sm-6">
              <img src="http://devitems.com/tf/teemo-preview/teemo/img/banner/banner-menu1.jpg" width="100%;">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6">
              <img src="http://devitems.com/tf/teemo-preview/teemo/img/banner/banner-menu1.jpg" width="100%;">
            </div>
          </div>
          
        </div>
      </li>
      <li class="top-level-link">
        <a><span>Services<span></a>    
      </li>
      <li class="top-level-link">
        <a class="mega-menu"><span>About</span></a>
        <div class="sub-menu-block">
          <div class="row">
            <div class="col-md-4 col-lg-4 col-sm-4">
              <h2 class="sub-menu-head">Company</h2>
              <ul class="sub-menu-lists">
                <li><a>About</a></li>
                <li><a>Mission</a></li>
                <li><a>Community</a></li>
                <li><a>Team</a></li>
              </ul>           
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
              <h2 class="sub-menu-head">Media</h2>
              <ul class="sub-menu-lists">
                <li><a>News</a></li>
                <li><a>Events</a></li>
                <li><a>Blog</a></li>
              </ul>
            </div>
            <div class="col-md-4 col-lg-4 col-sm-4">
              <h2 class="sub-menu-head">Careers</h2>
              <ul class="sub-menu-lists">
                <li><a>New Opportunities</a></li>
                <li><a>Life @ Company</a></li>
                <li><a>Why Join Us?</a></li>
              </ul>
            </div>
          </div>
          
          <div class="row banners-area">
            <div class="col-md-6 col-lg-6 col-sm-6">
              <img src="http://devitems.com/tf/teemo-preview/teemo/img/banner/banner-menu1.jpg" width="100%;">
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6">
              <img src="http://devitems.com/tf/teemo-preview/teemo/img/banner/banner-menu1.jpg" width="100%;">
            </div>
          </div>
          
        </div>
      </li>
      <li class="top-level-link">
        <a><span>Contact</span></a>      
      </li>
    </ul> 
  </nav>
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
  <script type="text/javascript" src="<?=$config->urls->templates?>/scripts/built.min.js"></script>
</html>
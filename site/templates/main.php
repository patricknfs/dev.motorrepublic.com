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
    <div class="container">
      <div class="headnav">
        <header class="header">
          <div class="header__logo">
            <img src="<?=$config->urls->assets?>/graphics/logo.svg" alt="Logo" />
          </div>
          <nav class="header__nav" role="navigation">
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
            <div class="header__nav__search js-nav-search">
              <form action="#" class="header__nav__search__form">
                <input type="search" placeholder="Search" class="header__nav__search__form__text" autofocus/>
                <input type="submit" class="header__nav__search__form__submit" value="Rechercher"/>
              </form>
              <button class="header__nav__search__close js-nav-search-close"></button>
            </div>
          </nav>
          
          <button href="#" class="nav-toggle js-nav-toggle" title="navigation menu" aria-label="navigation menu" role="button" aria-controls="navigation" aria-expanded="false">
            <div class="nav-toggle__content">
              <div class="nav-toggle__close"></div>
              <div class="nav-toggle__open">menu</div>
            </div>
          </button>
          
        </header>
        
        <nav class="nav js-nav" role="first navigation">
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
            'outer_tpl' => '<ul id="" class="nav__list">||',
            'inner_tpl' => '<ul class="">||</ul>',
            'list_tpl' => '<li%s>||</li>||</li>',
            'list_field_class' => 'nav__item',
            'item_tpl' => '<a class="nav__item__wrapper" href="{url}">{title}</a>',
            'item_current_tpl' => '<a href="{url}">{title}</a>',
            'xtemplates' => '',
            'xitem_tpl' => '<span>{title}</span>',
            'xitem_current_tpl' => '<span>{title}</span>'
          );
          echo $treeMenu->render($options);
          ?>
        </nav>
        <nav class="nav--right js-second-nav">
          <p class="nav--right__content">I display the content of <span class="nav--right__content__child-name"></span></p>
        </nav>
        
      </div>
      
      <div class="content">
        <h3>Resize the viewport :)</h3>
      </div>
      
    </div>
	</body>
  <script type="text/javascript" src="<?=$config->templates?>/scripts/built.min.js"></script>
</html>
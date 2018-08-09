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
            <img src="https://psmedia.playstation.com/is/image/psmedia/footerpslogo-nhasset?$Footer_Links_Row_Logo$" alt="Logo" />
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
              'show_root' => true,
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
          <ul class="nav__list">
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-ps4-01-eu-15dec15?$Icon$"/>
                </span>
                PS4
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-games-01-eu-15dec15?$Icon$"/>
                </span>
                Jeux
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-psplus-01-eu-15dec15?$Icon$"/>
                </span>
                Playstation Plus
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-news-01-eu-15dec15?$Icon$"/>
                </span>
                News
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-ps-store-01-eu-15dec15?$Icon$"/>
                </span>
                PS Store
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-help-01-eu-15dec15?$Icon$"/>
                </span>
                Aide
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://www.playstation.com/fr-fr/1.22.03/etc/designs/pdc/clientlibs_base/images/main-header/primarynav_icon_account.png"/>
                </span>
                Connexion
              </a>  
            </li>
            <li class="nav__item">
              <a href="#" class="nav__item__wrapper">
                <span class="nav__item__icon">
                  <img src="https://psmedia.playstation.com/is/image/psmedia/meganav-icon-mobile-sitemap-01-eu-15dec15?$Icon$"/>
                </span>
                Plan du site
              </a>  
            </li>
          </ul>
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
  <script type="text/javascript">
    var FirstCurtainMenu = {
      $el: $('.js-nav'),
      $elToggle: $('.js-nav-toggle'),
      $elSecondCurtain: $('.js-second-nav'),
      $elChildren: $('.nav__item__wrapper'),
      isOpened: false,
      
      events: function() {
        var self = this;
        this.$elToggle.on('click', function() {
          if (self.isOpened) {
            self.close();
          } else {
            self.open();
          }
        });
        $(document).on('click', function(e) {
          if (self.isOpened) {
            var is_menu = $(e.target).closest(self.$el).length;
            var is_toggle = $(e.target).closest(self.$elToggle).length;
            var is_secondCurtain = $(e.target).closest(self.$elSecondCurtain).length;
            if(!is_menu && !is_toggle && !is_secondCurtain) {
              self.close();
            }
          }
        });
      },
      open: function() {
        this.$el.addClass('is-open');
        this.$elToggle.addClass('is-active');
        this.isOpened = true;
      },
      close: function() {
        this.$el.removeClass('is-open');
        this.$elToggle.removeClass('is-active');
        this.$elChildren.removeClass('is-selected');
        this.isOpened = false;
      },
      init: function() {
      this.events();
      }
    };

    var SecondCurtainMenu = {
      $el: $('.js-second-nav'),
      $elToggle: $('.nav__item__wrapper'),
      isOpened: false,
      
      events: function() {
        var self = this;
        this.$elToggle.on('click', function(e) {
          if (self.isOpened) {
            self.updateContent(e);
          } else {
            self.open(e);
            self.updateContent(e);
          }
        });
        // Close both curtains when user clicks on the header toggle
        $('.js-nav-toggle').on('click', function() {
          if (self.isOpened) {
            self.close();
            self.isOpened = false;
          }
        });
      },
      open: function(e) {
        this.$el.addClass('is-open');
        $(e.target).addClass('is-selected');
        this.isOpened = true;
      },
      close: function() {
        this.$el.removeClass('is-open');
        this.isOpened = false;
      },
      updateContent: function(e) {
        this.$elToggle.removeClass('is-selected');
        $(e.target).addClass('is-selected');
        $('.nav--right__content__child-name').text($(e.target).text());
      },
      init: function() {
      this.events();
      }
    };

    var SearchBar = {
      $el: $('.js-nav-search'),
      $elToggleOpen: $('.js-nav-search-open'),
      $elToggleClose: $('.js-nav-search-close'),
      isOpened: false,
      
      events: function() {
        var self = this;
        this.$elToggleOpen.on('click', function() {
          if (!self.isOpened) { self.open(); }
        });
        this.$elToggleClose.on('click', function() {
          if (self.isOpened) { self.close(); }
        });
      },
      open: function() {
        this.$el.addClass('is-active');
        this.isOpened = true;
      },
      close: function() {
        this.$el.removeClass('is-active');
        this.isOpened = false;
      },
      init: function() {
      this.events();
      }
    };

    FirstCurtainMenu.init();
    SecondCurtainMenu.init();
    SearchBar.init();
  </script>
</html>
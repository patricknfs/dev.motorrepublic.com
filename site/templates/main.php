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
  <body  data-sticky-container>
    <header data-sticky data-margin-top="0">
      <div id="primenav" class="grid-x">
        <small>cars</small> | <small>vans & lcv's</small>
      </div>
      <div id="logorow" class="grid-x align-justify">
        <div class="cell small-12 medium-3" id="logoimg">
          <a href="/"><img src="<?=$config->urls->assets?>graphics/logo.svg" alt="Logo" /></a>
        </div>
        <div class="cell small-12 medium-3"id="header_tel">
          <h3>Call: 0121 45 45 645</h3>
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
              'item_tpl' => '<a class="nav_link" href="{url}">{title}</a>',
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
    </header>
      <?php
      if($page->main){
        echo $page->main;
      }
      ?>
    <footer>
      <div class="grid-container">
        <div class="grid-x">
          <div class="cell small-6 medium-4">
          <ul><h3>Talk To Us</h3>
            <li>T: 0121 794 9073</li>
            <li>E: sales@motorrepublic.com</li>
          </ul>
          </div>
          <div class="cell small-6 medium-4">
            <ul><h3>Where We Are</h3>
              <li>Motor Republic</li>
              <li>5 The Croft</li>
              <li>Buntsford Drive</li>
              <li>Bromsgrove</li>
              <li>B60 4JE</li>
            </ul>
          </div>
          <div class="cell small-6 medium-4">
          </div>
        </div>
      </div>
      <section id="governance">
        <div class="grid-container">
          <div class="grid-x grid-margin-x">
            <div class="cell small-12 medium-5">
              <p>Motor Republic is a trading style of National Fleet Services Limited.</p>
              <p>Motor Republic are a credit broker and not a lender, we are authorised and regulated by the Financial Conduct Authority. Registered No : 680691</p>
              <p>Registered in England & Wales with company number : 03247145 | Data Protection No : Z5088418 | VAT No : 695548379 | BVRLA Registration Number : 1463</p>
              <p>Registered Office : 5 The Croft, Buntsford Drive, Bromsgrove, B60 4JE</p>
              <p>Copyright &copy; <?php echo date("Y"); ?> Motor Republic, All rights reserved.</div>
            <div class="cell small-12 medium-5">
              <p>All offers are subject to change at any time, you must be 18 or over and finance is subject to status. Vehicle availability and terms and conditions apply.</p>
              <p>We can introduce you to a limited number of finance companies and a commission may be received.</p>
              <p>Failure to maintain payments may result in termination of your agreement and the vehicle being returned, this could affect your credit rating and make it more difficult to obtain credit in the future.</p>
              <p>All prices correct at time of publication.</p>
              <p>All vehicle images and car descriptions on this site are for illustration and reference purposes only and are not necessarily an accurate representation of the vehicle on offer.</p>
              <p>VAT at 20% may be payable.</p>
              <p>You should try and estimate the distance you will travel as accurately as possible to try and avoid excess mileage charges at the end of your contract.</p>
              <p>Only regulated business will fall under the jurisdiction of the Financial Conduct Authority.</p>
            </div>
            <div class="cell small-12 medium-2">
              <img  class="float-center" src="<?=$config->urls->assets?>graphics/bvrla-white.png" />
            </div>
          </div>
        </div>
    </section>
    </footer>
  </body>
  <script type="text/javascript" src="<?=$config->urls->templates?>styles/js/foundation.min.js" ></script>
  <script type="text/javascript" src="<?=$config->urls->templates?>styles/js/app.js" ></script>
  <!-- Start of Async Drift Code -->
  <script>
    "use strict";

    !function() {
      var t = window.driftt = window.drift = window.driftt || [];
      if (!t.init) {
        if (t.invoked) return void (window.console && console.error && console.error("Drift snippet included twice."));
        t.invoked = !0, t.methods = [ "identify", "config", "track", "reset", "debug", "show", "ping", "page", "hide", "off", "on" ], 
        t.factory = function(e) {
          return function() {
            var n = Array.prototype.slice.call(arguments);
            return n.unshift(e), t.push(n), t;
          };
        }, t.methods.forEach(function(e) {
          t[e] = t.factory(e);
        }), t.load = function(t) {
          var e = 3e5, n = Math.ceil(new Date() / e) * e, o = document.createElement("script");
          o.type = "text/javascript", o.async = !0, o.crossorigin = "anonymous", o.src = "https://js.driftt.com/include/" + n + "/" + t + ".js";
          var i = document.getElementsByTagName("script")[0];
          i.parentNode.insertBefore(o, i);
        };
      }
    }();
    drift.SNIPPET_VERSION = '0.3.1';
    drift.load('zr8i59c3d6dv');
  </script>
  <!-- End of Async Drift Code -->
  </html>
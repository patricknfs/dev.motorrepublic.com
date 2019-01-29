<!-- main.php -->
<?php 
ERROR_REPORTING(E_ALL);
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
if($page->id !== 1043){
  include "power_search.php";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head itemscope itemtype="http://schema.org/Thing">
    <meta charset="UTF-8" /> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="" />
    <meta name="twitter:title" content="
      <?php
      if ($page->get("title") == "Home") {
        echo " Vehicle Leasing";
      }
      elseif($page->template->name == 'vehicle'){
        echo "Great Lease Deal for the " . $_GET['manufacturer']  . " " . $model . " - " . $input->urlSegment();
      }
      else {
        echo $page->get("title");
      }
      ?>
    ">
    <meta name="twitter:description" content="
      <?php
      if ($page->get("title") == "Home") {
        echo "Motor Republic Vehicle Leasing";
      }
      elseif($page->template->name == 'vehicle'){
        echo "Great Lease Deals for the " . $_GET['manufacturer']  . " " . $model . " - " . $input->urlSegment();
      }
      else {
        echo $page->get("title");
      }
      ?>
    ">
    <title>
      <?php
      if ($page->get("title") == "Home") {
        echo " Vehicle Leasing";
      }
      elseif($page->template->name == 'vehicle'){
        echo "Great Lease Deals for the " . $_GET['manufacturer']  . " " . $model . " - " . $input->urlSegment();
      }
      else {
        echo $page->get("title");
      }
      ?>
    </title>
    <meta itemprop="description"  name="description" content="
      <?php
      if ($page->get("title") == "Home") {
        echo "Motor Rep Vehicle Leasing";
      }
      elseif($page->template->name == 'vehicle'){
        echo "Motor Republic Provide Great Lease Deals for the " . $_GET['manufacturer']  . " " . $model . " - " . $input->urlSegment();
      }
      else {
        echo $page->get("title");
      }
      ?>"
    />
    <script>
      window['_fs_debug'] = false;
      window['_fs_host'] = 'fullstory.com';
      window['_fs_org'] = 'CPW9F';
      window['_fs_namespace'] = 'FS';
      (function(m,n,e,t,l,o,g,y){
          if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
          g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[];
          o=n.createElement(t);o.async=1;o.src='https://'+_fs_host+'/s/fs.js';
          y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
          g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)};
          g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
          g.consent=function(a){g("consent",!arguments.length||a)};
          g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
          g.clearUserCookie=function(){};
      })(window,document,window['_fs_namespace'],'script','user');
    </script>
    <script
      src="https://code.jquery.com/jquery-3.3.1.min.js"
      integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
      crossorigin="anonymous">
    </script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-81524203-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-81524203-1');
    </script>
    <link rel="alternate" href="https://motorrepublic.com" hreflang="en-gb" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/zf/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/sc-1.5.0/sl-1.2.6/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/zf/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/b-print-1.5.2/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.4.0/r-2.2.2/sc-1.5.0/sl-1.2.6/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script type="text/javascript" src="<?=$config->urls->templates?>scripts/megamenu.js" ></script>
    <link href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?=$config->urls->templates?>styles/css/app.css" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Fira+Sans:300|Open+Sans:400" />
    <link rel='stylesheet' type='text/css' href='<?=$config->urls->FieldtypeComments?>comments.css' />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>
  <body  data-sticky-container>
    <div class="sharethis-inline-share-buttons"></div>
    <header data-sticky data-margin-top="0">
      <!-- <div id="primenav" class="grid-x">
        <div class="cell small-12 medium-6">
          <ul>
            <li>new cars</li>
            <li>vans & lcv's</li>
        </div>
        <div class="cell small-12 medium-6 .align-right">
        </div>
        
      </div> -->  
      <div id="logorow" class="grid-x align-justify">
        <div class="cell small-12 medium-3" id="logoimg">
          <a href="/"><img src="<?=$config->urls->assets?>graphics/logo.svg" alt="Logo" /></a>
        </div>
        <div class="cell small-12 medium-3" id="header_tel">
          <h2>Call: 0121 794 9073</h2>
        </div>
      </div>
      <section id="menurow">
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
      </div>
      </section>
      <div class="searchbar">
        <?php
        if($page->id !== 1043){
          ?>
          <div class="grid-container"><?=$form_out?></div>
          <?php
        }
        ?>
      </div>
     
    </header>
      <?php
      if($page->main){
        echo $page->main;
      }
      ?>
    <footer>
      <div class="grid-container">
        <div class="grid-x">
          <div class="cell small-12 medium-4">
            <ul>
              <h3>Talk To Us</h3>
              <li class="tel">T: <a href="tel:01217949073">0121 794 9073</a></li>
              <li>E: sales@motorrepublic.com</li>
            </ul>
          </div>
          <div class="cell small-12 medium-4">
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
              <p>Only regulated business will fall under the jurisdiction of the Financial Conduct Authority.</p>
              <p>VAT at 20% may be payable.</p>
              <p><strong>You should try and estimate the distance you will travel as accurately as possible to try and avoid excess mileage charges at the end of your contract.</strong></p>
            </div>
            <div class="cell small-12 medium-2">
              <img  class="float-center" src="<?=$config->urls->assets?>graphics/bvrla-white.png" />
              <div id="footer_compliance">
                <h4>Documents</h4>
                <p><a href="/info/treating-customer-fairly/">Treating Customers Fairly</a></p>
                <p><a href="/info/privacy/">Privacy Policy</a></p>
                <p><a href="/info/complaints-procedure/">Complaints Procedure</a></p>
                <p><a href="/info/terms-conditions/">Terms & Conditions</a></p>
                <p><a href="/info/information/">Information</a></p>
                <p><a href="/info/initial-disclosure/">Initial Disclosure</a></p>
                <p><a href="/info/commission-disclosure/">Commission Disclosure</a></p>
              </div>
            </div>
          </div>
        </div>
    </section>
    </footer>
    <?php
    if($page->id !== 1043){
      ?>
      <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5c0241f50624ce0011ee8859&product=inline-share-buttons' async='async'></script>
      <?php
    }
    ?>
  </body>
  <script type="text/javascript" src="<?=$config->urls->templates?>styles/js/foundation.min.js" ></script>
  <script type="text/javascript" src="<?=$config->urls->templates?>styles/js/app.js" ></script>
  <?php
  if($page->id !== 1043){
    ?>
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
    <?php
    }
  ?>
  <script>
      function populate(s1,s2){
        var s1 = document.getElementById(s1);
        var s2 = document.getElementById(s2);
        s2.innerHTML = "";
        if(s1.value == "Choose Manufacturer First"){
          var optionArray = ["|"];
        }
        <?php
        $query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          echo "else if(s1.value == '" . $row['manufacturer'] . "'){
            var optionArray = ['|',";
            $query2 = "SELECT DISTINCT(`model`) FROM `team`.`vehicles` WHERE `manufacturer` = '" . $row['manufacturer'] . "' ORDER BY `model` ASC";
            // echo $query2;
            $result2 = mysqli_query($conn, $query2);
            while ($row2 = mysqli_fetch_array($result2)) {
              echo "'" . $row2['model'] . "|" . $row2['model'] . "',";
            }
          echo "]}";
        }
        ?> 
        for(var option in optionArray){
          var pair = optionArray[option].split("|");
          var newOption = document.createElement("option");
          newOption.value = pair[0];
          newOption.innerHTML = pair[1];
          s2.options.add(newOption);
        }
      }
    </script>
</html>
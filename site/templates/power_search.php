<?php
// power_search.php
date_default_timezone_set('CET');

// manufacturer query
$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`rates_combined_terse` WHERE `special` = 1 ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

$man = array();

while ($row = mysqli_fetch_assoc($result)) {
  $manu = (stripos($row['manufacturer'], 'mercedes' ) === TRUE?"MERCEDES":$row['manufacturer']);
  array_push($man, $manu);
}
$selector = "template=vehicles";
ob_start();
?>
<form action="<?=$pages->get($selector)->url;?>" method="POST">
  <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-2">
      
    </div>
    <div class="cell small-12 medium-3">
      <select id="slct1" name="slct1" onchange="populate(this.id,'slct2')">
        <option value="">Manufacturer</option>
        <?php
        foreach ($man as $manufacturer) {
          ?>
          <option value="<?=$manufacturer?>"><?=$manufacturer?></option>
          <?php
        }
        ?>
      </select>
    </div>
    <div class="cell small-12 medium-3">
      <select id="slct2" name="slct2">>Model (choose manufacturer first)</select>
    </div>
    <div class="cell small-12 medium-4">
      <input type="submit" class="button" value="Find Your Deal">
    </div>
  </form>
</div>
<?php
$form_out = ob_get_clean();
?>
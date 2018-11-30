<?php
// power_search.php
date_default_timezone_set('CET');

// manufacturer query
$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

$man = array();


while ($row = mysqli_fetch_assoc($result)) {
  array_push($man, $row['manufacturer']);
}

  //  model query
  // $query2 = "SELECT DISTINCT(`model`) FROM `team`.`vehicles` WHERE `manufacturer` = '" . $row['manufacturer'] . "' ORDER BY `model` ASC";
  // $result2 = mysqli_query($conn, $query2);
  // $models = array();
  // while ($row = mysqli_fetch_array($result2)) {
  //   array_push($models, $row['model']);
  // }
  

  $models = array('200|200','300|300','400|400');
  print_r($models);
ob_start();
?>
<form>
  <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-4">
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
    <div class="cell small-12 medium-4">
      <select id="slct2" name="slct2">>Model (choose manufacturer first)</select>
    </div>
    <div class="cell small-12 medium-4">
      <input type="submit" class="button" value="Find Your Deal">
    </div>
  </form>
</div>
<?php
$out = ob_get_clean();
?>
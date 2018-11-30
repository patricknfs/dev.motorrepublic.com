<?php
// manufacturer.php
date_default_timezone_set('CET');

// first query

$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

$man = array();
$man2 = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push($man, $row['manufacturer']);
}

while ($row2 = mysqli_fetch_assoc($result)) {
  array_push($man2, $row2['manufacturer'] . "|" . $row2['manufacturer']);
}

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
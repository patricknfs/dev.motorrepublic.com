<?php
// manufacturer.php
date_default_timezone_set('CET');
// require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
// require_once MR_PATH . '/inc/conn.php';

// first query

$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

$man = array();

while ($row = mysqli_fetch_assoc($result)) {
  array_push($man, $row['manufacturer']);
}


// $wire->wire('manufs', $man);

// $mans = $this->wire('manufs');
// print_r($mans);
// echo '<pre>'; print_r($man); echo '</pre>';
ob_start();
?>
<form>
  <div class="grid-x grid-margin-x">
    <div class="cell small-12 medium-4">
      <select placeholder="manufacturer" id="first-choice">
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
      <select placeholder="model" id="second-choice">
        <option>Model (choose manufacturer first)</option>
        <script type="text/javascript">
          $("#first-choice").change(function() {
            $("#second-choice").load("getter.php?choice=" + $(" #first-choice").val());
          });
        </script>
      </select>
    </div>
    <div class="cell small-12 medium-4">
      <input type="submit" class="button" value="Find Your Deal">
    </div>
  </form>
</div>
<?php
$out = ob_get_clean();
?>
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

// second query

$choice = mysqli_real_escape_string($_GET['choice']);
	
$query2 = "SELECT DISTINCT(`model`) FROM `team`.`vehicles` WHERE `model` = " . $choice . " ORDER BY `model` ASC";
$result2 = mysqli_query($conn, $query2);
  
while ($row = mysqli_fetch_array($result2)) {
    echo "<option>" . $row{'model'} . "</option>";
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
      <select placeholder="manufacturer" id="first_choice">
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
      <script type="text/javascript">
        $("#first-choice").change(function() {
          $("#second-choice").load("power_search.php?choice=" + $("#first-choice").val());
        });
      </script>
    </div>
    <div class="cell small-12 medium-4">
      <input type="submit" class="button" value="Find Your Deal">
    </div>
  </form>
</div>
<?php
$out = ob_get_clean();
?>
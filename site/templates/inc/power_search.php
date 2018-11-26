<?php
// manufacturer.php
date_default_timezone_set('CET');
// require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
// require_once MR_PATH . '/inc/conn.php';

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
  <div class="grid-x">
    <div class="cell small-12 medium-4">
      <select placeholder="manufacturer"></select>
    </div>
    <div class="cell small-12 medium-4">
      <select placeholder="model"></select>
    </div>
    <div class="cell small-12 medium-4">
      <input class="submit" type="submit" text="submit" />
    </div>
  </form>
</div>
<?php
$out = ob_get_clean();
?>
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
  <div class="row">
    <div class="small-12 medium-4 columns">
      <label>Input Label
        <input type="text" placeholder="manufacturer" />
      </label>
    </div>
    <div class="small-12 medium-4 columns"">
      <label>Input Label
        <input type="select" placeholder="model" />
      </label>
    </div>
    <div class="small-12 medium-4 columns"">
      <label>Input Label
        <input type="submit" text="submit" />
      </label>
    </div>
</form>
<?php
$out = ob_get_clean();
?>
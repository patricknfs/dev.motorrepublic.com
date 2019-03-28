<?php
// power_search.php
date_default_timezone_set('CET');

// manufacturer query
$query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`rates_combined_terse` WHERE `special` = 1 ORDER BY `manufacturer` ASC";
$result = mysqli_query($conn, $query);

$man = array();

while ($row = mysqli_fetch_assoc($result)) {
  $manu = (stripos($row['manufacturer'], 'mercedes' ) === FALSE?$row['manufacturer']:"MERCEDES");
  array_push($man, $manu);
}

$lcv = "";
$selector = (($lcv==1)?"name=van-leasing-hgv":"name=car-leasing");
ob_start();
?>
<form action="<?=$pages->get($selector)->url;?>" method="GET">
  <div class="grid-x grid-margin-x">
    <!-- <div class="select">
      <select id="ex_custom_select">
        <option>Option 1</option>
        <option>Option 2</option>
        <option>Option 3</option>
      </select>
    </div> -->
    <div class="cell small-12 medium-2 custom-select" width="200px">
      <select id="marque" name="marque">
        <option value="">Manufacturer</option>
      </select>
    </div>
    <div class="cell small-12 medium-2">
      <select id="model" name="model">
        <option value="">Model (choose manufacturer first)</option>
      </select>
    </div>
    <div class="cell small-12 medium-2">
      <select id="bodystyle" name="bodystyle">
        <option value="">Select Body Style</option>
      </select>
    </div>
    <!-- <div class="cell small-12 medium-2">
      <select id="rate_range" name="rate_range">
        <option value="">Select Rate Range</option>
        <option value="150">< £150 per month</option>
        <option value="200">£150-£200 per month</option>
        <option value="300">£200-£300 per month</option>
        <option value="400">£300-£400 per month</option>
        <option value="500">£400-£500 per month</option>
        <option value="500">> £500 per month</option>
      </select>
    </div>
    <div class="cell small-12 medium-2">
      <select id="slct5" name="slct5">
        <option value=""></option>
      </select>
    </div> -->
    <div class="cell small-12 medium-2">
      <input type="submit" class="button" value="Find Your Deal">
    </div>
  </div>
</form>
<?php
$form_out = ob_get_clean();
?>
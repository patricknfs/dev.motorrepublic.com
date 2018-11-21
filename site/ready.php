<?php
// $forms->addHookBefore('InputfieldForm::render', function($e) {
//   print_r($e);
//   print_r($e->object->name);
//   // if ($e->object->name != 'vehicle_power_search') return; // quick exit if form name doesn't match
//   $processor = $e->object;
//   $form = $e->arguments('form');
//   if($processor->formName == 'vehicle_power_search') { //form name
//     $f = $form->getChildByName('manufacturer'); //form field name
//     echo "form is " . $f;
//     $options = ['red', 'blue', 'green']; // replace with your dynamic options -->
//     foreach($options as $option) {
//       $f->addOption($option);
//     }
//   }
// });
date_default_timezone_set('CET');
require_once '/var/www/vhosts/motorrepublic.com/dev.motorrepublic.com/site/templates/inc/config.php';
require_once(MR_PATH . "/inc/conn.php");
// include "inc/functions.php";

$man_query = "SELECT DISTINCT(`manufacturer`) FROM `team`.`vehicles` ORDER BY `manufacturer` ASC";
$man_result = mysqli_query($conn, $man_query);

$forms->addHookBefore('FormBuilderProcessor::renderReady', function($e) {
  $processor = $e->object;
  $form = $e->arguments(0);
  if($processor->formName != 'vehicle_power_search') return;
  $f = $form->getChildByName('manufacturer');
  while ($man_row = mysqli_fetch_assoc($man_result)) {
    $f->options = [$man_row['manufacturer'] => $man_row['manufacturer']];
  }
  // $f->options = [

  //   // 'manufacturer1' => 'Manufacturer 1',
  //   // 'manufacturer2' => 'Manufacturer 2', 
  // ];
});

// $forms->addHookBefore('FormBuilderProcessor::render', function($e) {
//   if ($e->object->name != 'manufacturer') return; // quick exit if fieldname doesn't match
//   $processor = $e->object;
//   $form = $processor->getInputfieldsForm();
//   if($form->name == 'vehicle_power_search') {
//     $my_select = $form->getChildByName('manufacturer');
//     print_r($my_select);
//     $options = ['red', 'blue', 'green']; // replace with your dynamic options
//     foreach($options as $option) {
//       $my_select->addOption($option);
//     }
//   }
// });
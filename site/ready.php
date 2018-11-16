<?php
// $forms->addHookBefore('InputfieldForm::render', function($e) {
//   // print_r($e->object->name);
//   // if ($e->object->name != 'vehicle_power_search') return; // quick exit if form name doesn't match
//   $processor = $e->object;
//   $form = $e->arguments('vehicle_power_search');

//   if($processor->formName == 'vehicle_power_search') { //form name
//     $f = $form->getChildByName('manufacturer'); //form field name
//     echo "form is " . $f;
//     $options = ['red', 'blue', 'green']; // replace with your dynamic options -->
//     foreach($options as $option) {
//       $f->addOption($option);
//     }
//   }
// });

$forms->addHookBefore('FormBuilderProcessor::render', function($e) {
  if ($e->object->name != 'vehicle_power_search') return; // quick exit if form name doesn't match
  $processor = $e->object;
  $form = $processor->getInputfieldsForm();
  if($form->name == 'vehicle_power_search') {
    $my_select = $form->getChildByName('manufacturer');
    print_r($form->getChildByName());
    $options = ['red', 'blue', 'green']; // replace with your dynamic options
    foreach($options as $option) {
      $my_select->addOption($option);
    }
  }
});
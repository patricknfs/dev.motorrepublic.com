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

$forms->addHookBefore('FormBuilderProcessor::renderReady', function($e) {
  $processor = $e->object;
  $form = $e->arguments(0);
  if($processor->formName != 'vehicle_power_search') return;
  $f = $form->getChildByName('manufacturer');
  $templates = ['vehicle', 'vehicles', 'home']; //array of templates where this hook should run
  if(in_array($page->template->name, $templates)){
    $f->options = [
      // 'manufacturer1' => 'Manufacturer 1',
      // 'manufacturer2' => 'Manufacturer 2', 
      $man,
    ];
  }
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
<?php
// $forms->addHookBefore('InputfieldForm::render', function($e) {
//   $processor = $e->object;
//   $form = $e->arguments('form');
//   if($processor->formName == 'vehicle_power_search') { //form name
//     $f = $form->getChildByName('manufacturer'); //form field name
//     if($f) $f->addOption('testing hook'); //selector test - replace with resutls from non pw query query
//   }
// });

$forms->addHookBefore('FormBuilderProcessor::render', function($event) {
  $processor = $event->object;
  $form = $processor->getInputfieldsForm();
  if($form->name == 'vehicle_power_search') {
      $my_select = $form->get('manufacturer');
      $options = ['red', 'blue', 'green']; // replace with your dynamic options
      foreach($options as $option) {
          $my_select->addOption($option);
      }
  }
}); 
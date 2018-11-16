<?php
$forms->addHookBefore('InputfieldForm::render', function($e) {
  $processor = $e->object;
  $form = $e->arguments('form');
  if($processor->formName == 'vehicle_power_search') { //form name
    $f = $form->getChildByName('manufacturer'); //form field name
    if($f) $f->addOption('testing hook'); //selector test - replace with resutls from non pw query query
  }
  // if(strpos($form->id, 'FormBuilder') !== 0 || $form->name != 'vehicle_power_search') return;
  // $f = $form->getChildByName('select_options');
  // if($f) $f->addOption('added option'); 
});
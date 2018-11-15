<?php
$forms->addHookBefore('InputfieldForm::render', function($e) {
  $processor = $e->object;
  $form = $e->arguments('vehicle_power_search');
  echo $form->children();
  if($processor->formName == 'vehicle_power_search') {
    $f = $form->getChildByName('manufacturer');
    if($f) $f->addOption('testing hook'); 
    // return "testing hook";
  }
  // if(strpos($form->id, 'FormBuilder') !== 0 || $form->name != 'vehicle_power_search') return;
  // $f = $form->getChildByName('select_options');
  // if($f) $f->addOption('added option'); 
});
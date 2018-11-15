<?php
$forms->addHookBefore('InputfieldForm::render', function($event) {
  $processor = $event->object;
  $form = $e->arguments('vehicle_power_search');
  if($processor->formName == 'vehicle_power_search') {
    return "testing hook";
  }
  // if(strpos($form->id, 'FormBuilder') !== 0 || $form->name != 'vehicle_power_search') return;
  // $f = $form->getChildByName('select_options');
  // if($f) $f->addOption('added option'); 
});
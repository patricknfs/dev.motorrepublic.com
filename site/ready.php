<?php
$forms->addHookBefore('InputfieldForm::render', function($event) {
  $form = $event->object;
  if(strpos($form->id, 'FormBuilder') !== 0 || $form->name != 'vehicle_power_search') return;
  $f = $form->getChildByName('select_options');
  if($f) $f->addOption('added option'); 
});
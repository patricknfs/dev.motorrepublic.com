<?php
$forms->addHookBefore('FormBuilderProcessor::renderReady', function($e) {
  $processor = $e->object;
  $form = $e->arguments(0);
  if($processor->formName != 'vehicle_power_search') return;
  $f = $form->getChildByName('manufacturer');
  
  $f->options = (object) $mans;
});

$mans = $this->wire('manufs');
  print_r($mans);
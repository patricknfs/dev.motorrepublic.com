<?php
// $mans = $this->wire('manufs');
// var_dump($mans);
// foreach($mans AS $man){
//   echo $man;
// }

$forms->addHookBefore('FormBuilderProcessor::renderReady', function($e) {
  $processor = $e->object;
  $form = $e->arguments(0);
  if($processor->formName != 'vehicle_power_search') return;
  $f = $form->getChildByName('manufacturer');

  // echo "Options are: " . $f->options;
  $f->options = wire('session')->get('manufs');
});
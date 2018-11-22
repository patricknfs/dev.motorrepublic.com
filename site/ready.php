<?php
// $mans = $this->wire('manufs');
// var_dump($mans);
// foreach($mans AS $man){
//   echo $man;
// }
include "inc/manufacturer.php";
$forms->addHookBefore('FormBuilderProcessor::renderReady', function($e) {
  $processor = $e->object;
  $form = $e->arguments(0);
  if($processor->formName != 'vehicle_power_search') return;
  $f = $form->getChildByName('manufacturer');
  $f->options = $this->wire('manufs');
  echo "Options are: " . $f->options;
  // $f->options = $mans;
});
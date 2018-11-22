<?php
$forms->addHookBefore('FormBuilderProcessor::renderReady', function($e) {
  $processor = $e->object;
  $form = $e->arguments(0);
  if($processor->formName != 'vehicle_power_search') return;
  $f = $form->getChildByName('manufacturer');
  // $mans = $this->wire('manufs');
  // print_r($mans);
  foreach($this->wire('manufs') AS $man){
    echo $man;
  }
  $f->options = $mans;
});
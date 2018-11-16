<!-- <?php
$forms->addHookBefore('InputfieldForm::render', function($e) {
  if ($e->object->name != 'manufacturer') return; // quick exit if fieldname doesn't match
  $processor = $e->object;
  $form = $e->arguments('form');
  if($processor->formName == 'vehicle_power_search') { //form name
    $f = $form->getChildByName('manufacturer'); //form field name
    $options = ['red', 'blue', 'green']; // replace with your dynamic options -->
    foreach($options as $option) {
      $my_select->addOption($option);
    }
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
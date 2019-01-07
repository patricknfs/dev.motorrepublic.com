
<?php
$row = 1;
if (($handle = fopen("test.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);
        echo "<p> $num fields in line $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }
    }
    fclose($handle);
}

$entry = array(
  'first_name' => 'John',
  'last_name' => 'Smith',
  'email' => 'john@smith.com',
  'message' => 'Hello',
);

$form = $forms->load('contact');
$form->entries()->save($entry);
?>
<form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data">
<input type="file" name="file">
<input type="submit" name="btn_submit" value="Upload File" />

<?php
// $fh = fopen($_FILES['file']['tmp_name'], 'r+');
// $lines = array();
// while( ($row = fgetcsv($fh, 8192)) !== FALSE ) {
// 	$lines[] = $row;
// }
// var_dump($lines);


$row = 1;
if (($handle = fopen($_FILES['file']['tmp_name'], "r")) !== FALSE) {
  while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
      if ($row > 1) continue;
      echo $data[$c] . "<br />\n";
      // $entry = array(
      //   'first_name' => 'John',
      //   'last_name' => 'Smith',
      //   'email' => 'john@smith.com',
      //   'message' => 'Hello',
      // );
      // $form = $forms->load('contact');
      // $form->entries()->save($entry);
    }
  }
  fclose($handle);
}


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.1/jquery.js"></script>
<script>
//Declaration of function that will insert data into database
function senddata(filename){
  var file = filename;
  $.ajax({
    type: "POST",
    url: "/tools/senddata/",
    data: {file},
    async: true,
    success: function(html){
      $("#result").html(html);
    }
  })
}
</script>
<?php
$csv = array();
$batchsize = 1000; //split huge CSV file by 1,000, you can modify this based on your needs
if($_FILES['csv']['error'] == 0){
  $name = $_FILES['csv']['name'];
  // var_dump($name);
  // $name = array_unique($name);
  // var_dump($name);
  $name = explode('.', $name);
  $ext = strtolower(end($name));
  $tmpName = $_FILES['csv']['tmp_name'];
  if($ext === 'csv'){ //check if uploaded file is of CSV format
    if(($handle = fopen($tmpName, 'r')) !== FALSE) {
      set_time_limit(0);
      $row = 0;
      while(($data = fgetcsv($handle)) !== FALSE) {
        $col_count = count($data);
        // echo $col_count;
        //splitting of CSV file :
        if ($row % $batchsize == 0):
          $file = fopen("minpoints$row.csv","w");
        endif;
        
        $manufacturer = addslashes($data[0]);
        $model = addslashes($data[1]);
        $description = addslashes($data[2]);
        $cap_code = preg_replace('/\s+/', '', $data[3]);
        $cap_id = $data[4];
        $p11d_value = $data[5];
        $fuel = $data[6];
        $co2 = $data[7];
        $mpg = $data[8];
        $ncap = $data[9];
        $euro = $data[10];
        $ins_grp = $data[11];
        
        $json = "'$manufacturer', '$model', '$description', '$cap_code', '$cap_id', '$p11d_value', '$fuel', '$co2', '$mpg', '$ncap', '$euro', '$ins_grp' ";
        fwrite($file,$json.PHP_EOL);
        //sending the splitted CSV files, batch by batch...
        if ($row % $batchsize == 0):
          echo "<script> senddata('minpoints$row.csv'); </script>";
        endif;
        $row++; 
      }
      fclose($file);
      fclose($handle);
    }
  }
  else
  {
      echo "Only CSV files are allowed.";
  }
  //alert once done.
  echo "<script> alert('CSV imported!') </script>";
}
?>
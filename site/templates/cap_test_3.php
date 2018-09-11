<?php
$response = http_get("https://soap.cap..co.uk/images/vehicleimage.aspx?SUBID=173210&HASHCODE=498B0751B9DA01C22242AE2E039E1B16&DB=CAR&CAPID=64851&DATE=2018/09/11&WIDTH=1024&HEIGHT=768&IMAGETEXT=test&VIEWPOINT=", array("timeout"=>1), $info);
print_r($info);
?>
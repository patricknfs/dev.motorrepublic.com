<?php
function inputPost($post_var, $default=""){
   $value = $default;
   if (!get_magic_quotes_gpc()) {
       if (isset($_POST["$post_var"])) {
		 	$value = addslashes($_POST["$post_var"]);
		 }
   } else {
       if (isset($_POST["$post_var"])) {
		 	$value = $_POST["$post_var"];
		 }
   }
   return($value);
}

function inputGet($get_var, $default=""){
   $value = $default;
   if (!get_magic_quotes_gpc()) {
       if (isset($_GET["$get_var"])) {
		 	$value = addslashes($_GET["$get_var"]);
		 }
   } else {
       if (isset($_GET["$get_var"])) {
		 	$value = $_GET["$get_var"];
		 }
   }
   return($value);
}


function mysql2uk( $date )
{
    return date( 'd-m-Y H:i:s', strtotime( $date ) );
}

function mysql2uk2( $date )
{
    return date( 'd-m-Y', strtotime( $date ) );
}

function uk2mysql( $retdate )
{
    $date_array = explode("/",$retdate);
        
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];

        $retdate = $var_year . "-" . $var_month . "-" . $var_day . " 0:0:1";
        return($retdate);
}

function uk2mysqlno( $retdate )
{
	sscanf($retdate,'%2s%2s%2s',$day,$month,$year);
	$retdate = "20" . $year . "-" . $month . "-" . $day . " 0:0:1";
	return($retdate);
}

function uk2mysqlendno( $retdate )
{
	sscanf($retdate,'%2s%2s%2s',$day,$month,$year);
   $retdate = "20" . $year . "-" . $month . "-" . $day . " 23:59:59";
   return($retdate);
}

function uk2mysqlandTime( $retdate )
{
    $date_array = explode("/",$retdate);
        
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_yeartime = $date_array[2];

        $retdate = $var_year . "-" . $var_month . "-" . $var_day . " 0:0:1";
        return($retdate);
}

function uk2mysqlyr( $retdate )
{
    $date_array = explode("/",$retdate);
        
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];

        $retdate = "20" . $var_year . "-" . $var_month . "-" . $var_day ;
        return($retdate);
}

function uk2mysqlyrno20( $retdate )
{
	$date_array = explode("/",$retdate);
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];

        $retdate = $var_year . "-" . $var_month . "-" . $var_day ;
        return($retdate);
}

function us2mysql( $retdate )
{
	$date_array = explode("/",$retdate);
        $var_month = $date_array[0];
        $var_day = $date_array[1];
        $var_year = $date_array[2];

        $retdate = $var_year . "-" . $var_month . "-" . $var_day ;
        return($retdate);
}

function uk2mysqldate( $retdate )
{
	sscanf($retdate,'%2s%2s%2s',$day,$month,$year);
	$retdate = "20" . $year . "-" . $month . "-" . $day;
	return($retdate);
}

function uk2mysql2( $retdate )
{
    $date_array = explode("/",$retdate);
        
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];

        $retdate = "20" . $var_year . "-" . $var_month . "-" . $var_day;
        return($retdate);
}

function ukgoogle2mysql( $retdate ){
	$date_array = explode(" ", $retdate);
	$var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];
	$var_time = $date_array[3];
	
	$retdate =  date('Y-m-d', strtotime($var_year . "-" . $var_month . "-" . $var_day )) . " " . $var_time;

	return($retdate);
}

function ukgoogle3mysql( $retdate ){
	$date_array = explode(" ", $retdate);
	$var_date = explode("-", $date_array[0]);
	$var_day = $var_date[0];
	$var_month = $var_date[1];
	$var_year = $var_date[2];
	$var_time = $date_array[1];
	
	$retdate =  date('Y-m-d', strtotime($var_year . "-" . $var_month . "-" . $var_day )) . " " . $var_time;

	return($retdate);
}

function por2mysql( $retdate ){
	$date_array = explode(" ", $retdate);
	$var_date = $date_array[0];
        $var_time = explode(":", $date_array[1]);

	if(!empty($var_time[2])){
		$new_var_time  = $var_time[0] . ":" . $var_time[1] . ":" . $var_time[2];
	}
	else{
		$new_var_time = $var_time[0] . ":" . $var_time[1] . ":00";
	}
	
	$retdate =  $var_date . " " . $new_var_time;

	return($retdate);
}

function ared2mysql( $retdate ){
	$date_array = explode(" ", $retdate);
     $var_time = explode(":", $date_array[1]);
     $var_date = explode("/", $date_array[0]);
	
	$new_var_date = $var_date[2] . "-" . $var_date[1] . "-" . $var_date[0];

	if(!empty($var_time[2])){
		$new_var_time  = $var_time[0] . ":" . $var_time[1] . ":" . $var_time[2];
	}
	else{
		$new_var_time = $var_time[0] . ":" . $var_time[1] . ":00";
	}
	
	$retdate =  $new_var_date . " " . $new_var_time;

	return($retdate);
}

function por2mysqldate( $retdate ){
	$date_array = explode(" ", $retdate);
	$var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];
	$var_time = $date_array[4];
	
	$retdate =  date('Y-m-d', strtotime($var_year . "-" . $var_month . "-" . $var_day ));

	return($retdate);
}

function uk2mysqlaw( $retdate ){

    $date_array = explode("/",$retdate);
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];
        $retdate = $var_year . '-' . $var_month . '-' . $var_day;
        return($retdate);
}

function uk2mysqlend( $retdate )
{
    $date_array = explode("/",$retdate);
        $var_day = $date_array[0];
        $var_month = $date_array[1];
        $var_year = $date_array[2];

        $retdate = $var_year . "-" . $var_month . "-" . $var_day . " 23:59:59";
        return($retdate);
}

function unix2mysql( $retdate )
{
	return date( 'Y-m-d H:i:s', $retdate );
}

/*
Converts a CSV file to a simple XML file
@param string $file
@param string $container
@param string $rows
@return string
*/
function csv2xml($file, $container = 'data', $rows = 'row')
{
        $r = "<{$container}>\n";
        $row = 0;
        $cols = 0;
        $titles = array();
       
        $handle = @fopen($file, 'r');
        if (!$handle) return $handle;
       
        while (($data = fgetcsv($handle, 1000, ',')) !== FALSE)
        {
		if ($row > 0) $r .= "\t<{$rows}>\n";
		if (!$cols) $cols = count($data);
		for ($i = 0; $i < $cols; $i++){
			if ($row == 0){
				$titles[$i] = $data[$i];
				continue;
			}
			$r .= "\t\t<" . str_replace(" ", "_", $titles[$i]) . ">";
			$r .= str_replace("&", "&amp;", $data[$i]);
			$r .= "</" . str_replace(" ", "_", $titles[$i]) . ">\n";
		}
		if ($row > 0) $r .= "\t</{$rows}>\n";
		$row++;
        }
        fclose($handle);
        $r .= "</{$container}>";
       
        return $r;
}

//Decimal places function
function format_number($str,$decimal_places='2',$decimal_padding="0"){
  /* firstly format number and shorten any extra decimal places */
  /* Note this will round off the number pre-format $str if you dont want this fucntionality */
  $str           =  number_format($str,$decimal_places,'.','');     // will return 12345.67
  $number       = explode('.',$str);
  $number[1]     = (isset($number[1]))?$number[1]:''; // to fix the PHP Notice error if str does not contain a decimal placing.
  $decimal     = str_pad($number[1],$decimal_places,$decimal_padding);
  return (float) $number[0].'.'.$decimal;
}

function truncateText($text, $maxlength) {
  // truncate to max length
  $text = substr(strip_tags($text), 0, $maxlength);
  // check if we've truncated to a spot that needs further truncation
  if(strlen(rtrim($text, ' .!?,;')) == $maxlength) {
      // truncate to last word 
      $text = substr($text, 0, strrpos($text, ' ')); 
  }
  return trim($text); 
}

function objectToArray($d) {
    if (is_object($d)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $d = get_object_vars($d);
    }
    
    if (is_array($d)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $d);
    }
    else {
        // Return array
        return $d;
    }
}

function AddWSSUsernameToken($client, $username, $password)
{
    $wssNamespace = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";

    $username = new SoapVar($username, 
        XSD_STRING,
        null, null,
        'subscriberId',
        $wssNamespace);

    $password = new SoapVar($password, 
        XSD_STRING, 
        null, null, 
        'password', 
        $wssNamespace);

    $usernameToken = new SoapVar(array($username, $password), 
        SOAP_ENC_OBJECT, 
        null, null, 'UsernameToken', 
        $wssNamespace);

    $usernameToken = new SoapVar(array($usernameToken), 
        SOAP_ENC_OBJECT, 
        null, null, null, 
        $wssNamespace);

    $wssUsernameTokenHeader = new SoapHeader($wssNamespace, 'Security', $usernameToken);

    $client->__setSoapHeaders($wssUsernameTokenHeader);
}

function get_soap_client_1(){
    global  $username, $password;
    $username = '173210';
    $password = 'NfS4Je';
    $wsdl = 'https://soap.cap.co.uk/Vehicles/CapVehicles.asmx?WSDL';

    $options = array(
        'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
        'style'=>SOAP_RPC,
        'use'=>SOAP_ENCODED,
        'soap_version'=>SOAP_1_2,
        'cache_wsdl'=>WSDL_CACHE_NONE,
        'connection_timeout'=>15,
        'trace'=>true,
        'encoding'=>'UTF-8',
        'exceptions'=>true,
    );

    $client = new SoapClient($wsdl, $options);
    AddWSSUsernameToken($client, $username, $password);
    return $client;
}

function get_soap_client_2(){
    global  $username, $password;
    $username = '173210';
    $password = 'NfS4Je';
    $wsdl = 'https://soap.cap.co.uk/Nvd/CapNvd.asmx?WSDL';

    $options = array(
        'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
        'style'=>SOAP_RPC,
        'use'=>SOAP_ENCODED,
        'soap_version'=>SOAP_1_2,
        'cache_wsdl'=>WSDL_CACHE_NONE,
        'connection_timeout'=>15,
        'trace'=>true,
        'encoding'=>'UTF-8',
        'exceptions'=>true,
    );

    $client = new SoapClient($wsdl, $options);
    AddWSSUsernameToken($client, $username, $password);
    return $client;
}

function treeMenu(Page $page = null, $depth = 1, $id = null) {

    $depth -= 1;
    
    if(is_null($page)) $page = wire('page');
    if(!is_null($id)) $id = " id='$id'";

    $out = "\n<ul$id>";

    $parents = $page->parents;

    // This is where we get pages we want. You could just say template!=news-item 
    foreach($page->children() as $child) {
            $class = "level-" . count($child->parents);
            $s = '';
            if($child->numChildren && $depth > 0 ) {
                    $s = str_replace("\n", "\n\t\t", treeMenu($child, $depth));
            }

            $class .= " page-{$child->id}";
            $class = " class='$class'";
            $out .= "\n\t<li$class>\n\t\t<a$class href='{$child->url}'>{$child->title}</a>$s\n\t</li>";
    }
    $out .= "\n</ul>";

    return $out;
}
?>

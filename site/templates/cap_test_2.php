<?php
// function objectToArray($d) {
//     if (is_object($d)) {
//         // Gets the properties of the given object
//         // with get_object_vars function
//         $d = get_object_vars($d);
//     }
    
//     if (is_array($d)) {
//         /*
//         * Return array converted to object
//         * Using __FUNCTION__ (Magic constant)
//         * for recursive call
//         */
//         return array_map(__FUNCTION__, $d);
//     }
//     else {
//         // Return array
//         return $d;
//     }
// }

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

function get_soap_client(){
    global  $username, $password;
    $username = '173210';
    $password = 'NfS4Je';
    $wsdl = 'https://soap.cap.co.uk/DataDownload/DataDownload_Webservice.asmx?WSDL';

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

try
    {
      $username = '173210';
      $password = 'NfS4Je';
      
      $clients = get_soap_client();
      $params = array('SubscriberID' => $username, 'Password' => $password); //define your parameters here
      $clients->List_AllSubscriberProducts($params);
      $result = $clients->__getLastResponse();
      libxml_use_internal_errors(true);

      $xml = simplexml_load_string($result);
      
      var_dump($xml->asXML()); //this will output the xml object just fine
      
      if ($xml !== false) {
          echo "Successfully loaded the XML" . PHP_EOL;
          print "Message: " . $xml->xpath("//products")->product->productid . PHP_EOL;
          print_r($xml->children());
          foreach($xml->children() AS $thing){
              print_r($thing);
          }
        }
      else{
          echo "Failed loading the XML" . PHP_EOL;
          foreach(libxml_get_errors() as $error) {
              echo "\t", $error->message;
          }
      }
    //   echo "<pre>";
    //     print_r($result);
    //   echo"</pre>";
    //   $xml = simplexml_load_string($result);
    //   echo "<pre>";
    //     print_r($xml);
    //   echo"</pre>";
    //   foreach($xml->Products as $key => $item){
    //     echo "Code: " . $item->Productid . "<br />";
    //   }
    }
    catch(SoapFault $fault){
        $error      =   "SOAP Fault: (faultcode: {$fault->faultcode}\n" ."faultstring: {$fault->faultstring})"; 
        echo $error;
    }
    catch(Exception $e){ 
      echo $e->getCode(). '<br />'. $e->getMessage();
    }
?>
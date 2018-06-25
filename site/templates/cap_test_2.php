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
      
      $client = get_soap_client();
      $params = array('SubscriberID' => $username, 'Password' => $password); //define your parameters here
      $client->List_AllSubscriberProducts($params);
      // $result = $client->__getLastResponse();
      // $xml    = str_replace(array("diffgr:","msdata:"),'', trim($data));
      $data = new SimpleXMLElement($client->List_AllSubscriberProducts($params));
      echo "<pre>";
        print_r($data);
      echo"</pre>";
      $products  = $data->xpath('//Products');
      print "We have " . count($products) . " products: \n";
      foreach($products as $item){
        echo "Code: " . $item->ProductID . "<br />";
      }
    }

    catch(Exception $e){ 
        echo $e->getCode(). '<br />'. $e->getMessage();
    }
?>
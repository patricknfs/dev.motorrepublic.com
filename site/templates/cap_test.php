<?php

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
    global $username;
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
    // $functions = $client->__getFunctions (); 
    // var_dump ($functions);
    AddWSSUsernameToken($client, $username, $password);
    return $client;
}

try
    {   
        $username = '173210';
        $password = 'NfS4Je';
        $params = array('justCurrentManufacturers' => true,'subscriberId' => $username, 'password' => $password, 'database' => 'car', 'bodyStyleFilter' => '' ); //define your parameters here
        $client = get_soap_client();
        $result = $client->GetCapMan($params);
        // return($result);
        var_dump($result);
        // $array = $result->GetCapMan->justCurrentManufacturers;
        foreach($result AS $name){
            echo $name . "<br />";
        }

        $client->__getLastResponse();
    }

    catch(Exception $e){ 
        echo $e->getCode(). '<br />'. $e->getMessage();
    }
?>
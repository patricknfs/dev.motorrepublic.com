<?php

$soapClient = new SoapClient("https://soap.cap.co.uk/Vehicles/CapVehicles.asmx?WSDL"); 
$username = '173210';
$password = 'NfS4Je';

// Prepare SoapHeader parameters 
$sh_param = array( 
            'subscriberId'    =>   $username, 
            'password'    =>    $password); 
$headers = new SoapHeader('http://schemas.xmlsoap.org/soap/envelope/', 'UserCredentials', $sh_param); 

// Prepare Soap Client 
$soapClient->__setSoapHeaders(array($headers)); 
$params = array('justCurrentManufacturers');
$soapClient->GetCapMan($params);
?>
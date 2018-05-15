<?php
function AddWSSUsernameToken($client, $username, $password)
{
    $wssNamespace = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";

    $username = new SoapVar($username, 
                            XSD_STRING, 
                            null, null, 
                            'Username', 
                            $wssNamespace);

    $password = new SoapVar($password, 
                            XSD_STRING, 
                            null, null, 
                            'Password', 
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


    $username = '173210';
    $password = 'NfS4Je';
    $wsdl = 'https://soap.cap.co.uk/Nvd/CapNvd.asmx';

    $options = array(
            'uri'=>'http://schemas.xmlsoap.org/soap/envelope/',
            'style'=>SOAP_RPC,
            'use'=>SOAP_ENCODED,
            'soap_version'=>SOAP_1_1,
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
      echo "testing"
        $params = array(); //define your parameters here
        $client = get_soap_client();
        $response = $client->__soapCall('method-name',$params);

    }
    catch(Exception $e){ 
        echo $e->getCode(). '<br />'. $e->getMessage();

    }


?>
<?php
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

function get_soap_client(){
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

try
    {   
        $username = '173210';
        $password = 'NfS4Je';
        
        $client = get_soap_client();
        $params = array('justCurrentManufacturers' => true,'subscriberId' => $username, 'password' => $password, 'database' => 'car', 'bodyStyleFilter' => '' ); //define your parameters here
        $client->GetCapMan($params);
        $data = $client->__getLastResponse();
        $xml    = str_replace(array("diffgr:","msdata:"),'', trim($data));
        // Wrap into root element to make it standard XML
        // $xml    = "<package>" . $xml . "</package>";
        // echo "<pre>";
        //     print_r($xml);
        // echo"</pre>";
        // $data   = simplexml_load_string($xml);
        $data = new SimpleXMLElement($xml);
        $marques  = $data->xpath('//Table');
        // print "We have " . count($marques) . " marques: \n";
        foreach($marques as $item){
            echo "ManCode: " . $item->CMan_Code . " and Manufacturer: " . $item->CMan_Name . "<br />";
            $range_params = array('justCurrentRanges' => true,'subscriberId' => $username, 'password' => $password, 'database' => 'car', 'manCode' => $item->CMan_Code, 'bodyStyleFilter' => '' ); //define your parameters here
            $client->GetCapRange_IncludeOnRunout($range_params);
            $data_range = $client->__getLastResponse();
            $xml_range    = str_replace(array("diffgr:","msdata:"),'', trim($data_range));
            // echo "<pre>";
            //     print_r($xml_range);
            // echo"</pre>";
            $data_range = new SimpleXMLElement($xml_range);
            $ranges  = $data_range->xpath('//Table');
            foreach($ranges as $range){
                echo "RangeCode: " . $range->CRan_Code . " Range: " . $item->CMan_Name . " " . $range->CRan_Name . "<br />";
                $mod_params = array('justCurrentModels' => true,'subscriberId' => $username, 'password' => $password, 'database' => 'car', 'manRanCodeIsMan' => true, 'manRanCode' => $range->CRan_Code, 'bodyStyleFilter' => '' ); //define your parameters here
                $client->GetCapMod_IncludeOnRunout($mod_params);
                $data_mod = $client->__getLastResponse();
                $xml_mod    = str_replace(array("diffgr:","msdata:"),'', trim($data_mod));
                echo "<pre>";
                    print_r($xml_mod);
                echo"</pre>";
                $data_mod = new SimpleXMLElement($xml_mod);
                $models  = $data_mod->xpath('//Table');
                // foreach ($models AS $model){
                //     echo "ModCode: " . $range->CRan_Code . " Model: " . $item->CMan_Name . " " . $range->CRan_Name . " " . $model->CMod_Name . "<br />";
                // }
            }
        }
    }

    catch(Exception $e){ 
        echo $e->getCode(). '<br />'. $e->getMessage();
    }
?>
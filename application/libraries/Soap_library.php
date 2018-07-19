<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Soap_Library
{
   private $params_result = array("CallSpExcecution"=>"CallSpExcecutionResult",
                                  );
   function __construct()
   {
       require_once('lib/nusoap.php');
   }
   
   function soap_request($service , $params){
   /// echopre($params);die;
        $api_url = API_URL;
        $client = new nusoap_client($api_url, 'wsdl');
        $error = $client->getError();
        if($error){
            echo "\nSOAP Error\n".$error."\n";
            return false;
        }else{
            $result = $client->call($service, $params);
     /// echopre($client);die;
            if ($client->fault)
            {
                print_r($result);
                return false;
            } else
            {
               
                $result_arr = json_decode($result[$this->params_result[$service]], true);
                return $result_arr;
            }
        }
   }
   
   function set_parameter( $sp_name , $post){
        $string_params = "";
        $retVal = array();
        if(!empty($post) && !empty($sp_name)){
            foreach($post as $params => $values){
                $string_params .=$params."#".$values."~";
            }
            $string_params = substr($string_params,0,-1);
            $retVal['txtSPName'] = $sp_name;
            $retVal['txtParamValue'] = $string_params;
            return $retVal;
        }else if(!empty($sp_name)){
            $retVal['txtSPName'] = $sp_name;
            $retVal['txtParamValue'] = "";
            return $retVal;
        }else{
            return false;
        }
   }
}

?>
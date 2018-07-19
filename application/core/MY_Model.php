<?php

class MY_Model extends CI_Model {
    
    var $service = "CallSpExcecution";
    public function __construct(){
        parent::__construct();
              
    }
    
    function retrieveData($parameter , $service = ""){
        $service_exec = !empty($service) ? $service : $this->service;
        $retVal = $this->soap_library->soap_request($service_exec , $parameter);
        return $retVal;
    }
}
?>
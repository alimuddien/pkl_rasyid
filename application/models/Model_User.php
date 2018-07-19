<?php
/**
*
*/
class Model_User extends MY_Model
{

	function get_data_user($uname, $pass)
	{
		$sp_name = "User_Login";
		$arrParams['txtUsername'] = $uname;
		$arrParams['txtPassword'] = $pass;
		// membuat parameter pada API
		$retParameter = $this->soap_library->set_parameter($sp_name , $arrParams);
		// memanggil API
        $retVal = $this->retrieveData($retParameter , "CallSpExcecution");
        return $retVal;
	}
	function set_data_user($fname,$email,$uname,$pass)
	{
		$sp_name = "User_RegisterApp";
		$arrParams['txtFullName'] = $fname;
		$arrParams['txtEmail'] = $email;
		$arrParams['txtUsername'] = $uname;
		$arrParams['txtPassword'] = $pass;
		$retParameter = $this->soap_library->set_parameter($sp_name, $arrParams);
		$retVal = $this->retrieveData($retParameter, "CallSpExcecution");
		return $retVal;
	}
}

 ?>

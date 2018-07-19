<?php
/**
*
*/
class Model_Dokter extends MY_Model
{

	function get_filter_kota()
	{
		$sp_name = "User_getKota";
		$retParameter = $this->soap_library->set_parameter($sp_name , $arrParams);
    $retVal = $this->retrieveData($retParameter , "CallSpExcecution");
    return $retVal;
	}
	function get_filter_spesialis()
	{
		$sp_name = "User_getSpesialis";
		$retParameter = $this->soap_library->set_parameter($sp_name, $arrParams);
		$retVal = $this->retrieveData($retParameter, "CallSpExcecution");
		return $retVal;
	}
  function get_data_dokter($keywords = '',$kota = 0,$spesialis = 0,$kelamin = 0)
  {
    $arrParams['txtKeywords'] = $keywords;
    $arrParams['intIDKota'] = $kota;
    $arrParams['intIDSpesialisDokter'] = $spesialis;
    $arrParams['intIDJenisKelamin'] = $kelamin;
    $sp_name = "User_SearchDokter";
    $retParameter = $this->soap_library->set_parameter($sp_name, $arrParams);
    $retVal = $this->retrieveData($retParameter, "CallSpExcecution");
    return $retVal;
  }
}

 ?>

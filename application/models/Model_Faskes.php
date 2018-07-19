<?php
/**
* Jupuk kabeh
*/
class Model_Faskes extends MY_Model
{
	function ambilData($sp_name,$arrParams)
	{
		$retParameter = $this->soap_library->set_parameter($sp_name , $arrParams);
    $retVal = $this->retrieveData($retParameter , "CallSpExcecution");
    return $retVal;
	}
	function get_filter_kota($idkota = 0,$txtkota = '')
	{
		$arrParams['intIDKota'] = $idkota;
		$arrParams['txtKota'] = $txtkota;
		$sp_name = "User_getKota";
		return $this->ambilData($sp_name,$arrParams);
	}
	function get_filter_klinik($idpel = 0,$txtpel = '',$txtsing = '')
	{
		$arrParams['intIDJenisPelayanan'] = $idpel;
		$arrParams['txtJenisPelayanan'] = $txtpel;
		$arrParams['txtSingkat'] = $txtsing;
		$sp_name = "User_getKlinik";
		return $this->ambilData($sp_name,$arrParams);
	}
  function get_data_faskes($keywords = '',$kota = 0,$klinik = 0,$jenis = 0)
  {
    $arrParams['txtKeywords'] = $keywords;
    $arrParams['intIDKota'] = $kota;
    $arrParams['intIDKlinik'] = $klinik;
    $arrParams['intIDJenisJamKes'] = $jenis;
    $sp_name = "User_SearchFaskes";
		return $this->ambilData($sp_name,$arrParams);
  }
	function get_list_layanan($id)
	{
		$arrParams['intIDPartner'] = $id;
		$sp_name = "User_getListPelayananInPartner";
		return $this->ambilData($sp_name,$arrParams);
	}
	function get_list_jamkes($id)
	{
		$arrParams['intIDPartner'] = $id;
		$sp_name = "User_getListAvailableJamkesInPartner";
		return $this->ambilData($sp_name,$arrParams);
	}
}
 ?>

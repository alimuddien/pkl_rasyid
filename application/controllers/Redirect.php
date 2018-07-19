<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redirect extends CI_Controller {
	// echopre($retVal);
	// $this->view_xml();
	public function index()
	{
		$this->load->view('view_login');
	}
	public function view_xml(){
		header("Content-type: text/xml");
		$xml_file = file_get_contents($_SERVER['HTTP_HOST']);
		echo $xml_file;
	}
	public function login(){
		$uname = $this->security->xss_clean($this->input->post('uname'));
		$pass = $this->security->xss_clean($this->input->post('pass'));
		$this->load->model('model_user');
		$retVal = $this->model_user->get_data_user($uname, $pass);
		$retuser = $retVal[0];
		if ($retVal[0]['bitSuccess'] == 1){
			$arrSession = array(
				"intIDPartner" => $retuser['intIDPartner'],
				"user_validated" => true,
				"user_username" => $retuser['txtUsername'],
				"user_language" => "ID",
			);
			$this->session->set_userdata($arrSession);
			echo "<script type='text/javascript'>alert('Login successful.')</script>";
			redirect(base_url('home'));
		}
		else {
			echo "<script type='text/javascript'>alert('Either your username or password is incorrect. Try again.')</script>";
			redirect(base_url('redirect'));
		}
	}
	public function register(){
		$this->load->view('view_register');
	}
	public function signup(){
		$fname = $this->security->xss_clean($this->input->post('fname'));
		$email = $this->security->xss_clean($this->input->post('email'));
		$uname = $this->security->xss_clean($this->input->post('uname'));
		$pass = $this->security->xss_clean($this->input->post('pass'));
		$this->load->model('model_user');
		$retVal = $this->model_user->set_data_user($fname,$email,$uname,$pass);
		if ($retVal[0]['bitSuccess'] == 1){
			echo "<script type='text/javascript'>alert('Your registration has been successful.')</script>";
			redirect(base_url('redirect'));
		}
		else {
			echo "<script type='text/javascript'>alert('User already exists. Please submit another username.')</script>";
			redirect(base_url('register'));
		}
	}
	public function home(){
		// $session_id = $this->session->userdata('session_id');
		// if ($session_id != 'null') {
		// 	redirect(base_url('functions'));
		// } else {
		
		// CARI & FILTER FASKES
			if (isset($_POST['submitfilter'])){
				$keywords = "";
				$kota = $this->input->post("faskota");
				$klinik = $this->input->post("fasklinik");
				$jenis = $this->input->post("jk");
			} else if (isset($_POST['submitsearch'])){
				$keywords = $this->input->post("search");
				$kota = "";
				$klinik = "";
				$jenis = "";
			} else {
				$keywords = "";
				$kota = "";
				$klinik = "";
				$jenis = "";
			}
			$this->load->model('model_faskes');
			$retVal ['data_faskes'] = $this->model_faskes->get_data_faskes($keywords,$kota,$klinik,$jenis);
			$retVal ['faskes_kota'] = $this->model_faskes->get_filter_kota();
			$retVal ['faskes_klinik'] = $this->model_faskes->get_filter_klinik();
			$retVal ['list_layanan'] = array($this->model_faskes->get_list_layanan(1),$this->model_faskes->get_list_layanan(2),$this->model_faskes->get_list_layanan(3));
			$retVal ['list_jamkes'] = array($this->model_faskes->get_list_jamkes(1),$this->model_faskes->get_list_jamkes(2),$this->model_faskes->get_list_jamkes(3));
			$this->load->view('view_home', $retVal);
		// END
		// }
	}
	// public function getCategory_Kota()
	// {
	// 	$this->load->model('model_faskes');
	// 	$kota = $this->model_faskes->get_filter_kota();
	// 	return $kota;
	// }
	// public function getCategory_Klinik()
	// {
	// 	$this->load->model('model_faskes');
	// 	$klinik = $this->model_faskes->get_filter_klinik();
	// 	return $klinik;
	// }
}

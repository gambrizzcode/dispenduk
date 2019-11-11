<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_themes extends CI_Controller {

	public function index(){
		$sess_login	= $this->session->userdata('login');
		if(empty($sess_login)){
			$this->load->view('login');
		}else{
			if ($sess_login['role'] == "ADMIN") {
				$this->data['page']	= "themes/dashboard_admin";
				$this->load->view('themes',$this->data);
			}else{
				$this->data['page']	= "themes/dashboard_user";
				$this->load->view('themes',$this->data);
			}
		}
	}
	function dashboard_admin($data = ""){
		$this->data['page']	= "themes/dashboard_admin";
		$this->load->view('themes',$this->data);
	}
	function dashboard_user($data = ""){
		$this->data['page']	= "themes/dashboard_user";
		$this->load->view('themes',$this->data);
	}
}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_akun extends CI_Model {
	function __construct(){
		parent::__construct();
		@set_time_limit(3000000000000000000);

		$this->load->library('My_PHPMailer');
	}
	function add_register($data_register){
		$this->load->database();
		$add = $this->db->insert('user',$data_register);
		return $add;
	}
	function add_permohonan($data_permohonan){
		$add_permohonan = $this->db->insert('permohonan',$data_permohonan);
		return $add_permohonan;
	}
	function add_status($data_status){
		$add_status = $this->db->insert('status',$data_status);
		return $add_status;
	}
	function add_lahir_bayi($data_lahir_bayi){
		$add_lahir_bayi = $this->db->insert('lahir_bayi',$data_lahir_bayi);
		return $add_lahir_bayi;
	}
	function add_lahir_bapak($data_lahir_bapak){
		$add_lahir_bapak = $this->db->insert('lahir_bapak',$data_lahir_bapak);
		return $add_lahir_bapak;
	}
	function add_lahir_ibu($data_lahir_ibu){
		$add_lahir_ibu = $this->db->insert('lahir_ibu',$data_lahir_ibu);
		return $add_lahir_ibu;
	}
	function add_lahir_saksi1($data_lahir_saksi1){
		$add_lahir_saksi1 = $this->db->insert('lahir_saksi1',$data_lahir_saksi1);
		return $add_lahir_saksi1;
	}
	function add_lahir_saksi2($data_lahir_saksi2){
		$add_lahir_saksi2 = $this->db->insert('lahir_saksi2',$data_lahir_saksi2);
		return $add_lahir_saksi2;
	}
	function add_lahir_administrasi($data_lahir_administrasi){
		$add_lahir_administrasi = $this->db->insert('lahir_administrasi',$data_lahir_administrasi);
		return $add_lahir_administrasi;
	}
	function add_kkbaru($data_kkbaru){
		$add_kkbaru = $this->db->insert('kkbaru',$data_kkbaru);
		return $add_kkbaru;
	}
	function add_kia($data_kia){
		$add_kia = $this->db->insert('kia',$data_kia);
		return $add_kia;
	}
	function add_p_online($data_p_online){
		$add_p_online = $this->db->insert('p_online',$data_p_online);
		return $add_p_online;
	}
	function add_reply($data_reply){
		$add_reply = $this->db->insert('reply',$data_reply);
		return $add_reply;
	}
	function cek_lupa($hurah){
		$this->load->database();
		$cek_email = $this->db->get_where('user',$hurah);
		return $cek_email;
	}

	function ayo_login($subjek,$username,$password){
		$this->load->database();
		$this->db->select('id_user,nik,email,nama,status,role,foto_profil');
		$this->db->from('user');
		$this->db->where($subjek, $username);
		$this->db->where('password', $password);
		$this->db->where('status', '1');
		$this->db->limit(1);

		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			$hasil = $query->result();
			return $hasil;
		}else{
			return false;
		}
	}

	function kecamatan($kec){
		$this->db->select('desa');
		$this->db->from('kecamatan');
		$this->db->where('kec', $kec);

		$querykec = $this->db->get();
		return $querykec;
	}

	public function q_data($query, $start="", $limit=""){
		
		if(($start=="" && $limit=="") || ($start==" " && $limit==" ")){
			$LimData = "";
		}else{
			$LimData = "limit $start, $limit";
		}
		
		$return = $this->query_all("$query $LimData");
		return $return;
	}

	function query_all($Query){
		return $this->db->query("$Query");
	}

	function delete_record($table,$id,$value){
		return $this->db->delete($table, array($id => $value));
	}

	function update_record($table,$arr_data,$klausa,$v_klausa){
		$this->db->where($klausa,$v_klausa);
		$this->db->update($table,$arr_data);

		// return $this->db->set();
		return true;
	}

	function changeActiveState($key){
		$this->load->database();
		$data = array(
			'status' => 1
		);

		$this->db->where('md5(id_user)', $key);
		$this->db->update('user', $data);

		return true;

	}

	function pagging_hal($Number, $JmlBaris, $Limit, $Url){
		
		$Number	= $Number;
		$to		= ($Number+1+$Limit);
		if($to>$JmlBaris){
			$to = $JmlBaris;
		}
		$return = "<div class='datatable-bottom'>";
		$return .= "<div class='pull-left'>";
		$return .= "<div class='dataTables_info' id='DataTables_Table_0_info' role='status' aria-live='polite'>
		Showing ".($Number+1)." to ".$to." of ".$JmlBaris." entries</div>";
		$return .= "</div>";
		$return .= "<div class=\"pull-right\">";
		$return .= "<div class=\"dataTables_paginate paging_bootstrap\" id=\"DataTables_Table_0_paginate\">";
		$return .= "<ul class=\"pagination pagination-sm\">";
	
		if($Number==0){ $Min = 0;
		}else{ $Min = $Number-2; if($Min<=0){ $Min = $Number-1; } }
		$Max	= ceil($JmlBaris/$Limit);
		
		if($Min>=2){
			$return .= "<li class=\"prev\"><a href=\"".site_url($Url."/".($Number-1))."\" title=\"Previous\">
			<i class=\"ti-arrow-left mr5\"></i>Previous</a></li>";
		}
		for($nav = $Min; $nav <$Max; $nav++){
			if($Number==$nav){ 
				$return .= "<li class=\"active\"><a href=\"#\">".($Number+1)."</a></li>";
			}else{
				$return .= "<li><a href='".site_url($Url."/".$nav)."'>".($nav+1)."</a></li>";
			}
			
		}
		if(($Number+1)<$Max){
			$return .= "<li class=\"next\">
			<a href='".site_url($Url."/".($Number+1))."' title=\"Next\">
			<i class=\"ti-arrow-right mr5\"></i>Next</a></li>";
			//$return .= "<li class='page-pre'><a href='".site_url($Url."/".($JmlBaris-1))."'>Last</a></li>";
		}
		
		$return .= "</ul></div></div></div>";
		return $return;
	}

	public function send_mail($Email, $Subject, $Message){
		$mail = new PHPMailer;
		$mail->IsSMTP();
		$mail->CharSet = 'UTF-8';
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->Port = 465;
		$mail->Username = "infodispendukcapiljember@gmail.com";
		$mail->Password = "infodispendukcapiljember-01";
		$mail->SMTPAuth= true;
		$mail->SMTPSecure = 'ssl';
		$mail->From = "infodispendukcapiljember@gmail.com";
		$mail->FromName= "Layanan Online Dispenduk Capil Jember";
		$mail->isHTML(true);
		$mail->Subject = $Subject;
		$mail->Body = $Message;
		$mail->addAddress($Email);
		if(!$mail->send()){
			$Status = TRUE;
		}else{
			$Status = FALSE;
		}
		return $Status;
	}
}

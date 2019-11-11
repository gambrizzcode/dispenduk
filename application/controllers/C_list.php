<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_list extends CI_Controller {

	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$sess_login = $this->session->userdata('login');
		if(empty($sess_login)){
			$this->session->sess_destroy();
			redirect("C_themes");
		}else{
			// print_r($sess_login);
			$this->data_sess = array(
				'nik'       	=> $sess_login['nik'],
				'email'     	=> $sess_login['email'],
				'nama'      	=> $sess_login['nama'],
				'status'    	=> $sess_login['status'],
				'foto_profil' 	=> $sess_login['foto_profil'],
				'role'      	=> $sess_login['role']
			);
		}
	}

	public function index(){
		if ($this->data_sess['role'] == "ADMIN") {
			$this->grid_list();
		}elseif ($this->data_sess['role'] == "USER") {
			
		}else{
			// echo $this->data_sess['role'];
			$this->session->sess_destroy();
			redirect("C_themes");
		}
	}
	
	public function grid_list(){
		$PageNumber					= $this->uri->segment(3)+0;
		$Limit						= 15;
		$PageLimit					= $PageNumber*$Limit;

		$qdata_list					= "SELECT * FROM permohonan ORDER BY tanggal DESC";
		$Row_Accunt					= $this->M_akun->q_data($qdata_list)->num_rows();
		$Page						= $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->data['No']			= $PageLimit;
		$this->data['qdatalist']	= $this->M_akun->q_data($qdata_list, $PageLimit, $Limit)->result();
		$this->data['pagging']		= $this->M_akun->pagging_hal($PageNumber, $Row_Accunt, $Limit, $Page);

		$this->data['page']			= "list/grid_list";
		$this->load->view('themes',$this->data);
	}

	public function status_permohonan(){
		$id_reg = $this->uri->segment(3);
		$qdata_status = "SELECT * FROM permohonan INNER JOIN status ON permohonan.id_reg = status.id_reg WHERE permohonan.id_reg = '$id_reg' AND status.status <> '' ORDER BY status.tgl_status DESC";
		$Row_data   = $this->M_akun->q_data($qdata_status)->num_rows();
		if ($Row_data >= 1) {
			$this->data['ada']       	= 1;
			$this->data['dari']			= $this->uri->segment(4);
			$this->data['id_reg']	 	= $id_reg;
			$this->data['qdatastatus'] 	= $this->M_akun->q_data($qdata_status)->result();
			$this->data['page']      	= "list/status_permohonan";
			$this->load->view('themes',$this->data);
		}else{
			$this->data['ada']       	= 0;
			$this->data['dari']			= $this->uri->segment(4);
			$this->data['id_reg']	 	= $id_reg;
			$this->data['qdatastatus'] 	= $this->M_akun->q_data($qdata_status)->result();
			$this->data['page']      	= "list/status_permohonan";
			$this->load->view('themes',$this->data);
		}

	}

	public function finalisasi(){
		$id_reg    = $this->db->escape_str($this->uri->segment(3));
		$is_status = md5("id_status".time().date('dmYhis').$id_reg);
		$id_status = strtoupper(substr($is_status, 0, 8));

		$qdata_status 				= "SELECT user.email AS email FROM permohonan INNER JOIN user ON permohonan.nik_pemohon = user.nik WHERE permohonan.id_reg = '$id_reg' ORDER BY permohonan.tanggal DESC";
		$Baris_status 				= $this->M_akun->q_data($qdata_status)->num_rows();
		if ($Baris_status >= 1) {
			$email = $this->M_akun->q_data($qdata_status)->row();
		}else{
			$email = '';
		}
		$emailp	   = $email->email;
		//isi tabel status full
		$data_status = array(
			'id_status'		=> $id_status,
			'id_reg'		=> $id_reg,
			'tgl_status'	=> date('Y-m-d H:i:s'),
			'status'		=> 'Finalisasi',
			'ket'			=> 'Permohonan Terkirim.'
		);
		//update permohonan set status = id_status di atas
		$data_status_permohonan = array(
			'id_status'		=> $id_status
		);

		if ($this->M_akun->add_status($data_status)) {
			$aemail	= $emailp;
			$subjeq = 'Status Permohonan '.$id_reg;
			$pesang	= '
				Permohonan Status dengan Id Register '.$id_reg.' telah diperbarui dengan detail sebagai berikut.<br>
				Status : Finalisasi<br>
				Keterangan : Permohonan Terkirim<br>
			';
			$this->M_akun->send_mail($aemail,$subjeq,$pesang);
		}else{
			echo "<h1>GAGAL</h1>";
		}

		// $this->M_akun->add_status($data_status);

		$this->M_akun->update_record('permohonan',$data_status_permohonan,'id_reg',$id_reg);

		redirect($this->uri->segment(4));

	}

	public function form_status(){
		$this->data['id_reg'] 		= $this->uri->segment(3);
		$id_reg						= $this->uri->segment(3);
		$qdata_status 				= "SELECT user.email AS email FROM permohonan INNER JOIN user ON permohonan.nik_pemohon = user.nik WHERE permohonan.id_reg = '$id_reg' ORDER BY permohonan.tanggal DESC";
		$Baris_status 				= $this->M_akun->q_data($qdata_status)->num_rows();
		if ($Baris_status >= 1) {
			$email = $this->M_akun->q_data($qdata_status)->row();
		}else{
			$email = '';
		}
		$this->data['emailp']		= $email->email;
		$this->data['dari'] 		= $this->uri->segment(4);
		$this->data['page']			= "list/form_status";
		$this->load->view('themes',$this->data);
	}

	public function save_status(){
		$id_reg    = $this->db->escape_str($this->input->post('id_reg'));
		$is_status = md5("id_status".time().date('dmYhis').$id_reg);
		$id_status = strtoupper(substr($is_status, 0, 8));
		$dari 	   = $this->db->escape_str($this->input->post('dari'));
		$emailp    = $this->db->escape_str($this->input->post('emailp'));
		$data_status = array(
			'id_status'		=> $id_status,
			'id_reg'		=> $id_reg,
			'tgl_status'	=> date('Y-m-d H:i:s'),
			'status'		=> $this->db->escape_str($this->input->post('status')),
			'ket'			=> $this->db->escape_str($this->input->post('ket'))
		);
		//update permohonan set status = id_status di atas
		$data_status_permohonan = array(
			'id_status'		=> $id_status
		);

		if ($this->M_akun->add_status($data_status)) {
			$aemail	= $emailp;
			$subjeq = 'Status Permohonan '.$id_reg;
			$pesang	= '
				Permohonan Status dengan Id Register '.$id_reg.' telah diperbarui dengan detail sebagai berikut.<br>
				Status : '.$_POST["status"].'<br>
				Keterangan : '.$_POST["ket"].'<br>
			';
			$this->M_akun->send_mail($aemail,$subjeq,$pesang);
		}else{
			echo "<h1>GAGAL</h1>";
		}

		$this->M_akun->update_record('permohonan',$data_status_permohonan,'id_reg',$id_reg);
		
		redirect('c_list/status_permohonan/'.$id_reg.'/'.$dari,'refresh');
		// $this->data['page']	= "list/form_status";
		// $this->load->view('themes',$this->data);
	}

	public function end_status(){
		$id_reg    = $this->db->escape_str($this->uri->segment(3));
		$is_status = md5("id_status".time().date('dmYhis').$id_reg);
		$id_status = strtoupper(substr($is_status, 0, 8));
		$dari 	   = $this->db->escape_str($this->uri->segment(4));

		$qdata_status 				= "SELECT user.email AS email FROM permohonan INNER JOIN user ON permohonan.nik_pemohon = user.nik WHERE permohonan.id_reg = '$id_reg' ORDER BY permohonan.tanggal DESC";
		$Baris_status 				= $this->M_akun->q_data($qdata_status)->num_rows();
		if ($Baris_status >= 1) {
			$email = $this->M_akun->q_data($qdata_status)->row();
		}else{
			$email = '';
		}

		$emailp	   = $email->email;

		$data_status = array(
			'id_status'		=> $id_status,
			'id_reg'		=> $id_reg,
			'tgl_status'	=> date('Y-m-d H:i:s'),
			'status'		=> 'END',
			'ket'			=> 'Permohonan Selesai'
		);

		//update permohonan set status = id_status di atas
		$data_status_permohonan = array(
			'id_status'		=> $id_status
		);

		if ($this->M_akun->add_status($data_status)) {
			$aemail	= $emailp;
			$subjeq = 'Status Permohonan '.$id_reg;
			$pesang	= '
				Permohonan Status dengan Id Register '.$id_reg.' telah diperbarui dengan detail sebagai berikut.<br>
				Status : END<br>
				Keterangan : Permohonan Selesai<br>
			';
			$this->M_akun->send_mail($aemail,$subjeq,$pesang);
		}else{
			echo "<h1>GAGAL</h1>";
		}

		$this->M_akun->update_record('permohonan',$data_status_permohonan,'id_reg',$id_reg);

		// $this->M_akun->add_status($data_status);
		redirect('c_list/status_permohonan/'.$id_reg.'/'.$dari,'refresh');
		// $this->data['page']	= "list/form_status";
		// $this->load->view('themes',$this->data);
	}

	public function detail_list(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM permohonan WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']               = $data->row()->id_reg;
			$this->data['tanggal']          	= $data->row()->tanggal;
			$this->data['nik_pemohon']          = $data->row()->nik_pemohon;
			$this->data['nama_pemohon']         = $data->row()->nama_pemohon;
			$this->data['jenis']                = $data->row()->jenis;
			$this->data['id_status']    		= $data->row()->id_status;
			$this->data['ket']                  = $data->row()->ket;
		}       
		$this->data['page'] = "list/detail_list";
		$this->load->view('themes',$this->data);
	}

	public function form_mohon(){
		$this->data['params'] 		= $this->uri->segment(3);
		$this->data['page']			= "list/form_permohonan";
		$this->load->view('themes',$this->data);
	}

	public function cetak_permohonan(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM permohonan WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']               = $data->row()->id_reg;
			$this->data['tanggal']          	= $data->row()->tanggal;
			$this->data['nik_pemohon']          = $data->row()->nik_pemohon;
			$this->data['nama_pemohon']         = $data->row()->nama_pemohon;
			$this->data['jenis']                = $data->row()->jenis;
			$this->data['id_status']    		= $data->row()->id_status;
			$this->data['ket']                  = $data->row()->ket;
		}		
		$this->load->view("list/cetak_permohonan",$this->data);
	}

	public function save_mohon(){
		$ada 	= md5($this->db->escape_str($this->input->post('nik')).$this->db->escape_str($this->input->post('nama')).time());
		$adaid 	= strtoupper(substr($ada, 0, 8));
		// $is_status = md5("id_status".time().date('dmYhis').$adaid);
		// $id_status = strtoupper(substr($is_status, 0, 8));
		$tgl 	= date('Y-m-d');
		$params = $this->input->post('jenis');
		$this->data_permohonan['id_reg'] 			= $adaid;
		$this->data_permohonan['tanggal'] 			= $tgl;
		$this->data_permohonan['nik_pemohon']		= $this->db->escape_str($this->input->post('nik'));
		$this->data_permohonan['nama_pemohon']		= $this->db->escape_str($this->input->post('nama'));
		$this->data_permohonan['jenis']				= $this->db->escape_str($this->input->post('jenis'));
		$this->data_permohonan['id_status']			= '';
		$this->data_permohonan['ket']				= '';
		// $data_permohonan = array(
		// 	'id_reg' 		=> $adaid,
		// 	'tanggal' 		=> $tgl,
		// 	'nik_pemohon'	=> $this->db->escape_str($this->input->post('nik')),
		// 	'nama_pemohon'	=> $this->db->escape_str($this->input->post('nama')),
		// 	'jenis'			=> $this->db->escape_str($this->input->post('jenis')),
		// 	'status'		=> '',
		// 	'ket'			=> ''
		// );
		if($params == "Permohonan Pembuatan Akte Kelahiran"){
			// require_once(APPPATH.'controllers\C_lahir.php');
			// $lanjut = new C_lahir();
			// $lanjut->save_lahir($this->data_permohonan);
			// redirect('c_lahir/save_lahir/'.$this->data_permohonan,'location');
			$this->load->view('lahir/validasi_lahir',$this->data_permohonan);
			// $this->load->library('../controllers/C_lahir');
			// $this->C_lahir->save_lahir($this->data_permohonan);
			// redirect('c_lahir/save_lahir',$this->data_permohonan);
		}else{}
		if($params == "mati"){
			
		}else{}
		if($params == "ktpbaru"){
			
		}else{}
		if($params == "ktprusak"){
			
		}else{}
		if($params == "rekamktp"){
			
		}else{}
		if($params == "Permohonan Pencetakan KK Baru"){
			$this->load->view('kkbaru/validasi_kkbaru',$this->data_permohonan);
		}else{}
		if($params == "kkhilang"){
			
		}else{}
		if($params == "Permohonan Pembuatan/Pencetakan KIA"){
			$this->load->view('kia/validasi_kia',$this->data_permohonan);
		}else{}
		if($params == "pindah"){
			
		}else{}
		if($params == "Pengaduan Online"){
			$this->load->view('p_online/validasi_p_online',$this->data_permohonan);
		}else{}
	}
}

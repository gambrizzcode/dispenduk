<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_p_online extends CI_Controller {
	function __construct(){
		parent::__construct();
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
			$this->grid_p_online();
		}elseif ($this->data_sess['role'] == "USER") {
			$this->front_p_online();
		}else{
			// echo $this->data_sess['role'];
			$this->session->sess_destroy();
			redirect("C_themes");
		}
	}

	public function grid_p_online(){
		$PageNumber                 = $this->uri->segment(3)+0;
		$Limit                      = 15;
		$PageLimit                  = $PageNumber*$Limit;

		$qdata_p_online                = "SELECT * FROM permohonan INNER JOIN p_online ON permohonan.id_reg = p_online.id_reg ORDER BY permohonan.tanggal DESC";
		$Row_Accunt                 = $this->M_akun->q_data($qdata_p_online)->num_rows();
		$Page                       = $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->data['No']           = $PageLimit;
		$this->data['qdatap_online']  = $this->M_akun->q_data($qdata_p_online, $PageLimit, $Limit)->result();
		$this->data['pagging']      = $this->M_akun->pagging_hal($PageNumber, $Row_Accunt, $Limit, $Page);

		$this->data['page']         = "p_online/grid_p_online";
		$this->load->view('themes',$this->data);
	}

	public function front_p_online(){
		$nik_user   = $this->data_sess['nik'];
		$nama_user  = $this->data_sess['nama'];
		$jenis      = "Pengaduan Online";

		//semua record dalam satu permohonan pada user tsb // 2
		$qdata_p_online = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis' ORDER BY tanggal DESC";
		$Row_data   = $this->M_akun->q_data($qdata_p_online)->num_rows();

		//record dalam satu permohonan yg berstatus END // 1
		$qdata2 = "SELECT permohonan.* FROM permohonan INNER JOIN status ON permohonan.id_status = status.id_status WHERE permohonan.nik_pemohon = '$nik_user' AND permohonan.nama_pemohon = '$nama_user' AND permohonan.jenis = '$jenis' AND status.status = 'END' ORDER BY permohonan.tanggal DESC";
		$Row2   = $this->M_akun->q_data($qdata2)->num_rows();

		//record dalam satu permohonan yg berstatus selain END // 0
		$qdata3 = "SELECT permohonan.* FROM permohonan INNER JOIN status ON permohonan.id_status = status.id_status WHERE permohonan.nik_pemohon = '$nik_user' AND permohonan.nama_pemohon = '$nama_user' AND permohonan.jenis = '$jenis' AND status.status <> 'END' ORDER BY permohonan.tanggal DESC";
		$Row3   = $this->M_akun->q_data($qdata3)->num_rows();

		//record dalam satu permohonan yg belum berstatus // 1
		$qdata4 = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis' AND id_status = ''";
		$Row4   = $this->M_akun->q_data($qdata4)->num_rows();

		if (($Row_data == $Row3 && $Row_data != 0) || ($Row_data == $Row4 && $Row_data != 1)) { // 1 - 0 - 1 - 0
			$this->data['ada']       	= 101;
			$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata_p_online)->result();
			$this->data['page']      	= "p_online/front_p_online";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data == $Row2 && $Row_data != 0) { // 1 - 1- 0 - 0
			$this->data['ada']       	= 110;
			$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata_p_online)->result();
			$this->data['page']      	= "p_online/front_p_online";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row3 && $Row_data != 0) { // 2 - 1 - 1 - 0
			$this->data['ada']       	= 3;
			$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata3)->result();
			$this->data['page']      	= "p_online/front_p_online";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row4 && $Row_data != 0) { // 2 - 1 - 0 - 1
			$this->data['ada']       	= 4;
			$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata4)->result();
			$this->data['page']      	= "p_online/front_p_online";
			$this->load->view('themes',$this->data);
		}else{
			$this->data['ada']       	= 0;
			$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata_p_online)->result();
			$this->data['page']      	= "p_online/front_p_online";
			$this->load->view('themes',$this->data);
		}

		// $qdata_p_online = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis'";
		// $Row_data   = $this->M_akun->q_data($qdata_p_online)->num_rows();
		// if ($Row_data == 1) {
		// 	$this->data['ada']       		= 1;
		// 	$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata_p_online)->result();
		// 	$this->data['page'] 			= "p_online/front_p_online";
		// 	$this->load->view('themes',$this->data);
		// }else{
		// 	$this->data['ada']       		= 0;
		// 	$this->data['qdatap_online'] 	= $this->M_akun->q_data($qdata_p_online)->result();
		// 	$this->data['page'] 			= "p_online/front_p_online";
		// 	$this->load->view('themes',$this->data);
		// }
	}

	public function form_p_online(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM p_online WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']	= $data->row()->id_reg;			
			$this->data['nik']		= $data->row()->nik;
			$this->data['nama']		= $data->row()->nama;
			$this->data['subjek']	= $data->row()->subjek;
			$this->data['uraian']	= $data->row()->uraian;
			$this->data['waktu']	= $data->row()->waktu;
			$this->data['bukti1']	= $data->row()->bukti1;
			$this->data['bukti2']	= $data->row()->bukti2;
			$this->data['bukti3']	= $data->row()->bukti3;
			$this->data['ket']		= $data->row()->ket;
		}       
		$this->data['page'] = "p_online/form_p_online";
		$this->load->view('themes',$this->data);
	}

	public function save_p_online(){
		$data_permohonan = array(
			'id_reg'        => $this->db->escape_str($this->input->post('id_reg')),
			'tanggal'       => $this->db->escape_str($this->input->post('tanggal')),
			'nik_pemohon'   => $this->db->escape_str($this->input->post('nik_pemohon')),
			'nama_pemohon'  => $this->db->escape_str($this->input->post('nama_pemohon')),
			'jenis'         => $this->db->escape_str($this->input->post('jenis')),
			'id_status'     => $this->db->escape_str($this->input->post('id_status')),
			'ket'           => $this->db->escape_str($this->input->post('ket'))
		);

		$data_p_online = array(
			'id_reg'		=> $this->db->escape_str($this->input->post('id_reg')),
			'nik'			=> '',
			'nama'			=> '',
			'subjek'		=> '',
			'uraian'		=> '',
			'waktu'			=> '',
			'bukti1'		=> '',
			'bukti2'		=> '',
			'bukti3'		=> '',
			'ket'			=> ''
		);

		$this->M_akun->add_permohonan($data_permohonan);
		$this->M_akun->add_p_online($data_p_online);

		$this->session->set_flashdata('pesan','Berhasil !!<hr>');
		redirect('c_p_online/front_p_online','refresh');
	}

	public function do_upload(){
		ini_set("max_file_uploads", '999');
		ini_set('memory_limit','128M');
		ini_set('upload_max_filesize','128M');
		ini_set('post_max_size','128M');

		$config['upload_path']      = APPPATH."../img/";
		$config['allowed_types']    = 'jpg|jpeg|png|bmp|JPG|JPEG|PNG|BMP';
		$config['max_size']     	= 102400;
        $config['max_width']    	= 3840;
        $config['max_height']   	= 2160;

		$this->load->library('upload', $config);

		$id_form    = $this->db->escape_str($this->input->post('id_reg'));
		$data       = $this->M_akun->query_all("SELECT * FROM p_online WHERE id_reg = '$id_form'");

		if ($data->row()->bukti1 == "" || $data->row()->bukti1 == "img/" && $_FILES['bukti1']['name'] != "") {
			$this->upload->do_upload('bukti1');
			$this->upload_bukti1 = "img/".str_replace(" ","_",$_FILES['bukti1']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->bukti2 == "" || $data->row()->bukti2 == "img/" && $_FILES['bukti2']['name'] != "") {
			$this->upload->do_upload('bukti2');
			$this->upload_bukti2 = "img/".str_replace(" ","_",$_FILES['bukti2']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->bukti3 == "" || $data->row()->bukti3 == "img/" && $_FILES['bukti3']['name'] != "") {
			$this->upload->do_upload('bukti3');
			$this->upload_bukti3 = "img/".str_replace(" ","_",$_FILES['bukti3']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->bukti1 != "" && $_FILES['bukti1']['name'] != "") {
			$this->upload->do_upload('bukti1');
			unlink($data->row()->bukti1);
			$this->upload_bukti1 = "img/".str_replace(" ","_",$_FILES['bukti1']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->bukti2 != "" && $_FILES['bukti2']['name'] != "") {
			$this->upload->do_upload('bukti2');
			unlink($data->row()->bukti2);
			$this->upload_bukti2 = "img/".str_replace(" ","_",$_FILES['bukti2']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->bukti3 != "" && $_FILES['bukti3']['name'] != "") {
			$this->upload->do_upload('bukti3');
			unlink($data->row()->bukti3);
			$this->upload_bukti3 = "img/".str_replace(" ","_",$_FILES['bukti3']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->bukti1 != "" && $_FILES['bukti1']['name'] == "") {
			$this->upload_bukti1 = $data->row()->bukti1;
		}
		if ($data->row()->bukti2 != "" && $_FILES['bukti2']['name'] == "") {
			$this->upload_bukti2 = $data->row()->bukti2;
		}
		if ($data->row()->bukti3 != "" && $_FILES['bukti3']['name'] == "") {
			$this->upload_bukti3 = $data->row()->bukti3;
		}

		if ($this->update_p_online()) {
			
		}else{
			$this->session->set_flashdata('pesan','GAGAL !!<hr>');
			redirect('c_p_online','refresh');
		}
	}

	public function update_p_online(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			// 'id_reg'         => $id_reg,
			'id_reg'	=> $this->db->escape_str($this->input->post('id_reg')),
			'nik'		=> $this->db->escape_str($this->input->post('nik')),
			'nama'		=> $this->db->escape_str($this->input->post('nama')),
			'subjek'	=> $this->db->escape_str($this->input->post('subjek')),
			'uraian'	=> $this->db->escape_str($this->input->post('uraian')),
			'waktu'		=> date('Y-m-d H:i:s'),
			'bukti1'	=> $this->upload_bukti1,
			'bukti2'	=> $this->upload_bukti2,
			'bukti3'	=> $this->upload_bukti3,
			'ket'		=> $this->db->escape_str($this->input->post('ket'))
		);

		$this->M_akun->update_record('p_online',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('c_p_online','refresh');
	}

	public function detail_p_online(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM p_online WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']	= $data->row()->id_reg;			
			$this->data['nik']		= $data->row()->nik;
			$this->data['nama']		= $data->row()->nama;
			$this->data['subjek']	= $data->row()->subjek;
			$this->data['uraian']	= $data->row()->uraian;
			$this->data['waktu']	= $data->row()->waktu;
			$this->data['bukti1']	= $data->row()->bukti1;
			$this->data['bukti2']	= $data->row()->bukti2;
			$this->data['bukti3']	= $data->row()->bukti3;
			$this->data['ket']		= $data->row()->ket;
		}       
		$this->data['page'] = "p_online/detail_p_online";
		$this->load->view('themes',$this->data);
	}

	public function cetak_p_online(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM p_online WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']	= $data->row()->id_reg;			
			$this->data['nik']		= $data->row()->nik;
			$this->data['nama']		= $data->row()->nama;
			$this->data['subjek']	= $data->row()->subjek;
			$this->data['uraian']	= $data->row()->uraian;
			$this->data['waktu']	= $data->row()->waktu;
			$this->data['bukti1']	= $data->row()->bukti1;
			$this->data['bukti2']	= $data->row()->bukti2;
			$this->data['bukti3']	= $data->row()->bukti3;
			$this->data['ket']		= $data->row()->ket;
		}
		$this->load->view("p_online/cetak_p_online",$this->data);
	}

	public function timeline(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data1       = $this->M_akun->query_all("SELECT 
			p_online.id_reg AS id_reg_utama,
			p_online.nik AS nik,
			p_online.nama AS nama,
			p_online.subjek AS subjek,
			p_online.uraian AS uraian_utama,
			p_online.waktu AS waktu_utama,
			reply.id_reply AS id_reply,
			reply.id_reg AS id_reg_balasan,
			reply.waktu AS waktu_balasan,
			reply.uraian AS uraian_balasan,
			reply.role AS role_balasan
		 FROM p_online INNER JOIN reply ON p_online.id_reg = reply.id_reg WHERE p_online.id_reg = '$id_form' ORDER BY reply.waktu DESC");
		if($data1->num_rows()>=1 || $data1->num_rows()>0 || $data1->num_rows() != 0 || $data1->num_rows() != "" || $data1->num_rows() != " "){
			$this->data['ada']					= 1;
			$this->data['qdata1'] = $data1->result();

			$this->data['id_reg_utama']			= $data1->row()->id_reg_utama;
			$this->data['nik']					= $data1->row()->nik;
			$this->data['nama']					= $data1->row()->nama;
			$this->data['subjek']				= $data1->row()->subjek;
			$this->data['uraian_utama']			= $data1->row()->uraian_utama;
			$this->data['waktu_utama']			= $data1->row()->waktu_utama;
			$this->data['id_reply']				= $data1->row()->id_reply;
			$this->data['id_reg_balasan']		= $data1->row()->id_reg_balasan;
			$this->data['waktu_balasan']		= $data1->row()->waktu_balasan;
			$this->data['uraian_balasan']		= $data1->row()->uraian_balasan;
			$this->data['role_balasan']			= $data1->row()->role_balasan;
		}else{
			// echo $data->num_rows();
			$data2 = $this->M_akun->query_all("SELECT * FROM p_online WHERE id_reg = '$id_form' ORDER BY waktu DESC");
			$this->data['qdata1'] = $data2->result();
			$this->data['ada']					= 0;
			$this->data['id_reg_utama']			= $data2->row()->id_reg;
			$this->data['nik']					= $data2->row()->nik;
			$this->data['nama']					= $data2->row()->nama;
			$this->data['subjek']				= $data2->row()->subjek;
			$this->data['uraian_utama']			= $data2->row()->uraian;
			$this->data['waktu_utama']			= $data2->row()->waktu;
		}

		$this->data['page'] = "p_online/timeline";
		$this->load->view('themes',$this->data);
	}

	public function reply(){
		$id_reg 	= $this->db->escape_str($this->input->post('id_reg'));
		$is_reply  	= md5("id_reply".time().date('dmYhis').$id_reg);
		$id_reply  	= strtoupper(substr($is_reply, 0, 8));
		$data_reply = array(
			'id_reply'		=> $id_reply,
			'id_reg'		=> $id_reg,
			'waktu'			=> date('Y-m-d H:i:s'),		
			'uraian'		=> $this->db->escape_str($this->input->post('uraian_baru')),
			'role'			=> $_SESSION['login']['role'],
			'ket'			=> ''
		);

		$this->M_akun->add_reply($data_reply);

		$this->session->set_flashdata('pesan','Berhasil !!<hr>');
		redirect('c_p_online/timeline/'.$id_reg.'/p_online','refresh');
	}

}

/* End of file C_p_online.php */
/* Location: ./application/controllers/C_p_online.php */
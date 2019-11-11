<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kkbaru extends CI_Controller {

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
			$this->grid_kkbaru();
		}elseif ($this->data_sess['role'] == "USER") {
			$this->front_kkbaru();
		}else{
			// echo $this->data_sess['role'];
			$this->session->sess_destroy();
			redirect("C_themes");
		}
	}

	public function front_kkbaru(){
		$nik_user   = $this->data_sess['nik'];
		$nama_user  = $this->data_sess['nama'];
		$jenis      = "Permohonan Pencetakan KK Baru";

		//semua record dalam satu permohonan pada user tsb // 2
		$qdata_kkbaru = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis' ORDER BY tanggal DESC";
		$Row_data   = $this->M_akun->q_data($qdata_kkbaru)->num_rows();

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
			$this->data['qdatakkbaru'] 	= $this->M_akun->q_data($qdata_kkbaru)->result();
			$this->data['page']      	= "kkbaru/front_kkbaru";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data == $Row2 && $Row_data != 0) { // 1 - 1- 0 - 0
			$this->data['ada']       	= 110;
			$this->data['qdatakkbaru'] 	= $this->M_akun->q_data($qdata_kkbaru)->result();
			$this->data['page']      	= "kkbaru/front_kkbaru";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row3 && $Row_data != 0) { // 2 - 1 - 1 - 0
			$this->data['ada']       	= 3;
			$this->data['qdatakkbaru'] 	= $this->M_akun->q_data($qdata3)->result();
			$this->data['page']      	= "kkbaru/front_kkbaru";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row4 && $Row_data != 0) { // 2 - 1 - 0 - 1
			$this->data['ada']       	= 4;
			$this->data['qdatakkbaru'] 	= $this->M_akun->q_data($qdata4)->result();
			$this->data['page']      	= "kkbaru/front_kkbaru";
			$this->load->view('themes',$this->data);
		}else{
			$this->data['ada']       	= 0;
			$this->data['qdatakkbaru'] 	= $this->M_akun->q_data($qdata_kkbaru)->result();
			$this->data['page']      	= "kkbaru/front_kkbaru";
			$this->load->view('themes',$this->data);
		}
	}

	public function grid_kkbaru(){
		$PageNumber                 = $this->uri->segment(3)+0;
		$Limit                      = 15;
		$PageLimit                  = $PageNumber*$Limit;

		$qdata_kkbaru                = "SELECT * FROM permohonan INNER JOIN kkbaru ON permohonan.id_reg = kkbaru.id_reg ORDER BY permohonan.tanggal DESC";
		$Row_Accunt                 = $this->M_akun->q_data($qdata_kkbaru)->num_rows();
		$Page                       = $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->data['No']           = $PageLimit;
		$this->data['qdatakkbaru']  = $this->M_akun->q_data($qdata_kkbaru, $PageLimit, $Limit)->result();
		$this->data['pagging']      = $this->M_akun->pagging_hal($PageNumber, $Row_Accunt, $Limit, $Page);

		$this->data['page']         = "kkbaru/grid_kkbaru";
		$this->load->view('themes',$this->data);
	}

	public function form_kkbaru(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM kkbaru WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']	= $data->row()->id_reg;
			$this->data['kk']		= $data->row()->kk;
			$this->data['nik']		= $data->row()->nik;
			$this->data['nama']		= $data->row()->nama;
			$this->data['sk']		= $data->row()->sk;
			$this->data['ktp']		= $data->row()->ktp;
			$this->data['f101']		= $data->row()->f101;
			$this->data['ket']		= $data->row()->ket;
		}       
		$this->data['page'] = "kkbaru/form_kkbaru";
		$this->load->view('themes',$this->data);
	}

	public function save_kkbaru($data_permohonan = ""){
		$data_permohonan = array(
			'id_reg'        => $this->db->escape_str($this->input->post('id_reg')),
			'tanggal'       => $this->db->escape_str($this->input->post('tanggal')),
			'nik_pemohon'   => $this->db->escape_str($this->input->post('nik_pemohon')),
			'nama_pemohon'  => $this->db->escape_str($this->input->post('nama_pemohon')),
			'jenis'         => $this->db->escape_str($this->input->post('jenis')),
			'id_status'     => $this->db->escape_str($this->input->post('id_status')),
			'ket'           => $this->db->escape_str($this->input->post('ket'))
		);

		$data_kkbaru = array(
			'id_reg'	=> $this->db->escape_str($this->input->post('id_reg')),
			'kk'		=> '',
			'nik'		=> '',
			'nama'		=> '',
			'sk'		=> '',
			'ktp'		=> '',
			'f101'		=> '',
			'ket'		=> ''
		);

		$this->M_akun->add_permohonan($data_permohonan);
		$this->M_akun->add_kkbaru($data_kkbaru);

		$this->session->set_flashdata('pesan','Berhasil !!<hr>');
		redirect('c_kkbaru/front_kkbaru','refresh');
	}

	public function do_upload(){
		ini_set("max_file_uploads", '999');
		ini_set('memory_limit','128M');
		ini_set('upload_max_filesize','128M');
		ini_set('post_max_size','128M');

		$config['upload_path']      = APPPATH."../img/";
		$config['allowed_types']    = 'jpg|jpeg|png|bmp|JPG|JPEG|PNG|BMP';
		$config['max_size']     	= 102400;
        $config['max_width']    	= 1920;
        $config['max_height']   	= 1080;

		$this->load->library('upload', $config);

		$id_form    = $this->db->escape_str($this->input->post('id_reg'));
		$data       = $this->M_akun->query_all("SELECT * FROM kkbaru WHERE id_reg = '$id_form'");

		if ($data->row()->sk == "" || $data->row()->sk == "img/" && $_FILES['sk']['name'] != "") {
			$this->upload->do_upload('sk');
			$this->nama_sk = "img/".str_replace(" ","_",$_FILES['sk']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->ktp == "" || $data->row()->ktp == "img/" && $_FILES['ktp']['name'] != "") {
			$this->upload->do_upload('ktp');
			$this->nama_ktp = "img/".str_replace(" ","_",$_FILES['ktp']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->f101 == "" || $data->row()->f101 == "img/" && $_FILES['f101']['name'] != "") {
			$this->upload->do_upload('f101');
			$this->nama_f101 = "img/".str_replace(" ","_",$_FILES['f101']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->sk != "" && $_FILES['sk']['name'] != "") {
			$this->upload->do_upload('sk');
			unlink($data->row()->sk);
			$this->nama_sk = "img/".str_replace(" ","_",$_FILES['sk']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->ktp != "" && $_FILES['ktp']['name'] != "") {
			$this->upload->do_upload('ktp');
			unlink($data->row()->ktp);
			$this->nama_ktp = "img/".str_replace(" ","_",$_FILES['ktp']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->f101 != "" && $_FILES['f101']['name'] != "") {
			$this->upload->do_upload('f101');
			unlink($data->row()->f101);
			$this->nama_f101 = "img/".str_replace(" ","_",$_FILES['f101']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->sk != "" && $_FILES['sk']['name'] == "") {
			$this->nama_sk = $data->row()->sk;
		}
		if ($data->row()->ktp != "" && $_FILES['ktp']['name'] == "") {
			$this->nama_ktp = $data->row()->ktp;
		}
		if ($data->row()->f101 != "" && $_FILES['f101']['name'] == "") {
			$this->nama_f101 = $data->row()->f101;
		}

		
		if ($this->update_kkbaru()) {
			
		}else{
			$this->session->set_flashdata('pesan','GAGAL !!<hr>');
			redirect('c_kkbaru','refresh');
		}

	}

	public function update_kkbaru(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			// 'id_reg'         => $id_reg,
			'id_reg'	=> $this->db->escape_str($this->input->post('id_reg')),
			'kk'		=> $this->db->escape_str($this->input->post('kk')),
			'nik'		=> $this->db->escape_str($this->input->post('nik')),
			'nama'		=> $this->db->escape_str($this->input->post('nama')),
			'sk'		=> $this->nama_sk,
			'ktp'		=> $this->nama_ktp,
			'f101'		=> $this->nama_f101,
			'ket'		=> $this->db->escape_str($this->input->post('ket'))
		);

		$this->M_akun->update_record('kkbaru',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('c_kkbaru','refresh');
	}

	public function detail_kkbaru(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM kkbaru WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']	= $data->row()->id_reg;
			$this->data['kk']		= $data->row()->kk;
			$this->data['nik']		= $data->row()->nik;
			$this->data['nama']		= $data->row()->nama;
			$this->data['sk']		= $data->row()->sk;
			$this->data['ktp']		= $data->row()->ktp;
			$this->data['f101']		= $data->row()->f101;
			$this->data['ket']		= $data->row()->ket;
		}       
		$this->data['page'] = "kkbaru/detail_kkbaru";
		$this->load->view('themes',$this->data);
	}

	public function cetak_kkbaru(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM kkbaru WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']	= $data->row()->id_reg;
			$this->data['kk']		= $data->row()->kk;
			$this->data['nik']		= $data->row()->nik;
			$this->data['nama']		= $data->row()->nama;
			$this->data['sk']		= $data->row()->sk;
			$this->data['ktp']		= $data->row()->ktp;
			$this->data['f101']		= $data->row()->f101;
			$this->data['ket']		= $data->row()->ket;
		}       
		$this->load->view("kkbaru/cetak_kkbaru",$this->data);
	}

	public function delete_kkbaru(){
		$id_reg = $this->uri->segment(3);
		$this->M_akun->delete_record('permohonan','id_reg',$id_reg);
		$this->M_akun->delete_record('kkbaru','id_reg',$id_reg);
		$this->M_akun->delete_record('status','id_reg',$id_reg);

		$this->session->set_flashdata('pesan','Delete Data Berhasil !!<hr>');
		redirect('C_kkbaru','refresh');
	}

}

/* End of file C_kkbaru.php */
/* Location: ./application/controllers/C_kkbaru.php */
?>
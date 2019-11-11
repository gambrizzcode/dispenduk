<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_kia extends CI_Controller {

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
			$this->grid_kia();
		}elseif ($this->data_sess['role'] == "USER") {
			$this->front_kia();
		}else{
			// echo $this->data_sess['role'];
			$this->session->sess_destroy();
			redirect("C_themes");
		}
	}

	public function front_kia(){
		$nik_user   = $this->data_sess['nik'];
		$nama_user  = $this->data_sess['nama'];
		$jenis      = "Permohonan Pembuatan/Pencetakan KIA";

		//semua record dalam satu permohonan pada user tsb // 2
		$qdata_kia = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis' ORDER BY tanggal DESC";
		$Row_data   = $this->M_akun->q_data($qdata_kia)->num_rows();

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
			$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata_kia)->result();
			$this->data['page']      	= "kia/front_kia";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data == $Row2 && $Row_data != 0) { // 1 - 1- 0 - 0
			$this->data['ada']       	= 110;
			$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata_kia)->result();
			$this->data['page']      	= "kia/front_kia";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row3 && $Row_data != 0) { // 2 - 1 - 1 - 0
			$this->data['ada']       	= 3;
			$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata3)->result();
			$this->data['page']      	= "kia/front_kia";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row4 && $Row_data != 0) { // 2 - 1 - 0 - 1
			$this->data['ada']       	= 4;
			$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata4)->result();
			$this->data['page']      	= "kia/front_kia";
			$this->load->view('themes',$this->data);
		}else{
			$this->data['ada']       	= 0;
			$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata_kia)->result();
			$this->data['page']      	= "kia/front_kia";
			$this->load->view('themes',$this->data);
		}

		// $qdata_kia = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis'";
		// $Row_data   = $this->M_akun->q_data($qdata_kia)->num_rows();
		// if ($Row_data == 1) {
		// 	$this->data['ada']       	= 1;
		// 	$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata_kia)->result();
		// 	$this->data['page']      	= "kia/front_kia";
		// 	$this->load->view('themes',$this->data);
		// }else{
		// 	$this->data['ada']       	= 0;
		// 	$this->data['qdatakia'] 	= $this->M_akun->q_data($qdata_kia)->result();
		// 	$this->data['page']      	= "kia/front_kia";
		// 	$this->load->view('themes',$this->data);
		// }
	}

	public function grid_kia(){
		$PageNumber                 = $this->uri->segment(3)+0;
		$Limit                      = 15;
		$PageLimit                  = $PageNumber*$Limit;

		$qdata_kia                  = "SELECT * FROM permohonan INNER JOIN kia ON permohonan.id_reg = kia.id_reg ORDER BY permohonan.tanggal DESC";
		$Row_Accunt                 = $this->M_akun->q_data($qdata_kia)->num_rows();
		$Page                       = $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->data['No']           = $PageLimit;
		$this->data['qdatakia']		= $this->M_akun->q_data($qdata_kia, $PageLimit, $Limit)->result();
		$this->data['pagging']      = $this->M_akun->pagging_hal($PageNumber, $Row_Accunt, $Limit, $Page);

		$this->data['page']         = "kia/grid_kia";
		$this->load->view('themes',$this->data);
	}

	public function form_kia(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM kia WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']			= $data->row()->id_reg;
			$this->data['nik_anak']			= $data->row()->nik_anak;
			$this->data['nama']				= $data->row()->nama;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nama_kk']			= $data->row()->nama_kk;
			$this->data['no_akta']			= $data->row()->no_akta;
			$this->data['agama']			= $data->row()->agama;
			$this->data['kewarganegaraan']	= $data->row()->kewarganegaraan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['upload_kk']		= $data->row()->upload_kk;
			$this->data['upload_akta']		= $data->row()->upload_akta;
			$this->data['ktp_ortu']			= $data->row()->ktp_ortu;
			$this->data['pas_foto']			= $data->row()->pas_foto;
			$this->data['ket']				= $data->row()->ket;
		}       
		$this->data['page'] = "kia/form_kia";
		$this->load->view('themes',$this->data);
	}

	public function save_kia($data_permohonan = ""){
		$data_permohonan = array(
			'id_reg'        => $this->db->escape_str($this->input->post('id_reg')),
			'tanggal'       => $this->db->escape_str($this->input->post('tanggal')),
			'nik_pemohon'   => $this->db->escape_str($this->input->post('nik_pemohon')),
			'nama_pemohon'  => $this->db->escape_str($this->input->post('nama_pemohon')),
			'jenis'         => $this->db->escape_str($this->input->post('jenis')),
			'id_status'     => $this->db->escape_str($this->input->post('id_status')),
			'ket'           => $this->db->escape_str($this->input->post('ket'))
		);

		$data_kia = array(
			'id_reg'			=> $this->db->escape_str($this->input->post('id_reg')),
			'nik_anak'			=> '',
			'nama'				=> '',
			'tempat_lahir'		=> '',
			'tgl_lahir'			=> '',
			'jk'				=> '',
			'nkk'				=> '',
			'nama_kk'			=> '',
			'no_akta'			=> '',
			'agama'				=> '',
			'kewarganegaraan'	=> '',
			'alamat'			=> '',
			'rt'				=> '',
			'rw'				=> '',
			'kecamatan'			=> '',
			'kelurahan'			=> '',
			'upload_kk'			=> '',
			'upload_akta'		=> '',
			'ktp_ortu'			=> '',
			'pas_foto'			=> '',
			'ket'				=> ''
		);

		$this->M_akun->add_permohonan($data_permohonan);
		$this->M_akun->add_kia($data_kia);

		$this->session->set_flashdata('pesan','Berhasil !!<hr>');
		redirect('c_kia/front_kia','refresh');
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
		$data       = $this->M_akun->query_all("SELECT * FROM kia WHERE id_reg = '$id_form'");

		if ($data->row()->upload_kk == "" || $data->row()->upload_kk == "img/" && $_FILES['upload_kk']['name'] != "") {
			$this->upload->do_upload('upload_kk');
			$this->nama_upload_kk = "img/".str_replace(" ","_",$_FILES['upload_kk']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->upload_akta == "" || $data->row()->upload_akta == "img/" && $_FILES['upload_akta']['name'] != "") {
			$this->upload->do_upload('upload_akta');
			$this->nama_upload_akta = "img/".str_replace(" ","_",$_FILES['upload_akta']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->ktp_ortu == "" || $data->row()->ktp_ortu == "img/" && $_FILES['ktp_ortu']['name'] != "") {
			$this->upload->do_upload('ktp_ortu');
			$this->nama_ktp_ortu = "img/".str_replace(" ","_",$_FILES['ktp_ortu']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->pas_foto == "" || $data->row()->pas_foto == "img/" && $_FILES['pas_foto']['name'] != "") {
			$this->upload->do_upload('pas_foto');
			$this->nama_pas_foto = "img/".str_replace(" ","_",$_FILES['pas_foto']['name']);
			//db kosong + form ada = upload
		}
		if ($data->row()->upload_kk != "" && $_FILES['upload_kk']['name'] != "") {
			$this->upload->do_upload('upload_kk');
			unlink($data->row()->upload_kk);
			$this->nama_upload_kk = "img/".str_replace(" ","_",$_FILES['upload_kk']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->upload_akta != "" && $_FILES['upload_akta']['name'] != "") {
			$this->upload->do_upload('upload_akta');
			unlink($data->row()->upload_akta);
			$this->nama_upload_akta = "img/".str_replace(" ","_",$_FILES['upload_akta']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->ktp_ortu != "" && $_FILES['ktp_ortu']['name'] != "") {
			$this->upload->do_upload('ktp_ortu');
			unlink($data->row()->ktp_ortu);
			$this->nama_ktp_ortu = "img/".str_replace(" ","_",$_FILES['ktp_ortu']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->pas_foto != "" && $_FILES['pas_foto']['name'] != "") {
			$this->upload->do_upload('pas_foto');
			unlink($data->row()->pas_foto);
			$this->nama_pas_foto = "img/".str_replace(" ","_",$_FILES['pas_foto']['name']);
			//db ada + form ada = upload & ganti
		}
		if ($data->row()->upload_kk != "" && $_FILES['upload_kk']['name'] == "") {
			$this->nama_upload_kk = $data->row()->upload_kk;
		}
		if ($data->row()->upload_akta != "" && $_FILES['upload_akta']['name'] == "") {
			$this->nama_upload_akta = $data->row()->upload_akta;
		}
		if ($data->row()->ktp_ortu != "" && $_FILES['ktp_ortu']['name'] == "") {
			$this->nama_ktp_ortu = $data->row()->ktp_ortu;
		}
		if ($data->row()->pas_foto != "" && $_FILES['pas_foto']['name'] == "") {
			$this->nama_pas_foto = $data->row()->pas_foto;
		}

		
		if ($this->update_kia()) {
			
		}else{
			$this->session->set_flashdata('pesan','GAGAL !!<hr>');
			redirect('c_kia','refresh');
		}
	}

	public function update_kia(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			'id_reg'			=> $this->db->escape_str($this->input->post('id_reg')),
			'nik_anak'			=> $this->db->escape_str($this->input->post('nik_anak')),
			'nama'				=> $this->db->escape_str($this->input->post('nama')),
			'tempat_lahir'		=> $this->db->escape_str($this->input->post('tempat_lahir')),
			'tgl_lahir'			=> $this->db->escape_str($this->input->post('tgl_lahir')),
			'jk'				=> $this->db->escape_str($this->input->post('jk')),
			'nkk'				=> $this->db->escape_str($this->input->post('nkk')),
			'nama_kk'			=> $this->db->escape_str($this->input->post('nama_kk')),
			'no_akta'			=> $this->db->escape_str($this->input->post('no_akta')),
			'agama'				=> $this->db->escape_str($this->input->post('agama')),
			'kewarganegaraan'	=> $this->db->escape_str($this->input->post('kewarganegaraan')),
			'alamat'			=> $this->db->escape_str($this->input->post('alamat')),
			'rt'				=> $this->db->escape_str($this->input->post('rt')),
			'rw'				=> $this->db->escape_str($this->input->post('rw')),
			'kecamatan'			=> $this->db->escape_str($this->input->post('kecamatan')),
			'kelurahan'			=> $this->db->escape_str($this->input->post('kelurahan')),
			'upload_kk'			=> $this->nama_upload_kk,
			'upload_akta'		=> $this->nama_upload_akta,
			'ktp_ortu'			=> $this->nama_ktp_ortu,
			'pas_foto'			=> $this->nama_pas_foto,
			'ket'				=> $this->db->escape_str($this->input->post('ket'))
		);

		$this->M_akun->update_record('kia',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('c_kia','refresh');
	}

	public function detail_kia(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM kia WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']			= $data->row()->id_reg;
			$this->data['nik_anak']			= $data->row()->nik_anak;
			$this->data['nama']				= $data->row()->nama;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nama_kk']			= $data->row()->nama_kk;
			$this->data['no_akta']			= $data->row()->no_akta;
			$this->data['agama']			= $data->row()->agama;
			$this->data['kewarganegaraan']	= $data->row()->kewarganegaraan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['upload_kk']		= $data->row()->upload_kk;
			$this->data['upload_akta']		= $data->row()->upload_akta;
			$this->data['ktp_ortu']			= $data->row()->ktp_ortu;
			$this->data['pas_foto']			= $data->row()->pas_foto;
			$this->data['ket']				= $data->row()->ket;
		}       
		$this->data['page'] = "kia/detail_kia";
		$this->load->view('themes',$this->data);
	}

	public function cetak_kia(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM kia WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']			= $data->row()->id_reg;
			$this->data['nik_anak']			= $data->row()->nik_anak;
			$this->data['nama']				= $data->row()->nama;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nama_kk']			= $data->row()->nama_kk;
			$this->data['no_akta']			= $data->row()->no_akta;
			$this->data['agama']			= $data->row()->agama;
			$this->data['kewarganegaraan']	= $data->row()->kewarganegaraan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['upload_kk']		= $data->row()->upload_kk;
			$this->data['upload_akta']		= $data->row()->upload_akta;
			$this->data['ktp_ortu']			= $data->row()->ktp_ortu;
			$this->data['pas_foto']			= $data->row()->pas_foto;
			$this->data['ket']				= $data->row()->ket;
		}       
		$this->load->view("kia/cetak_kia",$this->data);
	}

	public function delete_kia(){
		$id_reg = $this->uri->segment(3);
		$this->M_akun->delete_record('permohonan','id_reg',$id_reg);
		$this->M_akun->delete_record('kia','id_reg',$id_reg);
		$this->M_akun->delete_record('status','id_reg',$id_reg);

		$this->session->set_flashdata('pesan','Delete Data Berhasil !!<hr>');
		redirect('C_kia','refresh');
	}

}

/* End of file C_kia.php */
/* Location: ./application/controllers/C_kia.php */
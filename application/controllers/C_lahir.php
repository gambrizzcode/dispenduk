<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_lahir extends CI_Controller {

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
				'nik'       => $sess_login['nik'],
				'email'     => $sess_login['email'],
				'nama'      => $sess_login['nama'],
				'status'    => $sess_login['status'],
				'role'      => $sess_login['role']
			);
		}
	}

	public function index(){
		// print_r($this->data_sess);
		if ($this->data_sess['role'] == "ADMIN") {
			$this->grid_lahir();
		}elseif ($this->data_sess['role'] == "USER") {
			$this->front_lahir();
		}else{
			// echo $this->data_sess['role'];
			$this->session->sess_destroy();
			redirect("C_themes");
		}
	}

	public function front_lahir(){//jika user biasa
		$nik_user   = $this->data_sess['nik'];
		$nama_user  = $this->data_sess['nama'];
		$jenis      = "Permohonan Pembuatan Akte Kelahiran";

		//semua record dalam satu permohonan pada user tsb // 1
		$qdata_lahir = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis' ORDER BY tanggal DESC";
		$Row_data   = $this->M_akun->q_data($qdata_lahir)->num_rows();

		//record dalam satu permohonan yg berstatus END // 0
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
			$this->data['qdatauser'] 	= $this->M_akun->q_data($qdata_lahir)->result();
			$this->data['page']      	= "lahir/front_lahir";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data == $Row2 && $Row_data != 0) { // 1 - 1- 0 - 0
			$this->data['ada']       	= 110;
			$this->data['qdatauser'] 	= $this->M_akun->q_data($qdata_lahir)->result();
			$this->data['page']      	= "lahir/front_lahir";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row3 && $Row_data != 0) { // 2 - 1 - 1 - 0
			$this->data['ada']       	= 3;
			$this->data['qdatauser'] 	= $this->M_akun->q_data($qdata3)->result();
			$this->data['page']      	= "lahir/front_lahir";
			$this->load->view('themes',$this->data);
		}elseif ($Row_data-$Row2 == $Row4 && $Row_data != 0) { // 2 - 1 - 0 - 1
			$this->data['ada']       	= 4;
			$this->data['qdatauser'] 	= $this->M_akun->q_data($qdata4)->result();
			$this->data['page']      	= "lahir/front_lahir";
			$this->load->view('themes',$this->data);
		}else{
			$this->data['ada']       	= 0;
			$this->data['qdatauser'] 	= $this->M_akun->q_data($qdata_lahir)->result();
			$this->data['page']      	= "lahir/front_lahir";
			$this->load->view('themes',$this->data);
		}

		// $qdata_user = "SELECT * FROM permohonan WHERE nik_pemohon = '$nik_user' AND nama_pemohon = '$nama_user' AND jenis = '$jenis' ORDER BY tanggal DESC";
		// $Row_data   = $this->M_akun->q_data($qdata_user)->num_rows();
		// if ($Row_data >= 1) {
		// 	$this->data['ada']       = 1;
		// 	$this->data['qdatauser'] = $this->M_akun->q_data($qdata_user)->result();
		// 	$this->data['page']      = "lahir/front_lahir";
		// 	$this->load->view('themes',$this->data);
		// }else{
		// 	$this->data['ada']       = 0;
		// 	$this->data['qdatauser'] = $this->M_akun->q_data($qdata_user)->result();
		// 	$this->data['page']      = "lahir/front_lahir";
		// 	$this->load->view('themes',$this->data);
		// }
	}

	public function grid_lahir(){//jika admin
		$PageNumber                 = $this->uri->segment(3)+0;
		$Limit                      = 15;
		$PageLimit                  = $PageNumber*$Limit;

		$qdata_lahir                = "SELECT * FROM permohonan INNER JOIN lahir_bayi ON permohonan.id_reg = lahir_bayi.id_reg ORDER BY permohonan.tanggal DESC";
		$Row_Accunt                 = $this->M_akun->q_data($qdata_lahir)->num_rows();
		$Page                       = $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->data['No']           = $PageLimit;
		$this->data['qdatalahir']   = $this->M_akun->q_data($qdata_lahir, $PageLimit, $Limit)->result();
		$this->data['pagging']      = $this->M_akun->pagging_hal($PageNumber, $Row_Accunt, $Limit, $Page);

		$this->data['page']         = "lahir/grid_lahir";
		$this->load->view('themes',$this->data);
	}

	public function save_lahir($data_permohonan = ""){
		$data_permohonan = array(
			'id_reg'        => $this->db->escape_str($this->input->post('id_reg')),
			'tanggal'       => $this->db->escape_str($this->input->post('tanggal')),
			'nik_pemohon'   => $this->db->escape_str($this->input->post('nik_pemohon')),
			'nama_pemohon'  => $this->db->escape_str($this->input->post('nama_pemohon')),
			'jenis'         => $this->db->escape_str($this->input->post('jenis')),
			'id_status'     => $this->db->escape_str($this->input->post('id_status')),
			'ket'           => $this->db->escape_str($this->input->post('ket'))
		);

		// $data_status = array(
		// 	'id_status'		=> $this->db->escape_str($this->input->post('id_status')),
		// 	'id_reg'		=> $this->db->escape_str($this->input->post('id_reg')),
		// 	'tgl_status'	=> date('Y-m-d - H:i:s'),
		// 	'status'		=> '',
		// 	'ket'			=> ''
		// );

		$data_lahir_bayi = array(
			'id_reg'            => $this->db->escape_str($this->input->post('id_reg')),
			'nik_bayi'          => '',
			'nama'              => '',
			'jk'                => '',
			'tempat_dilahirkan' => '',
			'tempat_lahir'      => '',
			'tgl_lahir'         => '',
			'waktu'             => '',
			'jenis_lahir'       => '',
			'lahir_ke'          => '',
			'penolong'          => '',
			'berat'             => '',
			'panjang'           => '',
			'nkk'               => '',
			'nama_kk'           => '',
			'ket'               => ''
		);

		$data_lahir_ibu = array(
			'id_reg'            => $this->db->escape_str($this->input->post('id_reg')),
			'nik_ibu'           => '',
			'nama'              => '',
			'tgl_lahir'         => '',
			'kerja'             => '',
			'alamat'            => '',
			'rt'                => '',
			'rw'                => '',
			'kecamatan'         => '',
			'kelurahan'         => '',
			'kewarganegaraan'   => '',
			'kebangsaan'        => '',
			'tgl_kawin'         => '',
			'ket'               => ''
		);

		$data_lahir_bapak = array(
			'id_reg'            => $this->db->escape_str($this->input->post('id_reg')),
			'nik_bapak'         => '',
			'nama'              => '',
			'tgl_lahir'         => '',
			'kerja'             => '',
			'alamat'            => '',
			'rt'                => '',
			'rw'                => '',
			'kecamatan'         => '',
			'kelurahan'         => '',
			'kewarganegaraan'   => '',
			'kebangsaan'        => '',
			'tgl_kawin'         => '',
			'ket'               => ''
		);

		$data_lahir_saksi1 = array(
			'id_reg'            => $this->db->escape_str($this->input->post('id_reg')),
			'nik_saksi1'        => '',
			'nama'              => '',
			'umur'              => '',
			'jk'                => '',
			'tgl_lahir'         => '',
			'kerja'             => '',
			'alamat'            => '',
			'rt'                => '',
			'rw'                => '',
			'kecamatan'         => '',
			'kelurahan'         => '',
			'ket'               => ''
		);

		$data_lahir_saksi2 = array(
			'id_reg'            => $this->db->escape_str($this->input->post('id_reg')),
			'nik_saksi2'        => '',
			'nama'              => '',
			'umur'              => '',
			'jk'                => '',
			'tgl_lahir'         => '',
			'kerja'             => '',
			'alamat'            => '',
			'rt'                => '',
			'rw'                => '',
			'kecamatan'         => '',
			'kelurahan'         => '',
			'ket'               => ''
		);

		$data_lahir_administrasi = array(
			'id_reg'            => $this->db->escape_str($this->input->post('id_reg')),
			'surat_kelahiran'   => '',
			'ktp_saksi'         => '',
			'kk_ortu'           => '',
			'ktp_ortu'          => '',
			'akta_nikah'        => '',
			'sptjm_lahir'       => '',
			'sptjm_pasangan'    => '',
			'no_hp'             => '',
			'ket'               => ''
		);

		$this->M_akun->add_permohonan($data_permohonan);
		// $this->M_akun->add_status($data_status);
		$this->M_akun->add_lahir_bayi($data_lahir_bayi);
		$this->M_akun->add_lahir_ibu($data_lahir_ibu);
		$this->M_akun->add_lahir_bapak($data_lahir_bapak);
		$this->M_akun->add_lahir_saksi1($data_lahir_saksi1);
		$this->M_akun->add_lahir_saksi2($data_lahir_saksi2);
		$this->M_akun->add_lahir_administrasi($data_lahir_administrasi);

		redirect('c_lahir/front_lahir','refresh');
	}

	public function detail_lahir(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM permohonan WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']       = $data->row()->id_reg;
			$this->data['tanggal']      = $data->row()->tanggal;
			$this->data['nik_pemohon']  = $data->row()->nik_pemohon;
			$this->data['nama_pemohon'] = $data->row()->nama_pemohon;
			$this->data['jenis']        = $data->row()->jenis;
			$this->data['id_status']    = $data->row()->id_status;
			$this->data['ket']          = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_lahir";
		$this->load->view('themes',$this->data);
	}

	public function cetak_lahir(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM permohonan WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']       = $data->row()->id_reg;
			$this->data['tanggal']      = $data->row()->tanggal;
			$this->data['nik_pemohon']  = $data->row()->nik_pemohon;
			$this->data['nama_pemohon'] = $data->row()->nama_pemohon;
			$this->data['jenis']        = $data->row()->jenis;
			$this->data['id_status']    = $data->row()->id_status;
			$this->data['ket']          = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_lahir",$this->data);
	}

	public function delete_lahir(){
		$id_reg = $this->uri->segment(3);
		$this->M_akun->delete_record('permohonan','id_reg',$id_reg);
		$this->M_akun->delete_record('lahir_bayi','id_reg',$id_reg);
		$this->M_akun->delete_record('lahir_bapak','id_reg',$id_reg);
		$this->M_akun->delete_record('lahir_ibu','id_reg',$id_reg);
		$this->M_akun->delete_record('lahir_saksi1','id_reg',$id_reg);
		$this->M_akun->delete_record('lahir_saksi2','id_reg',$id_reg);
		$this->M_akun->delete_record('lahir_administrasi','id_reg',$id_reg);
		$this->M_akun->delete_record('status','id_reg',$id_reg);

		$this->session->set_flashdata('pesan','Delete Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}

	public function form_bayi(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_bayi WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']               = $data->row()->id_reg;
			$this->data['nik_bayi']             = $data->row()->nik_bayi;
			$this->data['nama']                 = $data->row()->nama;
			$this->data['jk']                   = $data->row()->jk;
			$this->data['tempat_dilahirkan']    = $data->row()->tempat_dilahirkan;
			$this->data['tempat_lahir']         = $data->row()->tempat_lahir;
			$this->data['tgl_lahir']            = $data->row()->tgl_lahir;
			$this->data['waktu']                = $data->row()->waktu;
			$this->data['jenis_lahir']          = $data->row()->jenis_lahir;
			$this->data['lahir_ke']             = $data->row()->lahir_ke;
			$this->data['penolong']             = $data->row()->penolong;
			$this->data['berat']                = $data->row()->berat;
			$this->data['panjang']              = $data->row()->panjang;
			$this->data['nkk']                  = $data->row()->nkk;
			$this->data['nama_kk']              = $data->row()->nama_kk;
			$this->data['ket']                  = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/form_bayi";
		$this->load->view('themes',$this->data);
	}

	public function detail_bayi(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_bayi WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']               = $data->row()->id_reg;
			$this->data['nik_bayi']             = $data->row()->nik_bayi;
			$this->data['nama']                 = $data->row()->nama;
			$this->data['jk']                   = $data->row()->jk;
			$this->data['tempat_dilahirkan']    = $data->row()->tempat_dilahirkan;
			$this->data['tempat_lahir']         = $data->row()->tempat_lahir;
			$this->data['tgl_lahir']            = $data->row()->tgl_lahir;
			$this->data['waktu']                = $data->row()->waktu;
			$this->data['jenis_lahir']          = $data->row()->jenis_lahir;
			$this->data['lahir_ke']             = $data->row()->lahir_ke;
			$this->data['penolong']             = $data->row()->penolong;
			$this->data['berat']                = $data->row()->berat;
			$this->data['panjang']              = $data->row()->panjang;
			$this->data['nkk']                  = $data->row()->nkk;
			$this->data['nama_kk']              = $data->row()->nama_kk;
			$this->data['ket']                  = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_bayi";
		$this->load->view('themes',$this->data);
	}

	public function cetak_bayi(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_bayi WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']               = $data->row()->id_reg;
			$this->data['nik_bayi']             = $data->row()->nik_bayi;
			$this->data['nama']                 = $data->row()->nama;
			$this->data['jk']                   = $data->row()->jk;
			$this->data['tempat_dilahirkan']    = $data->row()->tempat_dilahirkan;
			$this->data['tempat_lahir']         = $data->row()->tempat_lahir;
			$this->data['tgl_lahir']            = $data->row()->tgl_lahir;
			$this->data['waktu']                = $data->row()->waktu;
			$this->data['jenis_lahir']          = $data->row()->jenis_lahir;
			$this->data['lahir_ke']             = $data->row()->lahir_ke;
			$this->data['penolong']             = $data->row()->penolong;
			$this->data['berat']                = $data->row()->berat;
			$this->data['panjang']              = $data->row()->panjang;
			$this->data['nkk']                  = $data->row()->nkk;
			$this->data['nama_kk']              = $data->row()->nama_kk;
			$this->data['ket']                  = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_bayi",$this->data);
	}

	public function update_bayi(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			// 'id_reg'         => $id_reg,
			'nik_bayi'          => $this->db->escape_str($this->input->post('nik_bayi')),
			'nama'              => $this->db->escape_str($this->input->post('nama')),
			'jk'                => $this->db->escape_str($this->input->post('jk')),
			'tempat_dilahirkan' => $this->db->escape_str($this->input->post('tempat_dilahirkan')),
			'tempat_lahir'      => $this->db->escape_str($this->input->post('tempat_lahir')),
			'tgl_lahir'         => $this->db->escape_str($this->input->post('tgl_lahir')),
			'waktu'             => $this->db->escape_str($this->input->post('waktu')),
			'jenis_lahir'       => $this->db->escape_str($this->input->post('jenis_lahir')),
			'lahir_ke'          => $this->db->escape_str($this->input->post('lahir_ke')),
			'penolong'          => $this->db->escape_str($this->input->post('penolong')),
			'berat'             => $this->db->escape_str($this->input->post('berat')),
			'panjang'           => $this->db->escape_str($this->input->post('panjang')),
			'nkk'               => $this->db->escape_str($this->input->post('nkk')),
			'nama_kk'           => $this->db->escape_str($this->input->post('nama_kk')),
			'ket'               => $this->db->escape_str($this->input->post('ket'))
		);

		$this->M_akun->update_record('lahir_bayi',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}
	
	public function form_bapak(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_bapak WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_bapak']        = $data->row()->nik_bapak;
			$this->data['nama']             = $data->row()->nama;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['kewarganegaraan']  = $data->row()->kewarganegaraan;
			$this->data['kebangsaan']       = $data->row()->kebangsaan;
			$this->data['tgl_kawin']        = $data->row()->tgl_kawin;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/form_bapak";
		$this->load->view('themes',$this->data);
	}

	public function detail_bapak(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_bapak WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_bapak']        = $data->row()->nik_bapak;
			$this->data['nama']             = $data->row()->nama;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['kewarganegaraan']  = $data->row()->kewarganegaraan;
			$this->data['kebangsaan']       = $data->row()->kebangsaan;
			$this->data['tgl_kawin']        = $data->row()->tgl_kawin;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_bapak";
		$this->load->view('themes',$this->data);
	}

	public function cetak_bapak(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_bapak WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_bapak']        = $data->row()->nik_bapak;
			$this->data['nama']             = $data->row()->nama;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['kewarganegaraan']  = $data->row()->kewarganegaraan;
			$this->data['kebangsaan']       = $data->row()->kebangsaan;
			$this->data['tgl_kawin']        = $data->row()->tgl_kawin;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_bapak",$this->data);
	}

	public function update_bapak(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			'nik_bapak'         => $this->db->escape_str($this->input->post('nik_bapak')),
			'nama'              => $this->db->escape_str($this->input->post('nama')),
			'tgl_lahir'         => $this->db->escape_str($this->input->post('tgl_lahir')),
			'kerja'             => $this->db->escape_str($this->input->post('kerja')),
			'alamat'            => $this->db->escape_str($this->input->post('alamat')),
			'rt'                => $this->db->escape_str($this->input->post('rt')),
			'rw'                => $this->db->escape_str($this->input->post('rw')),
			'kecamatan'         => $this->db->escape_str($this->input->post('kecamatan')),
			'kelurahan'         => $this->db->escape_str($this->input->post('kelurahan')),
			'kewarganegaraan'   => $this->db->escape_str($this->input->post('kewarganegaraan')),
			'kebangsaan'        => $this->db->escape_str($this->input->post('kebangsaan')),
			'tgl_kawin'         => $this->db->escape_str($this->input->post('tgl_kawin')),
			'ket'               => $this->db->escape_str($this->input->post('ket'))
		);

		$this->M_akun->update_record('lahir_bapak',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}
	
	public function form_ibu(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_ibu WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_ibu']          = $data->row()->nik_ibu;
			$this->data['nama']             = $data->row()->nama;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['kewarganegaraan']  = $data->row()->kewarganegaraan;
			$this->data['kebangsaan']       = $data->row()->kebangsaan;
			$this->data['tgl_kawin']        = $data->row()->tgl_kawin;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/form_ibu";
		$this->load->view('themes',$this->data);
	}

	public function detail_ibu(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_ibu WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_ibu']          = $data->row()->nik_ibu;
			$this->data['nama']             = $data->row()->nama;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['kewarganegaraan']  = $data->row()->kewarganegaraan;
			$this->data['kebangsaan']       = $data->row()->kebangsaan;
			$this->data['tgl_kawin']        = $data->row()->tgl_kawin;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_ibu";
		$this->load->view('themes',$this->data);
	}

	public function cetak_ibu(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_ibu WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_ibu']          = $data->row()->nik_ibu;
			$this->data['nama']             = $data->row()->nama;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['kewarganegaraan']  = $data->row()->kewarganegaraan;
			$this->data['kebangsaan']       = $data->row()->kebangsaan;
			$this->data['tgl_kawin']        = $data->row()->tgl_kawin;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_ibu",$this->data);
	}

	public function update_ibu(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			'nik_ibu'           => $this->db->escape_str($this->input->post('nik_ibu')),
			'nama'              => $this->db->escape_str($this->input->post('nama')),
			'tgl_lahir'         => $this->db->escape_str($this->input->post('tgl_lahir')),
			'kerja'             => $this->db->escape_str($this->input->post('kerja')),
			'alamat'            => $this->db->escape_str($this->input->post('alamat')),
			'rt'                => $this->db->escape_str($this->input->post('rt')),
			'rw'                => $this->db->escape_str($this->input->post('rw')),
			'kecamatan'         => $this->db->escape_str($this->input->post('kecamatan')),
			'kelurahan'         => $this->db->escape_str($this->input->post('kelurahan')),
			'kewarganegaraan'   => $this->db->escape_str($this->input->post('kewarganegaraan')),
			'kebangsaan'        => $this->db->escape_str($this->input->post('kebangsaan')),
			'tgl_kawin'         => $this->db->escape_str($this->input->post('tgl_kawin')),
			'ket'               => $this->db->escape_str($this->input->post('ket'))
		);

		$this->M_akun->update_record('lahir_ibu',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}
	
	public function form_saksi1(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_saksi1 WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_saksi1']       = $data->row()->nik_saksi1;
			$this->data['nama']             = $data->row()->nama;
			$this->data['umur']             = $data->row()->umur;
			$this->data['jk']               = $data->row()->jk;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/form_saksi1";
		$this->load->view('themes',$this->data);
	}

	public function detail_saksi1(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_saksi1 WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_saksi1']       = $data->row()->nik_saksi1;
			$this->data['nama']             = $data->row()->nama;
			$this->data['umur']             = $data->row()->umur;
			$this->data['jk']               = $data->row()->jk;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_saksi1";
		$this->load->view('themes',$this->data);
	}

	public function cetak_saksi1(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_saksi1 WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_saksi1']       = $data->row()->nik_saksi1;
			$this->data['nama']             = $data->row()->nama;
			$this->data['umur']             = $data->row()->umur;
			$this->data['jk']               = $data->row()->jk;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_saksi1",$this->data);
	}

	public function update_saksi1(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			'nik_saksi1'        => $this->db->escape_str($this->input->post('nik_saksi1')),
			'nama'              => $this->db->escape_str($this->input->post('nama')),
			'umur'              => $this->db->escape_str($this->input->post('umur')),
			'jk'                => $this->db->escape_str($this->input->post('jk')),
			'tgl_lahir'         => $this->db->escape_str($this->input->post('tgl_lahir')),
			'kerja'             => $this->db->escape_str($this->input->post('kerja')),
			'alamat'            => $this->db->escape_str($this->input->post('alamat')),
			'rt'                => $this->db->escape_str($this->input->post('rt')),
			'rw'                => $this->db->escape_str($this->input->post('rw')),
			'kecamatan'         => $this->db->escape_str($this->input->post('kecamatan')),
			'kelurahan'         => $this->db->escape_str($this->input->post('kelurahan')),
			'ket'               => $this->db->escape_str($this->input->post('ket')),
		);

		$this->M_akun->update_record('lahir_saksi1',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}
	
	public function form_saksi2(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_saksi2 WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_saksi2']       = $data->row()->nik_saksi2;
			$this->data['nama']             = $data->row()->nama;
			$this->data['umur']             = $data->row()->umur;
			$this->data['jk']               = $data->row()->jk;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/form_saksi2";
		$this->load->view('themes',$this->data);
	}

	public function detail_saksi2(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_saksi2 WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_saksi2']       = $data->row()->nik_saksi2;
			$this->data['nama']             = $data->row()->nama;
			$this->data['umur']             = $data->row()->umur;
			$this->data['jk']               = $data->row()->jk;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_saksi2";
		$this->load->view('themes',$this->data);
	}

	public function cetak_saksi2(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_saksi2 WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['nik_saksi2']       = $data->row()->nik_saksi2;
			$this->data['nama']             = $data->row()->nama;
			$this->data['umur']             = $data->row()->umur;
			$this->data['jk']               = $data->row()->jk;
			$this->data['tgl_lahir']        = $data->row()->tgl_lahir;
			$this->data['kerja']            = $data->row()->kerja;
			$this->data['alamat']           = $data->row()->alamat;
			$this->data['rt']               = $data->row()->rt;
			$this->data['rw']               = $data->row()->rw;
			$this->data['kecamatan']        = $data->row()->kecamatan;
			$this->data['kelurahan']        = $data->row()->kelurahan;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_saksi2",$this->data);
	}

	public function update_saksi2(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));
		$data_update = array(
			'nik_saksi2'        => $this->db->escape_str($this->input->post('nik_saksi2')),
			'nama'              => $this->db->escape_str($this->input->post('nama')),
			'umur'              => $this->db->escape_str($this->input->post('umur')),
			'jk'                => $this->db->escape_str($this->input->post('jk')),
			'tgl_lahir'         => $this->db->escape_str($this->input->post('tgl_lahir')),
			'kerja'             => $this->db->escape_str($this->input->post('kerja')),
			'alamat'            => $this->db->escape_str($this->input->post('alamat')),
			'rt'                => $this->db->escape_str($this->input->post('rt')),
			'rw'                => $this->db->escape_str($this->input->post('rw')),
			'kecamatan'         => $this->db->escape_str($this->input->post('kecamatan')),
			'kelurahan'         => $this->db->escape_str($this->input->post('kelurahan')),
			'ket'               => $this->db->escape_str($this->input->post('ket')),
		);

		$this->M_akun->update_record('lahir_saksi2',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}
	
	public function form_administrasi(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_administrasi WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['surat_kelahiran']  = $data->row()->surat_kelahiran;
			$this->data['ktp_saksi']        = $data->row()->ktp_saksi;
			$this->data['kk_ortu']          = $data->row()->kk_ortu;
			$this->data['ktp_ortu']         = $data->row()->ktp_ortu;
			$this->data['akta_nikah']       = $data->row()->akta_nikah;
			$this->data['sptjm_lahir']      = $data->row()->sptjm_lahir;
			$this->data['sptjm_pasangan']   = $data->row()->sptjm_pasangan;
			$this->data['no_hp']            = $data->row()->no_hp;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/form_administrasi";
		$this->load->view('themes',$this->data);
	}
	
	public function do_upload(){
		ini_set("max_file_uploads", '999');
		ini_set('memory_limit','128M');
		ini_set('upload_max_filesize','128M');
		ini_set('post_max_size','128M');

		$config['upload_path']      = FCPATH."img/";
		$config['allowed_types']    = 'jpg|jpeg|png|bmp|JPG|JPEG|PNG|BMP';
		$config['max_size']     	= 102400;
        $config['max_width']    	= 3840;
        $config['max_height']   	= 2160;

		$this->load->library('upload', $config);

		$this->upload->do_upload('surat_kelahiran');
		$this->upload->do_upload('ktp_saksi');
		$this->upload->do_upload('kk_ortu');
		$this->upload->do_upload('ktp_ortu');
		$this->upload->do_upload('akta_nikah');
		$this->upload->do_upload('sptjm_lahir');
		$this->upload->do_upload('sptjm_pasangan');

		$this->update_administrasi();

		// if ($this->upload->do_upload('surat_kelahiran') || 
		// 	$this->upload->do_upload('ktp_saksi') || 
		// 	$this->upload->do_upload('kk_ortu') || 
		// 	$this->upload->do_upload('ktp_ortu') || 
		// 	$this->upload->do_upload('akta_nikah') || 
		// 	$this->upload->do_upload('sptjm_lahir') || 
		// 	$this->upload->do_upload('sptjm_pasangan')){
			
			// $this->update_administrasi();
		// }else{
		// 	echo "gagal";
		// 	$this->session->set_flashdata('pesan','GAGAL !!<hr>');
		// 	redirect('C_lahir','refresh');
		// }

	}

	public function update_administrasi(){
		$id_reg      = $this->db->escape_str($this->input->post('id_reg'));

		$datak		= $this->M_akun->query_all("SELECT * FROM lahir_administrasi WHERE id_reg = '$id_reg'");

		$folder	= 'img/';

		$file_name1 = $_FILES['surat_kelahiran']['name'];
		$file_name2 = $_FILES['ktp_saksi']['name'];
		$file_name3 = $_FILES['kk_ortu']['name'];
		$file_name4 = $_FILES['ktp_ortu']['name'];
		$file_name5 = $_FILES['akta_nikah']['name'];
		$file_name6 = $_FILES['sptjm_lahir']['name'];
		$file_name7 = $_FILES['sptjm_pasangan']['name'];

		$link1 = str_replace(" ","_",$file_name1);
		$link2 = str_replace(" ","_",$file_name2);
		$link3 = str_replace(" ","_",$file_name3);
		$link4 = str_replace(" ","_",$file_name4);
		$link5 = str_replace(" ","_",$file_name5);
		$link6 = str_replace(" ","_",$file_name6);
		$link7 = str_replace(" ","_",$file_name7);

		if($datak->num_rows()==1){//jika data ada
			if ($datak->row()->surat_kelahiran != "" || $datak->row()->surat_kelahiran == "" && $link1 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang1 = $datak->row()->surat_kelahiran;
			//jangan update
			}else{}
			if ($datak->row()->ktp_saksi != "" || $datak->row()->ktp_saksi == "" && $link2 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang2 = $datak->row()->ktp_saksi;
			//jangan update
			}else{}
			if ($datak->row()->kk_ortu != "" || $datak->row()->kk_ortu == "" && $link3 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang3 = $datak->row()->kk_ortu;
			//jangan update
			}else{}
			if ($datak->row()->ktp_ortu != "" || $datak->row()->ktp_ortu == "" && $link4 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang4 = $datak->row()->ktp_ortu;
			//jangan update
			}else{}
			if ($datak->row()->akta_nikah != "" || $datak->row()->akta_nikah == "" && $link5 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang5 = $datak->row()->akta_nikah;
			//jangan update
			}else{}
			if ($datak->row()->sptjm_lahir != "" || $datak->row()->sptjm_lahir == "" && $link6 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang6 = $datak->row()->sptjm_lahir;
			//jangan update
			}else{}
			if ($datak->row()->sptjm_pasangan != "" || $datak->row()->sptjm_pasangan == "" && $link7 == "") {//data lama ada atau data lama kosong dan data baru kosong
				$link_matang7 = $datak->row()->sptjm_pasangan;
			//jangan update
			}else{}

			//------------------------------------------------------------------------------------------------

			if ($datak->row()->surat_kelahiran == $link1) {//data lama dan data baru sama
				$link_matang1 = $datak->row()->surat_kelahiran;
			//jangan update
			}else{}

			//------------------------------------------------------------------------------------------------

			if ($datak->row()->surat_kelahiran == "" && $link1 != "") {//data lama tidak ada dan data baru ada
			$link_matang1 = $folder.$link1;
			//update
			}else{}
			if ($datak->row()->ktp_saksi == "" && $link2 != "") {//data lama tidak ada dan data baru ada
			$link_matang2 = $folder.$link2;
			//update
			}else{}
			if ($datak->row()->kk_ortu == "" && $link3 != "") {//data lama tidak ada dan data baru ada
			$link_matang3 = $folder.$link3;
			//update
			}else{}
			if ($datak->row()->ktp_ortu == "" && $link4 != "") {//data lama tidak ada dan data baru ada
			$link_matang4 = $folder.$link4;
			//update
			}else{}
			if ($datak->row()->akta_nikah == "" && $link5 != "") {//data lama tidak ada dan data baru ada
			$link_matang5 = $folder.$link5;
			//update
			}else{}
			if ($datak->row()->sptjm_lahir == "" && $link6 != "") {//data lama tidak ada dan data baru ada
			$link_matang6 = $folder.$link6;
			//update
			}else{}
			if ($datak->row()->sptjm_pasangan == "" && $link7 != "") {//data lama tidak ada dan data baru ada
			$link_matang7 = $folder.$link7;
			//update
			}else{}

			//------------------------------------------------------------------------------------------------

			if ($datak->row()->surat_kelahiran != "" && $link1 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->surat_kelahiran)) {
					unlink(FCPATH.$datak->row()->surat_kelahiran);
				}else{}
				$link_matang1 = $folder.$link1;
			//update
			}else{}
			if ($datak->row()->ktp_saksi != "" && $link2 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->ktp_saksi)) {
					unlink(FCPATH.$datak->row()->ktp_saksi);
				}else{}
				$link_matang2 = $folder.$link2;
			//update
			}else{}
			if ($datak->row()->kk_ortu != "" && $link3 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->kk_ortu)) {
					unlink(FCPATH.$datak->row()->kk_ortu);
				}else{}
				$link_matang3 = $folder.$link3;
			//update
			}else{}
			if ($datak->row()->ktp_ortu != "" && $link4 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->ktp_ortu)) {
					unlink(FCPATH.$datak->row()->ktp_ortu);
				}else{}
				$link_matang4 = $folder.$link4;
			//update
			}else{}
			if ($datak->row()->akta_nikah != "" && $link5 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->akta_nikah)) {
					unlink(FCPATH.$datak->row()->akta_nikah);
				}else{}
				$link_matang5 = $folder.$link5;
			//update
			}else{}
			if ($datak->row()->sptjm_lahir != "" && $link6 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->sptjm_lahir)) {
					unlink(FCPATH.$datak->row()->sptjm_lahir);
				}else{}
				$link_matang6 = $folder.$link6;
			//update
			}else{}
			if ($datak->row()->sptjm_pasangan != "" && $link7 != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->sptjm_pasangan)) {
					unlink(FCPATH.$datak->row()->sptjm_pasangan);
				}else{}
				$link_matang7 = $folder.$link7;
			//update
			}else{}

		}else{//jika data tidak ada
			echo "wkwkwk.. data tidak ada";
		}

		$data_update = array(
			'surat_kelahiran'  => $link_matang1,
			'ktp_saksi'        => $link_matang2,
			'kk_ortu'          => $link_matang3,
			'ktp_ortu'         => $link_matang4,
			'akta_nikah'       => $link_matang5,
			'sptjm_lahir'      => $link_matang6,
			'sptjm_pasangan'   => $link_matang7,
			'no_hp'            => $this->input->post('no_hp'),
			'ket'              => $this->input->post('ket')
		);

		$this->M_akun->update_record('lahir_administrasi',$data_update,'id_reg',$id_reg);
		$this->session->set_flashdata('pesan','Update Data Berhasil !!<hr>');
		redirect('C_lahir','refresh');
	}

	public function detail_administrasi(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_administrasi WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['surat_kelahiran']  = $data->row()->surat_kelahiran;
			$this->data['ktp_saksi']        = $data->row()->ktp_saksi;
			$this->data['kk_ortu']          = $data->row()->kk_ortu;
			$this->data['ktp_ortu']         = $data->row()->ktp_ortu;
			$this->data['akta_nikah']       = $data->row()->akta_nikah;
			$this->data['sptjm_lahir']      = $data->row()->sptjm_lahir;
			$this->data['sptjm_pasangan']   = $data->row()->sptjm_pasangan;
			$this->data['no_hp']            = $data->row()->no_hp;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->data['page'] = "lahir/detail_administrasi";
		$this->load->view('themes',$this->data);
	}

	public function cetak_administrasi(){
		$id_form    = $this->db->escape_str($this->uri->segment(3));
		$data       = $this->M_akun->query_all("SELECT * FROM lahir_administrasi WHERE id_reg = '$id_form'");
		if($data->num_rows()==1){
			$this->data['id_reg']           = $data->row()->id_reg;
			$this->data['surat_kelahiran']  = $data->row()->surat_kelahiran;
			$this->data['ktp_saksi']        = $data->row()->ktp_saksi;
			$this->data['kk_ortu']          = $data->row()->kk_ortu;
			$this->data['ktp_ortu']         = $data->row()->ktp_ortu;
			$this->data['akta_nikah']       = $data->row()->akta_nikah;
			$this->data['sptjm_lahir']      = $data->row()->sptjm_lahir;
			$this->data['sptjm_pasangan']   = $data->row()->sptjm_pasangan;
			$this->data['no_hp']            = $data->row()->no_hp;
			$this->data['ket']              = $data->row()->ket;
		}       
		$this->load->view("lahir/cetak_administrasi",$this->data);
	}
	
}

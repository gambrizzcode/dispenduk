<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_user extends CI_Controller {

	function __construct(){
		parent::__construct();
		$sess_login = $this->session->userdata('login');
		if(empty($sess_login)){
			$this->session->sess_destroy();
			redirect("C_themes");
		}else{
			// print_r($sess_login);
			$this->data_sess = array(
				'id_user'      	=> $sess_login['id_user'],
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
			$this->grid_user();
		}elseif ($this->data_sess['role'] == "USER") {
			redirect('c_user/profil/'.$this->data_sess['id_user'],'refresh');
			// $this->profil();
		}else{
			// echo $this->data_sess['role'];
			$this->session->sess_destroy();
			redirect("C_themes");
		}
	}

	function is_email_valid($email){
    	if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",trim($email))) {
    		return true;
    	}else{
    		return false;
    	}
    }

    public function verifikasi($key){
    	$this->M_akun->changeActiveState($key);
    	echo "<h3>Selamat Anda Telah Memverifikasi Akun Anda</h3>";
    	echo "<a href='".site_url('c_login')."'>Login Layanan Online Dispendukcapil Jember</a>";
    }

	public function aktivasi(){
		$id_user 	= $this->uri->segment(3);
		$data 		= $this->M_akun->query_all("SELECT * FROM user WHERE id_user = '$id_user'");
		$encrypted_id = md5($id_user);
		if($data->num_rows()==1){
			$dtid_user	= $data->row()->id_user;
			$dtnama		= $data->row()->nama;
			$dtnkk		= $data->row()->nkk;
			$dtnik		= $data->row()->nik;
			$dtemail	= $data->row()->email;
			$dtpassword	= $data->row()->confirm;

			$data_user = array(
				'status' => '2'
			);

			$valid = $this->is_email_valid($dtemail);
			if ($valid == true) {
				$aemail = $dtemail;

				$subjeq = 'Akun Pendaftaran Layanan Telah Aktif';

				$pesang = '
					Selamat Akun Pendaftaran Anda Pada Aplikasi SIP Dispendukcapil Kabupaten Jember telah aktif dengan data sebagai berikut;<br>
					Nama Lengkap : '.$dtnama.'<br>
					Nomor Kartu Keluarga : '.$dtnkk.'<br>
					Nomor Induk Kependudukan (NIK) : '.$dtnik.'<br>
					Alamat Email : '.$dtemail.'<br>
					Password : '.$dtpassword.'<br>
					Silahkan klik link dibawah ini untuk verifikasi akun anda lalu gunakan email dan password anda untuk login.
					'.site_url("c_user/verifikasi/$encrypted_id").'
					Kemudian lengkapi biodata/profil anda untuk melanjutkan permohonan layanan secara GRATIS.<br>
					Terimakasih.
				';
				$this->M_akun->send_mail($aemail,$subjeq,$pesang);

				$this->M_akun->update_record('user',$data_user,'id_user',$id_user);

				$this->session->set_flashdata('pesan','Aktivasi User Berhasil !!');

				redirect('c_user','refresh');

			}
		}
	}
	
	public function grid_user(){
		// if($this->input->post('submit')){
		// 	$txtSrcAkun				= $this->input->post('txtSrcAkun');
		// }else{
		// 	$txtSrcAkun				= $this->session->userdata('txtSrcAkun');
		// }
		// $this->session->set_userdata('txtSrcAkun',$txtSrcAkun);

		$PageNumber					= $this->uri->segment(3)+0;
		$Limit						= 15;
		$PageLimit					= $PageNumber*$Limit;

		$qdata_akun					= "SELECT * FROM user ORDER BY tgl_register DESC";
		$Row_Accunt					= $this->M_akun->q_data($qdata_akun)->num_rows();
		$Page						= $this->uri->segment(1)."/".$this->uri->segment(2);
		$this->data['No']			= $PageLimit;
		$this->data['qdataakun']	= $this->M_akun->q_data($qdata_akun, $PageLimit, $Limit)->result();
		$this->data['pagging']		= $this->M_akun->pagging_hal($PageNumber, $Row_Accunt, $Limit, $Page);

		// $this->data['txtSrcAkun']	= $txtSrcAkun;
		// $this->data['Alert_Akun']	= $this->session->userdata('Alert_Akun');
		$this->data['page']			= "user/grid_user";
		$this->load->view('themes',$this->data);
		// $this->session->unset_userdata('Alert_Akun');
	}

	public function form_user(){
		$id_userb	= $this->db->escape_str($this->uri->segment(3));
		$data		= $this->M_akun->query_all("SELECT * FROM user WHERE id_user = '$id_userb'");
		if($data->num_rows()==1){
			$this->data['id_user']			= $data->row()->id_user;
			$this->data['nama']				= $data->row()->nama;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nik']				= $data->row()->nik;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['email']			= $data->row()->email;
			$this->data['password']			= $data->row()->confirm;
			$this->data['confirm']			= $data->row()->confirm;
			$this->data['hp1']				= $data->row()->hp1;
			$this->data['hp2']				= $data->row()->hp2;
			$this->data['scan_kk']			= $data->row()->scan_kk;
			$this->data['scan_ktp']			= $data->row()->scan_ktp;
			$this->data['foto_profil']		= $data->row()->foto_profil;
			$this->data['role']				= $data->row()->role;
			$this->data['status']			= $data->row()->status;
			$this->data['tgl_register']		= $data->row()->tgl_register;
			$this->data['ket']				= $data->row()->ket;
		}else{
			$this->data['id_user']			= "";
			$this->data['nama']				= "";
			$this->data['nkk']				= "";
			$this->data['nik']				= "";
			$this->data['tempat_lahir']		= "";
			$this->data['tgl_lahir']		= "";
			$this->data['jk']				= "";
			$this->data['kecamatan']		= "";
			$this->data['kelurahan']		= "";
			$this->data['alamat']			= "";
			$this->data['rt']				= "";
			$this->data['rw']				= "";
			$this->data['email']			= "";
			$this->data['password']			= "";
			$this->data['confirm']			= "";
			$this->data['hp1']				= "";
			$this->data['hp2']				= "";
			$this->data['scan_kk']			= "";
			$this->data['scan_ktp']			= "";
			$this->data['foto_profil']		= "";
			$this->data['role']				= "";
			$this->data['status']			= "";
			$this->data['tgl_register']		= "";
			$this->data['ket']				= "";
		}
		
		$this->data['page']	= "user/form_user";
		$this->load->view('themes',$this->data);
	}

	function kec_ajax(){
		$qkadapat = $this->M_akun->kecamatan($_GET['kec']);
		$kadapat  = $qkadapat->result();
			echo "<option value=''>--- Pilih Desa / Kelurahan</option>";
		foreach ($kadapat as $kk => $vk) {
			echo "<option value=".$vk->desa.">".$vk->desa."</option>";
		}
	}

	public function do_upload(){
		ini_set("max_file_uploads", '999');
		ini_set('memory_limit','128M');
		ini_set('upload_max_filesize','128M');
		ini_set('post_max_size','128M');

		$config['upload_path']  	= FCPATH.'img/';
        $config['allowed_types']	= 'jpg|jpeg|png|bmp|JPG|JPEG|PNG|BMP';
        $config['max_size']     	= 102400;
        $config['max_width']    	= 3840;
        $config['max_height']   	= 2160;

        $this->load->library('upload', $config);

        // $this->upload->do_upload();

        $this->upload->do_upload('scan_kk');
        $this->upload->do_upload('scan_ktp'); 
        $this->upload->do_upload('foto_profil');

        $this->save_user();

   //      if ($this->upload->do_upload('scan_kk') || 
   //      	$this->upload->do_upload('scan_ktp') || 
   //      	$this->upload->do_upload('foto_profil')) {
        	
   //      	$this->save_user();
   //      }else{
   //      	$this->save_user();
   //      	echo "gagal";
			// // $this->session->set_flashdata('pesan','GAGAL !!<hr>');
			// // redirect('C_lahir','refresh');
   //      }
	}

	public function save_user(){
		$id_form = $this->db->escape_str($this->input->post('id_user'));
		if ($id_form == "") {
			$ada = md5($this->db->escape_str($this->input->post('nik')).$this->db->escape_str($this->input->post('nkk')).$this->db->escape_str($this->input->post('email')).time());
			$adaid = strtoupper(substr($ada, 0, 8));
		}else{
			$adaid = $id_form;
		}

		$datak		= $this->M_akun->query_all("SELECT * FROM user WHERE id_user = '$adaid'");

		$id_user			= $adaid;
		$nama				= $this->db->escape_str($this->input->post('nama'));
		$nkk				= $this->db->escape_str($this->input->post('nkk'));
		$nik				= $this->db->escape_str($this->input->post('nik'));
		$tempat_lahir		= $this->db->escape_str($this->input->post('tempat_lahir'));
		$tgl_lahir			= $this->db->escape_str($this->input->post('tgl_lahir'));
		$jk					= $this->db->escape_str($this->input->post('jk'));
		$kecamatan			= $this->db->escape_str($this->input->post('kecamatan'));
		$kelurahan			= $this->db->escape_str($this->input->post('kelurahan'));
		$alamat				= $this->db->escape_str($this->input->post('alamat'));
		$rt					= $this->db->escape_str($this->input->post('rt'));
		$rw					= $this->db->escape_str($this->input->post('rw'));
		$email				= $this->db->escape_str($this->input->post('email'));
		$password			= $this->db->escape_str($this->input->post('password'));
		$confirm			= $this->db->escape_str($this->input->post('confirm'));
		$hp1				= $this->db->escape_str($this->input->post('hp1'));
		$hp2				= $this->db->escape_str($this->input->post('hp2'));

		$folder				= "img/";
		$link_kk			= $_FILES['scan_kk']['name'];
		$link_ktp			= $_FILES['scan_ktp']['name'];
		$link_profil		= $_FILES['foto_profil']['name'];

		if($datak->num_rows()==1){//jika data ada
			if ($datak->row()->scan_kk != "" || $datak->row()->scan_kk == "" && $link_kk == "") {//data lama ada atau data lama kosong dan data baru kosong
				$scan_kk = $datak->row()->scan_kk;
			//jangan update
			}else{}
			if ($datak->row()->scan_ktp != "" || $datak->row()->scan_ktp == "" && $link_ktp == "") {//data lama ada atau data lama kosong dan data baru kosong
				$scan_ktp = $datak->row()->scan_ktp;
			//jangan update
			}else{}
			if ($datak->row()->foto_profil != "" || $datak->row()->foto_profil == "" && $link_profil == "") {//data lama ada atau data lama kosong dan data baru kosong
				$foto_profil = $datak->row()->foto_profil;
			//jangan update
			}else{}

			// if ($datak->row()->scan_kk != "" && $link_kk == "") {//data lama ada dan data baru kosong
			// 	$scan_kk = $datak->row()->scan_kk;
			// //jangan update
			// }else{}
			// if ($datak->row()->scan_ktp != "" && $link_ktp == "") {//data lama ada dan data baru kosong
			// 	$scan_ktp = $datak->row()->scan_ktp;
			// //jangan update
			// }else{}
			// if ($datak->row()->foto_profil != "" && $link_profil =="") {//data lama ada dan data baru kosong
			// 	$foto_profil = $datak->row()->foto_profil;
			// //jangan update
			// }else{}

			if ($datak->row()->scan_kk == "" && $link_kk != "") {//data lama tidak ada dan data baru ada
				// $scan_kk = $datak->row()->scan_kk;
				$scan_kk			= $folder.str_replace(" ","_",$link_kk);
				// $this->do_upload('scan_kk');
			//update
			}else{}
			if ($datak->row()->scan_ktp == "" && $link_ktp != "") {//data lama tidak ada dan data baru ada
				// $scan_ktp = $datak->row()->scan_ktp;
				$scan_ktp			= $folder.str_replace(" ","_",$link_ktp);
				// $this->do_upload('scan_ktp');
			//update
			}else{}
			if ($datak->row()->foto_profil == "" && $link_profil !="") {//data lama tidak ada dan data baru ada
				// $foto_profil = $datak->row()->foto_profil;
				$foto_profil		= $folder.str_replace(" ","_",$link_profil);
				// $this->do_upload('foto_profil');
			//update
			}else{}

			if ($datak->row()->scan_kk != "" && $link_kk != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->scan_kk)) {
					unlink(FCPATH.$datak->row()->scan_kk);
				}else{}
				$scan_kk			= $folder.str_replace(" ","_",$link_kk);
				// $this->do_upload('scan_kk');
			//update
			}else{}
			if ($datak->row()->scan_ktp != "" && $link_ktp != "") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->scan_ktp)) {
					unlink(FCPATH.$datak->row()->scan_ktp);
				}else{}
				$scan_ktp			= $folder.str_replace(" ","_",$link_ktp);
				// $this->do_upload('scan_ktp');
			//update
			}else{}
			if ($datak->row()->foto_profil != "" && $link_profil !="") {//data lama ada dan data baru ada
				if (file_exists(FCPATH.$datak->row()->foto_profil)) {
					unlink(FCPATH.$datak->row()->foto_profil);
				}else{}
				$foto_profil		= $folder.str_replace(" ","_",$link_profil);
				// $this->do_upload('foto_profil');
			//update
			}else{}
		}else{//jika data tidak ada
			//insert
			$scan_kk			= $folder.str_replace(" ","_",$link_kk);
			$scan_ktp			= $folder.str_replace(" ","_",$link_ktp);
			$foto_profil		= $folder.str_replace(" ","_",$link_profil);
		}			

		$role				= $this->db->escape_str($this->input->post('role'));
		$status				= $this->db->escape_str($this->input->post('status'));
		$tgl_register		= $this->db->escape_str($this->input->post('tgl_register'));
		$ket				= $this->db->escape_str($this->input->post('ket'));

		$New_Pass	= md5($password);

		$data_user = array(
			'id_user'			=> $id_user,
			'nama'				=> $nama,
			'nkk'				=> $nkk,
			'nik'				=> $nik,
			'tempat_lahir'		=> $tempat_lahir,
			'tgl_lahir'			=> $tgl_lahir,
			'jk'				=> $jk,
			'kecamatan'			=> $kecamatan,
			'kelurahan'			=> $kelurahan,
			'alamat'			=> $alamat,
			'rt'				=> $rt,
			'rw'				=> $rw,
			'email'				=> $email,
			'password'			=> $New_Pass,
			'confirm'			=> $confirm,
			'hp1'				=> $hp1,
			'hp2'				=> $hp2,
			'scan_kk'			=> $scan_kk,
			'scan_ktp'			=> $scan_ktp,
			'foto_profil'		=> $foto_profil,
			'role'				=> $role,
			'status'			=> $status,
			'tgl_register'		=> $tgl_register,
			'ket'				=> $ket
		);

		
		
		if($datak->num_rows()==1){//jika data ada
			$this->M_akun->update_record('user',$data_user,'id_user',$id_user);
			$this->session->set_flashdata('pesan','Update Data Berhasil !!');
			$this->data['page']	= "user/form_user";
			$this->load->view('themes',$this->data);
			redirect("c_user");
		}else{//jika data tidak ada
			//insert
			$this->M_akun->add_register($data_user);
			$this->session->set_flashdata('pesan','Tambah Data Berhasil !!');
			$this->data['page']	= "user/form_user";
			$this->load->view('themes',$this->data);
			redirect("c_user");
		}
	}

	public function delete_user(){
		$id_user	= $this->db->escape_str($this->uri->segment(3));
		$this->M_akun->delete_record('user','id_user',$id_user);
		redirect('c_user','refresh');
	}

	public function detail_user(){
		$id_userr	= $this->db->escape_str($this->uri->segment(3));
		$data		= $this->M_akun->query_all("SELECT * FROM user WHERE id_user = '$id_userr'");		
		if($data->num_rows()==1){
			$this->data['id_user']			= $data->row()->id_user;
			$this->data['nama']				= $data->row()->nama;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nik']				= $data->row()->nik;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['email']			= $data->row()->email;
			$this->data['password']			= $data->row()->confirm;
			$this->data['confirm']			= $data->row()->confirm;
			$this->data['hp1']				= $data->row()->hp1;
			$this->data['hp2']				= $data->row()->hp2;
			$this->data['scan_kk']			= $data->row()->scan_kk;
			$this->data['scan_ktp']			= $data->row()->scan_ktp;
			$this->data['foto_profil']		= $data->row()->foto_profil;
			$this->data['role']				= $data->row()->role;
			$this->data['status']			= $data->row()->status;
			$this->data['tgl_register']		= $data->row()->tgl_register;
			$this->data['ket']				= $data->row()->ket;
			$this->data['page']				= "user/detail_user";

			$this->load->view('themes',$this->data);
		}else{
			redirect('c_user','refresh');
		}
	}

	public function profil(){
		$id_userr	= $this->db->escape_str($this->uri->segment(3));
		$data		= $this->M_akun->query_all("SELECT * FROM user WHERE id_user = '$id_userr'");		
		if($data->num_rows()==1){
			$this->data['id_user']			= $data->row()->id_user;
			$this->data['nama']				= $data->row()->nama;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nik']				= $data->row()->nik;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['email']			= $data->row()->email;
			$this->data['password']			= $data->row()->confirm;
			$this->data['confirm']			= $data->row()->confirm;
			$this->data['hp1']				= $data->row()->hp1;
			$this->data['hp2']				= $data->row()->hp2;
			$this->data['scan_kk']			= $data->row()->scan_kk;
			$this->data['scan_ktp']			= $data->row()->scan_ktp;
			$this->data['foto_profil']		= $data->row()->foto_profil;
			$this->data['role']				= $data->row()->role;
			$this->data['status']			= $data->row()->status;
			$this->data['tgl_register']		= $data->row()->tgl_register;
			$this->data['ket']				= $data->row()->ket;
			$this->data['page']				= "user/profil";

			$this->load->view('themes',$this->data);
		}else{
			
		}
	}

	public function print_detail_user(){
		$id_userr	= $this->db->escape_str($this->uri->segment(3));
		$data		= $this->M_akun->query_all("SELECT * FROM user WHERE id_user = '$id_userr'");		
		if($data->num_rows()==1){
			$this->data['id_user']			= $data->row()->id_user;
			$this->data['nama']				= $data->row()->nama;
			$this->data['nkk']				= $data->row()->nkk;
			$this->data['nik']				= $data->row()->nik;
			$this->data['tempat_lahir']		= $data->row()->tempat_lahir;
			$this->data['tgl_lahir']		= $data->row()->tgl_lahir;
			$this->data['jk']				= $data->row()->jk;
			$this->data['kecamatan']		= $data->row()->kecamatan;
			$this->data['kelurahan']		= $data->row()->kelurahan;
			$this->data['alamat']			= $data->row()->alamat;
			$this->data['rt']				= $data->row()->rt;
			$this->data['rw']				= $data->row()->rw;
			$this->data['email']			= $data->row()->email;
			$this->data['password']			= $data->row()->confirm;
			$this->data['confirm']			= $data->row()->confirm;
			$this->data['hp1']				= $data->row()->hp1;
			$this->data['hp2']				= $data->row()->hp2;
			$this->data['scan_kk']			= $data->row()->scan_kk;
			$this->data['scan_ktp']			= $data->row()->scan_ktp;
			$this->data['foto_profil']		= $data->row()->foto_profil;
			$this->data['role']				= $data->row()->role;
			$this->data['status']			= $data->row()->status;
			$this->data['tgl_register']		= $data->row()->tgl_register;
			$this->data['ket']				= $data->row()->ket;

			$this->load->view('user/print_detail_user',$this->data);
		}
	}
}

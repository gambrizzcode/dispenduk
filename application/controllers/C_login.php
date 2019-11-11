<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_login extends CI_Controller {
	public function index(){
		$this->load->view('login');
	}
	public function do_login(){
		$username = $this->db->escape_str($this->input->post('email_nik'));
		$password = $this->db->escape_str($this->input->post('thepassword'));
		$pass     = md5($password);

		$valid = $this->is_email_valid($username);

		if ($valid == true) {
			$subjek = 'email';
			$this->lanjut_login($subjek,$username,$pass);
			// echo "valid";
		}else{
			if (strlen($username) == 16) {
				$subjek = 'nik';
				$this->lanjut_login($subjek,$username,$pass);
				// echo "nik";
			}else{
				$subjek = '';
				redirect('C_themes','refresh');
			}
		}

	}
	function lanjut_login($a,$b,$c){
		$this->load->model('M_akun');
		$log_in = $this->M_akun->ayo_login($a,$b,$c);

		if ($log_in) {
			foreach ($log_in as $row) {
				$sess_array = array(
					'id_user'		=> $row->id_user,
					'nik'			=> $row->nik,
					'email'			=> $row->email,
					'nama'			=> $row->nama,
					'status'		=> $row->status,
					'role'			=> $row->role,
					'foto_profil' 	=> $row->foto_profil
				);
				$this->session->set_userdata('login',$sess_array);
			}
			// redirect('C_themes/cek_role','refresh');
			if($this->session->userdata('login')){
				$session 				= $this->session->userdata('login');
				$data['id_user']		= $session['id_user'];
				$data['nik'] 			= $session['nik'];
				$data['email'] 			= $session['email'];
				$data['nama'] 			= $session['nama'];
				$data['status'] 		= $session['status'];
				$data['role'] 			= $session['role'];
				$data['foto_profil'] 	= $session['foto_profil'];
				redirect('C_themes','refresh');
			}
		}else{
			redirect('C_themes','refresh');
			// echo "haha";
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect(base_url());
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

        $this->upload->do_upload('scan_kk');
        $this->upload->do_upload('scan_ktp');

        $this->register();
        // if ($this->upload->do_upload('scan_kk') && $this->upload->do_upload('scan_ktp')){
        //     // echo "error 212";
        //     $this->register();
        // }else{
        //     // $this->register();
        //     echo "error tok";
        // }

	}
	public function register(){
		$folder		= FCPATH.'img/';
		$file_name	= $_FILES['scan_kk']['name'];
		$file_name2	= $_FILES['scan_ktp']['name'];
		
		$link_matang1 = $folder.str_replace(" ","_",$file_name);
		$link_matang2 = $folder.str_replace(" ","_",$file_name2);

		$pass = md5($_POST['password']);

		$ada = md5($_POST['nik'].$_POST['email'].time());
		$adaid = strtoupper(substr($ada, 0, 8));
		$now = date('Y-m-d');

		$data = array(
			'id_user' 		=> $adaid,
			'nama' 			=> $_POST['nama'],
			'nkk' 			=> '',
			'nik' 			=> $_POST['nik'],
			'tempat_lahir' 	=> '',
			'tgl_lahir' 	=> '',
			'jk' 			=> '',
			'kecamatan' 	=> '',
			'kelurahan' 	=> '',
			'alamat' 		=> '',
			'rt' 			=> '',
			'rw' 			=> '',
			'email' 		=> $_POST['email'],
			'password' 		=> $pass,
			'confirm'		=> $_POST['confirm'],
			'hp1' 			=> $_POST['hp1'],
			'hp2' 			=> '',
			'scan_kk' 		=> $link_matang1,
			'scan_ktp' 		=> $link_matang2,
			'foto_profil' 	=> '',
			'role' 			=> 'USER',
			'status' 		=> '0',
			'tgl_register'	=> $now,
			'ket' 			=> '',
		);

		$this->load->model('M_akun');
		if ($this->M_akun->add_register($data)) {
			$aemail	= 'infodispendukcapiljember@gmail.com';
			$subjeq = 'Pendaftaran Baru';
			$pesang	= '
				Telah masuk pendaftaran baru dari warga dengan data sebagai berikut :
	        	Nama Lengkap : '.$_POST["nama"].',<br>
	        	Nomor Induk Kependudukan (NIK) : '.$_POST["nik"].',<br>
	        	Alamat Email : '.$_POST["email"].',<br>
				Agar warga dapat segera melakukan Permohonan layanan, Segera Lakukan Pengecekan data dan Aktivasi.
				Terimakasih.
			';
			$this->M_akun->send_mail($aemail,$subjeq,$pesang);
			$this->load->view('sukses',$data);
			// $this->sendMail($data);
			// $this->load->view('root/sukses',$data);
		}else{
			echo "<h1>GAGAL</h1>";
		};

	}
	
    function is_email_valid($email){
    	if (preg_match("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/",trim($email))) {
    		return true;
    	}else{
    		return false;
    	}
    }
	public function lupa(){
		$this->load->model('M_akun');
		$penerima = $_POST['email_lupa'];

		$valid = $this->is_email_valid($penerima);
		if ($valid == true) {

			$jos = array('email' => $penerima);
			$yoman = $this->M_akun->cek_lupa($jos);
			$aha = $yoman->row();
			$hasil = $aha->email;//penerima
			$aemail = $hasil;

			$subjeq = 'Pemberitahuan Lupa Password';

			$pesang = '
				Ini adalah pesan rahasia. Jangan beritahukan isi pesan ini kepada siapapun. Kata sandi anda untuk Aplikasi Layanan Online Dispenduk Capil Jember adalah '.$aha->confirm.' untuk akun '.$aha->email.' dan NIK '.$aha->nik.'. Setelah bisa masuk kedalam aplikasi segera perbarui kata sandi anda. Terima Kasih.
			';
			$this->M_akun->send_mail($aemail,$subjeq,$pesang);
		}else{
			$jos = array('nik' => $penerima);
			$yoman = $this->M_akun->cek_lupa($jos);
			$aha = $yoman->row();
			$hasil = $aha->email;//penerima
			//kirim email
			$aemail = $hasil;

			$subjeq = 'Pemberitahuan Lupa Password';

			$pesang = '
				Ini adalah pesan rahasia. Jangan beritahukan isi pesan ini kepada siapapun. Kata sandi anda untuk Aplikasi Layanan Online Dispenduk Capil Jember adalah '.$aha->confirm.' untuk akun '.$aha->email.' dan NIK '.$aha->nik.'. Setelah bisa masuk kedalam aplikasi segera perbarui kata sandi anda. Terima Kasih.
			';
			$this->M_akun->send_mail($aemail,$subjeq,$pesang);
		}
	}
}
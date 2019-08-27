<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		$valid->set_rules(	'email','Email','required',
							array('required'	=>	'<b>E-mail</b> harus diisi.'));
		$valid->set_rules(	'password','Password','required',
							array('required'	=>	'<b>Password</b> harus diisi.'));

		if($valid->run()){

		$data = array('email' => $this->input->post('email', TRUE), 
					  'password' => sha1($this->input->post('password', TRUE))
					  );
		$hasil = $this->muser->cek_user($data);
		if ($hasil->num_rows() == 1){
			foreach($hasil->result() as $sess)
            {
              	$sess_data['logged_in'] 	= 'Anda sudah login.';
				$sess_data['id']			= $sess->id;
              	$sess_data['nama'] 			= $sess->nama;
              	$sess_data['email'] 		= $sess->email;
              	$sess_data['alamat'] 		= $sess->alamat;
              	$sess_data['no_telp'] 		= $sess->no_telp;
              	$sess_data['foto'] 			= $sess->foto;
              	$sess_data['role'] 			= $sess->role;
              	$this->session->set_userdata($sess_data);
            }

			if ($this->session->userdata('role') == 'Admin'){
				$this->session->set_flashdata('sukses', 'Anda berhasil login. Akses level: <b>Admin</b>');
				redirect(base_url('admin'));
			} elseif ($this->session->userdata('role') == 'Manager'){
				$this->session->set_flashdata('sukses', 'Anda berhasil login. Akses level: <b>Manager</b>');
				redirect(base_url('crew/manager'));
			} elseif ($this->session->userdata('role') == 'Kontributor'){
				$this->session->set_flashdata('sukses', 'Anda berhasil login. Akses level: <b>Kontributor</b>');
				redirect(base_url('crew/kontributor'));
			} else {
				$this->session->set_flashdata('sukses', 'Maaf, anda tidak memiliki akses masuk.');
				redirect(base_url('auth', 'refresh'));
			}

		} else {
			$this->session->set_flashdata('sukses', 'Maaf, kombinasi email dan password salah.');
			redirect(base_url('auth'));
		}
	}

		$data = array(	'title' 	=> 	'PDP (Pengolahan Data Projek) » Login User',
						'content'	=>	'auth/page');
		$this->load->view('auth/app', $data);
	}

	//Logout
	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('sukses', 'Terimakasih, anda telah berhasil logout.');
		redirect(base_url('auth'));
	}

	//404 Page
	public function error()
	{
		$data['title']		=	'≡ Halaman Tidak Ditemukan ≡';
		$data['content']	=	'auth/404';

		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} elseif ($this->session->userdata('role') == 'Admin') {
			$this->load->view('crew/manager/app', $data);
		} else {
			$this->load->view('crew/kontributor/app', $data);
		}
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */
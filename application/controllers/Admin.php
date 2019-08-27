<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
		$data['title']				=	'Halaman Administrator » Dashboard';
		$data['kru']				=	$this->muser->list_user();
		$data['client']				=	$this->mother->list_client();
		$data['project']			=	$this->mproject->list_project();
		$data['total']				=	$this->mother->total_budget();
		$data['content']			=	'admin/dashboard';
		$this->load->view('admin/app', $data);
	}

	//Change Data Diri
	public function cg_data($id)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'nama','Nama','required',
							array(	'required'	=>	'Field Nama harus diisi.'));
		$valid->set_rules(	'alamat','Alamat','required',
							array(	'required'	=>	'Field Alamat harus diisi.'));
		$valid->set_rules(	'no_telp','Nomor Telepon','required',
							array(	'required'	=>	'Field Nomor Telepon harus diisi.'));
		$valid->set_rules(	'email','Email','required|valid_email',
							array(	'required'		=>	'Field email belum diisi.',
									'valid_email'	=>	'Email tidak valid!'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Ubah Data Diri',
						'show'		=>	$this->muser->detail_user($id),
						'content'	=>	'admin/forms/cg_data'
					);
		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} elseif ($this->session->userdata('role') == 'Manager') {
			$this->load->view('crew/manager/app', $data);
		} else {
			$this->load->view('crew/kontributor/app', $data);
		}

		//Masuk Database
		} else {
			if(!empty($_FILES['foto']['name'])) {

				//Config Gambar
				$config['upload_path']          = './assets/img/foto';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']				= 2048;
		        $config['encrypt_name']			= true;
		        $this->upload->initialize($config);
		        $this->upload->do_upload('foto');
		        $upload_data 					= array('uploads' => $this->upload->data());

		        $detail = $this->muser->detail_user($id);
				if($detail->foto != ""){
					unlink('./assets/img/users/'.$detail->foto);
				}

		        $i 				=	$this->input;
				$values			=	array(		
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'role'					=>	$i->post('role'),
								'foto'					=>	$upload_data['uploads']['file_name']
							);

				$this->muser->update_user($values);
				$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil diupdate.');
				redirect('admin/cg_data/'.$this->session->userdata('id'),'refresh');

			} else {
				
				$i 				=	$this->input;
				$values			=	array(		
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email')
							);

				$this->muser->update_user($values);
				$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil diupdate.');
				redirect($this->agent->referrer(),'refresh');
			}
		}
	}

	//Change Password
	public function cg_password($id)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'password','Password Baru','required|min_length[3]',
							array(	'required'		=>	'Field Password Baru harus diisi.',
									'min_length'	=>	'Password minimal 3 karakter!'));
		$valid->set_rules(	'passconf','Konfirmasi Password','required|min_length[3]|matches[password]',
							array(	'required'		=>	'Mohon konfirmasi password baru anda.',
									'min_length'	=>	'Password minimal 3 karakter!',
									'matches'		=>	'Konfirmasi password tidak cocok!'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Ubah Password',
						'show'		=>	$this->muser->detail_user($id),
						'content'	=>	'admin/forms/cg_password'
					);
		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} elseif ($this->session->userdata('role') == 'Manager') {
			$this->load->view('crew/manager/app', $data);
		} else {
			$this->load->view('crew/kontributor/app', $data);
		}

		//Masuk Database
		} else {
			$i 				=	$this->input;
			$values			=	array(	
							'id'					=>	$i->post('id'),
							'password'				=>	sha1($i->post('passconf'))
						);

			$this->muser->update_user($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Password berhasil diupdate.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//List User (Kru)
	public function kru()
	{
		$data['title']		=	'Halaman Administrator » Kru';
		$data['content']	=	'admin/list/users';
		$data['list']		=	$this->muser->list_user();
		$this->load->view('admin/app', $data);
	}

	//Add User (Kru)
	public function add_kru()
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'nama','Nama','required',
							array(	'required'	=>	'Field <strong>nama</strong> harus diisi.'));
		$valid->set_rules(	'alamat','Alamat','required',
							array(	'required'	=>	'Field <strong>alamat</strong> harus diisi.'));
		$valid->set_rules(	'no_telp','Nomor Telepon','required',
							array(	'required'	=>	'Field <strong>nomor telepon</strong> harus diisi.'));
		$valid->set_rules(	'email','Email','required|is_unique[users.email]|valid_email',
							array(	'required'		=>	'Field <strong>email</strong> belum diisi.',
									'is_unique'		=>	'<strong>Email</strong> sudah terdaftar!',
									'valid_email'	=>	'<strong>Email</strong> tidak valid!'));
		$valid->set_rules(	'password','Password','required|min_length[3]',
							array(	'required'		=>	'Field <strong>password</strong> harus diisi.',
									'min_length'	=>	'<strong>Password</strong> minimal 3 karakter!'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Tambah Data Kru',
						'content'	=>	'admin/list/users'
					);
		$this->load->view('admin/app', $data);

		//Masuk Database
		} else {

			//Config Gambar
			$config['upload_path']          = './assets/img/users';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']				= 2048;
	        $config['encrypt_name']			= true;
	        $this->upload->initialize($config);
	        $this->upload->do_upload('foto');
	        $upload_data 					= array('uploads' => $this->upload->data());

			$i 				=	$this->input;

	        //Specs
	        if ($i->post('role') == 1) {
	        	$role 	= 'Admin';
	        } elseif ($i->post('role') == 2) {
	        	$role 	= 'Manager';
	        } elseif ($i->post('role') == 3) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Filmmaker';
	        } elseif ($i->post('role') == 4) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Photographer';
	        } elseif ($i->post('role') == 5) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Editor';
	        } elseif ($i->post('role') == 6) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Graphic Designer';
	        } 

			$values			=	array(	
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	'+62'.$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'password'				=>	sha1($i->post('password')),
								'role'					=>	$role,
								'specs'					=>	$specs,
								'foto'					=>	$upload_data['uploads']['file_name']
							);

			$this->muser->add_user($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil ditambahkan.');
			redirect('admin/kru','refresh');
		}
	}

	// Detail User (Kru)
	public function detail_user($id)
	{
		$data['title']		=	'Halaman Administrator » Detail Kru';
		$data['content']	=	'admin/details/detail_user';
		$data['show']		=	$this->muser->detail_user($id);
		$this->load->view('admin/app', $data);
	}

	//Update User (Kru)
	public function update_user($id)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'nama','Nama','required',
							array(	'required'	=>	'Field Nama harus diisi.'));
		$valid->set_rules(	'alamat','Alamat','required',
							array(	'required'	=>	'Field Alamat harus diisi.'));
		$valid->set_rules(	'no_telp','Nomor Telepon','required',
							array(	'required'	=>	'Field Nomor Telepon harus diisi.'));
		$valid->set_rules(	'email','Email','required|valid_email',
							array(	'required'		=>	'Field email belum diisi.',
									'valid_email'	=>	'Email tidak valid!'));
		$valid->set_rules(	'password','Password','min_length[3]',
							array(	'min_length'	=>	'Password minimal 3 karakter!'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Update Data Kru',
						'show'		=>	$this->muser->detail_user($id),
						'content'	=>	'admin/forms/update_user'
					);
		$this->load->view('admin/app', $data);

		//Masuk Database
		} else {

			$i 				=	$this->input;

			//Specs
	        if ($i->post('role') == 1) {
	        	$role 	= 'Admin';
	        } elseif ($i->post('role') == 2) {
	        	$role 	= 'Manager';
	        } elseif ($i->post('role') == 3) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Filmmaker';
	        } elseif ($i->post('role') == 4) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Photographer';
	        } elseif ($i->post('role') == 5) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Editor';
	        } elseif ($i->post('role') == 6) {
	        	$role 	= 'Kontributor';
	        	$specs 	= 'Graphic Designer';
	        } 

			if($i->post('password')==''){

				$values			=	array(	
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'role'					=>	$role,
								'specs'					=>	$specs
							);

			//Update With Password
			} else {

				$values			=	array(	
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'password'				=>	sha1($i->post('password')),
								'role'					=>	$role,
								'specs'					=>	$specs
							);

			//Update With Gambar
			} if(!empty($_FILES['foto']['name'])) {

				//Config Gambar
				$config['upload_path']          = './assets/img/foto';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']				= 2048;
		        $config['encrypt_name']			= true;
		        $this->upload->initialize($config);
		        $this->upload->do_upload('foto');
		        $upload_data 					= array('uploads' => $this->upload->data());

		        $detail = $this->muser->detail_user($id);
				if($detail->foto != ""){
					unlink('./assets/img/users/'.$detail->foto);
				}

		        $i 				=	$this->input;
				$values			=	array(		
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'role'					=>	$i->post('role'),
								'foto'					=>	$upload_data['uploads']['file_name']
							);

			//Update With Gambar & Password
			} elseif (!empty($_FILES['foto']['name']) && !empty($i->post('password'))) {

				//Config Gambar
				$config['upload_path']          = './assets/img/foto';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']				= 2048;
		        $config['encrypt_name']			= true;
		        $this->upload->initialize($config);
		        $this->upload->do_upload('foto');
		        $upload_data 					= array('uploads' => $this->upload->data());

		        $detail = $this->muser->detail_user($id);
				if($detail->foto != ""){
					unlink('./assets/img/foto/'.$detail->foto);
				}

				$i 				=	$this->input;

				//Specs
		        if ($i->post('role') == 1) {
		        	$role 	= 'Admin';
		        } elseif ($i->post('role') == 2) {
		        	$role 	= 'Manager';
		        } elseif ($i->post('role') == 3) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Filmmaker';
		        } elseif ($i->post('role') == 4) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Photographer';
		        } elseif ($i->post('role') == 5) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Editor';
		        } elseif ($i->post('role') == 6) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Graphic Designer';
		        } 

				$values			=	array(		
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'password'				=>	sha1($i->post('password')),
								'role'					=>	$role,
								'specs'					=>	$specs,
								'foto'					=>	$upload_data['uploads']['file_name']
							);
			} else {

				$i 				=	$this->input;

				//Specs
		        if ($i->post('role') == 1) {
		        	$role 	= 'Admin';
		        } elseif ($i->post('role') == 2) {
		        	$role 	= 'Manager';
		        } elseif ($i->post('role') == 3) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Filmmaker';
		        } elseif ($i->post('role') == 4) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Photographer';
		        } elseif ($i->post('role') == 5) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Editor';
		        } elseif ($i->post('role') == 6) {
		        	$role 	= 'Kontributor';
		        	$specs 	= 'Graphic Designer';
		        } 

				$values			=	array(		
								'id'					=>	$i->post('id'),
								'nama'					=>	$i->post('nama'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'email'					=>	$i->post('email'),
								'role'					=>	$role,
								'specs'					=>	$specs
							);
			}

			$this->muser->update_user($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil diupdate.');
			redirect('admin/kru','refresh');
		}
	}

	//Delete User (Kru)
	public function delete_user($id)
	{
		$detail = $this->muser->detail_user($id);
		$data = array('id' => $id);
		$this->muser->delete_user($data);

		//Hapus Foto
		if($detail->foto != ""){
			unlink('./assets/img/users/'.$detail->foto);
		}

		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil dihapus.');
		redirect('admin/kru','refresh');
	}

	//List Client
	public function client()
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'client','Client','required',
							array(	'required'	=>	'Field <strong>client</strong> harus diisi.'));
		$valid->set_rules(	'alamat','Alamat','required',
							array(	'required'	=>	'Field <strong>alamat</strong> harus diisi.'));
		$valid->set_rules(	'no_telp','Nomor Telepon','required',
							array(	'required'	=>	'Field <strong>nomor telepon</strong> harus diisi.'));
		$valid->set_rules(	'contract','Awal Kerjasama','required',
							array(	'required'	=>	'Field <strong>awal kerjasama</strong> harus diisi.'));
		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Client',
						'content'	=>	'admin/list/client',
						'list'		=>	$this->mother->list_client(),
						'kode'		=>	$this->mother->kode_client()
					);
		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} else {
			$this->load->view('crew/manager/app', $data);
		}

		//Masuk Database
		} else {

			//Config Gambar
			$config['upload_path']          = './assets/img/logo';
	        $config['allowed_types']        = 'gif|jpg|png';
	        $config['max_size']				= 2048;
	        $config['encrypt_name']			= true;
	        $this->upload->initialize($config);
	        $this->upload->do_upload('logo');
	        $upload_data 					= array('uploads' => $this->upload->data());

			$i 				=	$this->input;
			$values			=	array(	
								'kode'					=>	$i->post('kode'),
								'client'				=>	$i->post('client'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	'+62'.$i->post('no_telp'),
								'contract'				=>	$i->post('contract'),
								'logo'					=>	$upload_data['uploads']['file_name']
							);

			$this->mother->add_client($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil ditambahkan.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//Detail Client
	public function detail_client($kode)
	{
		$data['title']		=	'Halaman Administrator » Detail Client';
		$data['content']	=	'admin/details/detail_client';
		$data['show']		=	$this->mother->detail_client($kode);
		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} else {
			$this->load->view('crew/manager/app', $data);
		}
	}


	//Update Client
	public function update_client($kode)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'client','Client','required',
							array(	'required'	=>	'Field <strong>client</strong> harus diisi.'));
		$valid->set_rules(	'alamat','Alamat','required',
							array(	'required'	=>	'Field <strong>alamat</strong> harus diisi.'));
		$valid->set_rules(	'no_telp','Nomor Telepon','required',
							array(	'required'	=>	'Field <strong>nomor telepon</strong> harus diisi.'));
		$valid->set_rules(	'contract','Awal Kerjasama','required',
							array(	'required'	=>	'Field <strong>awal kerjasama</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Update Data Client',
						'show'		=>	$this->mother->detail_client($kode),
						'content'	=>	'admin/list/client'
					);
		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} else {
			$this->load->view('crew/manager/app', $data);
		}

		//Masuk Database
		} else {
			$i 				=	$this->input;

			//Update With Gambar
			if(!empty($_FILES['logo']['name'])) {

				//Config Gambar
				$config['upload_path']          = './assets/img/logo';
		        $config['allowed_types']        = 'gif|jpg|png';
		        $config['max_size']				= 2048;
		        $config['encrypt_name']			= true;
		        $this->upload->initialize($config);
		        $this->upload->do_upload('logo');
		        $upload_data 					= array('uploads' => $this->upload->data());

		        $detail = $this->mother->detail_client($kode);
				if($detail->logo != ""){
					unlink('./assets/img/logo/'.$detail->logo);
				}

		        $i 				=	$this->input;
				$values			=	array(		
								'kode'					=>	$i->post('kode'),
								'client'				=>	$i->post('client'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'contract'				=>	$i->post('contract'),
								'logo'					=>	$upload_data['uploads']['file_name']
							);

			//Update Without Gambar
			} else {
				$i 				=	$this->input;
				$values			=	array(		
								'kode'					=>	$i->post('kode'),
								'client'				=>	$i->post('client'),
								'alamat'				=>	$i->post('alamat'),
								'no_telp'				=>	$i->post('no_telp'),
								'contract'				=>	$i->post('contract')
							);
			}

			$this->mother->update_client($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil diupdate.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//Delete Client
	public function delete_client($kode)
	{
		$detail = $this->mother->detail_client($kode);
		$data = array('kode' => $kode);
		$this->mother->delete_client($data);

		//Hapus Foto
		if($detail->logo != ""){
			unlink('./assets/img/logo/'.$detail->logo);
		}

		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil dihapus.');
		redirect($this->agent->referrer(),'refresh');
	}

	//List Project
	public function project()
	{
		$data['title']				=	'Halaman Administrator » Project';
		$data['content']			=	'admin/list/project';
		$data['list_kategori']		=	$this->mproject->list_kategori();
		$data['list_client']		=	$this->mother->list_client();
		$data['list_project']		=	$this->mproject->list_project();
		$data['list_kontributor']	=	$this->muser->list_kontributor();
		$data['kode_kategori']		=	$this->mproject->kode_kategori();
		$data['kode_project']		=	$this->mproject->kode_project();
		$this->load->view('admin/app', $data);
	}
	
	//Add Kategori
	public function add_kategori()
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'kategori','Kategori','required',
							array(	'required'	=>	'Field <strong>kategori</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Tambah Data Kategori',
						'content'	=>	'admin/list/project'
					);

		//Masuk Database
		} else {
		        $i 				=	$this->input;
				$values			=	array(		
								'kode'			=>	$i->post('kode'),
								'kategori'		=>	$i->post('kategori')
							);

			$this->mproject->add_kategori($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil ditambahkan.');
			redirect('admin/project','refresh');
		}
	}

	//Update Kategori
	public function update_kategori($kode)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'kategori','Kategori','required',
							array(	'required'	=>	'Field <strong>kategori</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Update Data Kategori',
						'show'		=>	$this->mproject->detail_kategori($kode),
						'content'	=>	'admin/list/project'
					);

		//Masuk Database
		} else {
		        $i 				=	$this->input;
				$values			=	array(		
								'kode'			=>	$i->post('kode'),
								'kategori'		=>	$i->post('kategori')
							);

			$this->mproject->update_kategori($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil diupdate.');
			redirect('admin/project','refresh');
		}
	}

	//Delete Kategori
	public function delete_kategori($kode)
	{
		$detail = $this->mproject->detail_kategori($kode);
		$data = array('kode' => $kode);
		$this->mproject->delete_kategori($data);
		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil dihapus.');
		redirect('admin/project','refresh');
	}

	//Add Project
	public function add_project()
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'kode_kategori','Kategori','required',
							array(	'required'	=>	'Field <strong>kategori</strong> harus diisi.'));
		$valid->set_rules(	'kode_client','Client','required',
							array(	'required'	=>	'Field <strong>client</strong> harus diisi.'));
		$valid->set_rules(	'judul','Judul','required',
							array(	'required'	=>	'Field <strong>judul</strong> harus diisi.'));
		$valid->set_rules(	'tempat','Tempat','required',
							array(	'required'	=>	'Field <strong>tempat</strong> harus diisi.'));
		$valid->set_rules(	'start','Start Date','required',
							array(	'required'	=>	'Field <strong>start date</strong> harus diisi.'));
		$valid->set_rules(	'end','End Date','required',
							array(	'required'	=>	'Field <strong>end date</strong> harus diisi.'));
		$valid->set_rules(	'id_crew[]','Kru','required',
							array(	'required'	=>	'Salah satu <strong>kru</strong> harus dipilih.'));
		$valid->set_rules(	'content','Konten','required',
							array(	'required'	=>	'Field <strong>konten</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array('title' 	=> 	'Halaman Administrator » Tambah Data Project');

		//Masuk Database
		} else {
	        $i 				=	$this->input;

	        //Project Values
			$values			=	array(		
							'kode'				=>	$i->post('kode'),
							'kode_kategori'		=>	$i->post('kode_kategori'),
							'kode_client'		=>	$i->post('kode_client'),
							'id_manager'		=>	$i->post('id_manager'),
							'judul'				=>	$i->post('judul'),
							'start'				=>	$i->post('start'),
							'end'				=>	$i->post('end'),
							'tempat'			=>	$i->post('tempat'),
							'budget_plan'		=>	intval(preg_replace('/,.*|[^0-9]/', '', $i->post('budget'))),
							'content'			=>	$i->post('content'),
							'status'			=>	'Just Added'

						);

			//Contrib Values
			$crews 			=	array();
			$count			=	count($i->get_post('id_crew'));
			for($x = 0; $x < $count; $x++){
				$crews[]	=	array(	'kode_project'	=>	$i->post('kode'),
										'id_crew'		=>	$i->post('id_crew')[$x]
								);
			}

			$this->db->insert_batch('contrib', $crews);
			$this->mproject->add_project($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil ditambahkan.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//Update Project
	public function update_project($kode)
	{
		//Validasi
		$valid 	= 	$this->form_validation;

		$valid->set_rules(	'judul','Judul','required',
							array(	'required'	=>	'Field <strong>judul</strong> harus diisi.'));
		$valid->set_rules(	'tempat','Tempat','required',
							array(	'required'	=>	'Field <strong>tempat</strong> harus diisi.'));
		$valid->set_rules(	'start','Start','required',
							array(	'required'	=>	'Field <strong>tanggal mulai</strong> harus diisi.'));
		$valid->set_rules(	'end','End','required',
							array(	'required'	=>	'Field <strong>tanggal selesai</strong> harus diisi.'));
		$valid->set_rules(	'content','Content','required',
							array(	'required'	=>	'Field <strong>konten</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Update Data Project',
						'show'		=>	$this->mproject->detail_project($kode),
						'content'	=>	'admin/list/project'
					);
		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} else {
			$this->load->view('crew/manager/app', $data);
		}

		//Masuk Database
		} else {
	        $i 				=	$this->input;
			$values			=	array(		
							'kode'				=>	$i->post('kode'),
							'judul'				=>	$i->post('judul'),
							'tempat'			=>	$i->post('tempat'),
							'kode_client'		=>	$i->post('kode_client'),
							'kode_kategori'		=>	$i->post('kode_kategori'),
							'start'				=>	$i->post('start'),
							'end'				=>	$i->post('end'),
							'content'			=>	$i->post('content')
						);

			$this->mproject->update_project($values);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil diupdate.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//Delete Project
	public function delete_project($kode)
	{
		// Unlink File
		$files 	= $this->mproject->list_file($kode);
		if (!empty($files)) {
			foreach ($files as $show) {
				unlink('./assets/files/'.$show->file);
			}

			$this->mproject->delete_fileID($kode);
		}

		// Unlink Gambar
		$list 	= $this->mproject->list_gambar($kode);
		if (!empty($list)) {
			foreach ($list as $show) {
				unlink('./assets/img/pics/'.$show->gambar);
			}

			$this->mproject->delete_gambarID($kode);
		}

		$values = array('kode'		=> 	$kode);
		$this->mproject->delete_contribID($kode);
		$this->mproject->delete_taskID($kode);
		$this->mproject->delete_project($values);
		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Data berhasil dihapus.');
		redirect($this->agent->referrer(),'refresh');
	}

	// Detail Project
	public function detail_project($kode)
	{
		$data['title']				=	'Halaman Administrator » Detail Project';
		$data['content']			=	'admin/details/detail_project';
		$data['show']				=	$this->mproject->detail_project($kode);
		$data['crews']				=	$this->mproject->list_contrib($kode);
		$data['task']				=	$this->mtask->task_list($kode);
		$data['undone_task']		=	$this->mtask->undone_tasks($kode);
		$data['images']				=	$this->mproject->list_gambar($kode);
		$data['files']				=	$this->mproject->list_file($kode);
		$data['list_kontributor']	=	$this->muser->list_kontributor();
		$data['list_crew']			=	$this->muser->list_unusedCrew($kode);
		$this->session->set_flashdata('notif', '<b>Deadline</b> project ini sudah dekat. Harap hubungi para kontributor yang belum mengerjakan task.');
		$this->load->view('admin/app', $data);
	}

	//Add Task
	public function add_task($kode)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'task[]','Task','required',
							array(	'required'	=>	'Field <strong>task</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Tambah Data Task',
						'content'	=>	'admin/list/project'
					);

		//Masuk Database
		} else {
	        $i 				=	$this->input;
			$data 			=	array();
			$count			=	count($i->get_post('task'));
			for($x = 0; $x < $count; $x++){
				$data[]	=	array(	
										'kode_project'	=>	$i->post('kode_project'),
										'id_crew'		=>	$i->post('id_crew'),
										'task'			=>	$i->post('task')[$x]
								);
			}

			$this->db->insert_batch('task', $data);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Task berhasil ditambahkan kepada <b>'.$i->post('nama').'</b>.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//Delete Task
	public function delete_task($id)
	{
		$values = array('id'		=> 	$id);
		$this->mtask->delete_task($values);
		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Task berhasil dihapus.');
		redirect($this->agent->referrer(),'refresh');
	}

	//Add Crew
	public function add_crew($kode)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'id_crew[]','Kru','required',
							array(	'required'	=>	'Field <strong>kru</strong> harus diisi.'));

		if($valid->run()==FALSE){
		//End Validasi

		$data = array(	'title' 	=> 	'Halaman Administrator » Tambah Kru',
						'content'	=>	'admin/list/project'
					);

		//Masuk Database
		} else {

		    //Contrib Values
		   	$i 				=	$this->input;
			$crews 			=	array();
			$count			=	count($i->get_post('id_crew'));
			for($x = 0; $x < $count; $x++){
				$crews[]	=	array(	'kode_project'	=>	$kode,
										'id_crew'		=>	$i->post('id_crew')[$x]
								);
			}

			$this->db->insert_batch('contrib', $crews);
			$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Task berhasil ditambahkan.');
			redirect($this->agent->referrer(),'refresh');
		}
	}

	//Remove Crew
	public function remove_crew($id, $kode)
	{
		$this->db->delete('task', array('id_crew' => $id, 'kode_project' => $kode));
		$this->db->delete('contrib', array('id_crew' => $id, 'kode_project' => $kode));
		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Task berhasil dihapus.');
		redirect($this->agent->referrer(),'refresh');
	}

	//Update Budget
	public function update_budget($kode)
	{
		$val['kode']		= $kode;
		$val['budget_plan'] = intval(preg_replace('/,.*|[^0-9]/', '', $this->input->post('budget')));
		$this->mproject->update_project($val);
		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Budget berhasil diupdate.');
		redirect($this->agent->referrer(),'refresh');
	}

	//Set Project
	public function set_project($kode)
	{
		$task['kode_project']	= $kode;
		$task['status']			= 'Set';
		$val['kode']			= $kode;
		$val['status'] 			= 'Ongoing';
		$this->mproject->update_project($val);
		$this->mtask->update_task($task);
		$this->session->set_flashdata('berhasil', '<strong>Project set!</strong>');
		redirect($this->agent->referrer(),'refresh');
	}

	//Rollback Project
	public function rollback_project($kode)
	{
		$task['kode_project']	= $kode;
		$task['status']			= 'Set';
		$val['kode']			= $kode;
		$val['status'] 			= 'Just Added';
		$this->mproject->update_project($val);
		$this->mtask->update_task($task);
		$this->session->set_flashdata('berhasil', '<strong>Project rollbacked!</strong>');
		redirect($this->agent->referrer(),'refresh');
	}

	//Finish Project
	public function finish_project($kode)
	{
		//Validasi
		$valid 	= 	$this->form_validation;
		
		$valid->set_rules(	'estimated','Budget','required',
							array(	'required'	=>	'Field <strong>estimated budget</strong> harus diisi.'));

		if($valid->run() == TRUE) {
			
			//Values
			$i = $this->input;
			$task['kode_project']	= $kode;
			$task['status']			= 'Ignored';
			$val['kode']			= $kode;
			$val['status'] 			= 'Done';
			$val['budget_real']		= intval(preg_replace('/,.*|[^0-9]/', '', $i->post('budget')));

			//Config File
			if (!empty($_FILES['file']['name'])) {
				$config['upload_path']          = './assets/files';
		        $config['allowed_types']        = 'pdf|xlsx|doc|docx';
		        $config['max_size']				= 2048;
		        $this->upload->initialize($config);
		        $this->upload->do_upload('file');
		        $upload_data 					= array('uploads' => $this->upload->data());
		        $values 						= array('kode_project' 	=> $this->input->post('kode'),
		        										'file'			=> $upload_data['uploads']['file_name']);
		        $this->db->insert('file', $values);
			}
			
			//Multiple Gambar
			if(!empty($_FILES['gambar']['name'])){
				$filesNumber	=	sizeof($_FILES['gambar']['tmp_name']);
				$files 			=	$_FILES['gambar'];
				$config['upload_path']          = './assets/img/pics/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 2048;
                $config['encrypt_name']			= true;

				for ($i = 0; $i < $filesNumber; $i++) {
					$_FILES['gambar']['name']		=	$files['name'][$i];
					$_FILES['gambar']['type']		=	$files['type'][$i];
					$_FILES['gambar']['tmp_name']	=	$files['tmp_name'][$i];
					$_FILES['gambar']['error']		=	$files['error'][$i];
					$_FILES['gambar']['size']		=	$files['size'][$i];

					$this->upload->initialize($config);
					$this->upload->do_upload('gambar');
						$data = $this->upload->data();

						$insert[$i]['kode_project']	= $this->input->post('kode');
						$insert[$i]['gambar']		= $data['file_name'];
				}

				if ($this->upload->do_upload('gambar')) {
					$this->db->insert_batch('gambar', $insert);
				}		

			}

			//Task Update
			$this->mtask->update_unusedTask($task);

			//Project Update
			$this->mproject->update_project($val);

			$this->session->set_flashdata('berhasil', '<strong>Project finished!</strong>');
			redirect($this->agent->referrer(),'refresh');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */
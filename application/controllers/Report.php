<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
	}

	//File Download
	public function download_file($kode)
	{
		$files 	= $this->mproject->list_file($kode);
		if (!empty($files)) {
			foreach ($files as $show) {
				force_download('./assets/files/'.$show->file, NULL);
			}
		}
	}

	//Project Details
	public function project_details($kode)
	{
		$data['crews']			=	$this->mproject->list_contrib($kode);
		$data['task']			=	$this->mtask->task_list($kode);
		$data['show']			=	$this->mproject->detail_project($kode);
		$data['task']			=	$this->mtask->task_list($kode);
		$data['images']			=	$this->mproject->list_gambar($kode);
		$data['undone_task']	=	$this->mtask->undone_taskByID($kode);
		$data['done_task']		=	$this->mtask->done_taskByID($kode);
		$data['ignored_task']	=	$this->mtask->ignored_taskByID($kode);
		$this->pdf->setPaper('A4', 'potrait');
	    $this->pdf->filename = 'Detail Project - '.$kode.' ('.random_string('alnum', 7).').pdf';
	    $this->pdf->load_view('reports/detail_project', $data);
	}

	//Send Mail
	public function send_mail($kode)
	{
		//Validasi
		$valid = $this->form_validation;

		$valid->set_rules(	'message','Message','required',
							array(	'required'	=>	'Field <strong>isi pesan</strong> tidak valid atau belum diisi.'));

		if($valid->run() == TRUE){

			$data['crews']			=	$this->mproject->list_contrib($kode);
			$data['task']			=	$this->mtask->task_list($kode);
			$data['show']			=	$this->mproject->detail_project($kode);
			$data['task']			=	$this->mtask->task_list($kode);
			$data['images']			=	$this->mproject->list_gambar($kode);

			//PDF Render
			$dompdf = new Dompdf\Dompdf();
		    $dompdf->loadHtml($this->load->view('reports/detail_project', $data, TRUE));
		    $dompdf->setPaper('A4', 'portrait');
		    $dompdf->render();
		    $output = $dompdf->output();
		    file_put_contents('assets/files/Detail Project - '.$kode.'.pdf', $output);

		    $details = $this->mproject->detail_project($kode);
			$emails  = $this->mproject->list_contrib($kode);
			
			foreach ($emails as $email) {

				$config = Array(
				  'port'		=> 'localhost',
				  'smtp_host' 	=> 'localhost',
				  'smtp_port' 	=> 'localhost',
				  'smtp_user' 	=> 'root',
				  'smtp_pass' 	=> '',
				  'mailtype' 	=> 'html',
				  'charset' 	=> 'iso-8859-1',
				  'wordwrap' 	=> true
				);

				$crewEmails = $email->email_kru;
				$this->email->initialize($config);
				$this->email->set_newline("\r\n");
				$this->email->from('rzkyirmwn@gmail.com', $this->session->userdata('nama'));
				$this->email->to($crewEmails);
				$this->email->subject('Project Details (<i>'.$details->judul.'</i>)');
				$this->email->message($this->input->post('message'));
				$this->email->attach('./assets/files/Detail Project - '.$kode.'.pdf');
				$this->email->send();
			}

			unlink('./assets/files/Detail Project - '.$kode.'.pdf');
			$this->session->set_flashdata('berhasil', '<strong>Message sent!</strong>');
			redirect($this->agent->referrer(),'refresh');
		} 
	}

	//List Project
	public function project()
	{
		
		if ($this->session->userdata('role') == 'Admin') {
			$data['title']			=	'Halaman Administrator » Laporan Project';
			$data['content']		=	'reports/list_project';
		} elseif ($this->session->userdata('role') == 'Manager') {
			$data['title']			=	'Halaman Kru » Laporan Project';
			$data['content']		=	'reports/list_project';
		} else {
			$data['title']			=	'Halaman Kru » Laporan Project';
			$data['content']		=	'reports/list_project';
		} 

		$data['list_kategori']	=	$this->mproject->list_kategori();
		$data['list_client']	=	$this->mother->list_client();
		$data['list_project']	=	$this->mreport->get_projectList();
		$data['get_client']		=	$this->mreport->get_clientByFilter();
		$data['get_kategori']	=	$this->mreport->get_kategoriByFilter();
		$data['get_sum']		=	$this->mreport->get_sumWithDate();

		if ($this->session->userdata('role') == 'Admin') {
			$this->load->view('admin/app', $data);
		} elseif ($this->session->userdata('role') == 'Manager') {
			$this->load->view('crew/manager/app', $data);
		} else {
			$this->load->view('crew/kontributor/app', $data);
		}

		if ($this->input->post('generate')) {
			$data['list_project']		=	$this->mreport->get_projectList();
			$data['get_sum']			=	$this->mreport->get_sumWithDate();
			$this->pdf->setPaper('A4', 'potrait');
		    $this->pdf->filename = 'Daftar Project • Token ('.random_string('alnum', 8).').pdf';
		    $this->pdf->load_view('reports/get_project', $data);
		}
		
	}

}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */
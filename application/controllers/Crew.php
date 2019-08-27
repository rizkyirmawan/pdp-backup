<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Crew extends CI_Controller {

	//Manager Dashboard
	public function manager()
	{
		$data['title']				=	'Halaman Crew » Dashboard';
		$data['project']			=	$this->mproject->list_project();
		$data['completed_project']	=	$this->mother->completed_project();
		$data['ongoing_project']	=	$this->mother->ongoing_project();
		$data['total']				=	$this->mother->total_budgetByID();
		$data['content']			=	'crew/manager/dashboard';
		$this->load->view('crew/manager/app', $data);
	}

	//Kontributor Dashboard
	public function kontributor()
	{
		$data['title']				=	'Halaman Crew » Dashboard';
		$data['project']			=	$this->mother->contrib_project();
		$data['undone_task']		=	$this->mother->undone_taskByID();
		$data['done_task']			=	$this->mother->done_taskByID();
		$data['ignored_task']		=	$this->mother->ignored_taskByID();
		$data['content']			=	'crew/kontributor/dashboard';
		$this->load->view('crew/kontributor/app', $data);
	}

	//List Project
	public function project()
	{
		$data['title']				=	'Halaman Crew » Project';
		$data['content']			=	'crew/list/project';
		$data['list_kategori']		=	$this->mproject->list_kategori();
		$data['list_client']		=	$this->mother->list_client();
		$data['list_project']		=	$this->mproject->list_project();
		$data['list_kontributor']	=	$this->muser->list_kontributor();
		$data['kode_kategori']		=	$this->mproject->kode_kategori();
		$data['kode_project']		=	$this->mproject->kode_project();
		if ($this->session->userdata('role') == 'Manager') {
			$this->load->view('crew/manager/app', $data);
		} else {
			$this->load->view('crew/kontributor/app', $data);
		}
	}

	// Detail Project
	public function detail_project($kode)
	{
		$data['title']				=	'Halaman Kru » Detail Project';
		$data['show']				=	$this->mproject->detail_project($kode);
		$data['images']				=	$this->mproject->list_gambar($kode);
		$data['files']				=	$this->mproject->list_file($kode);
		$data['undone_task']		=	$this->mtask->undone_tasks($kode);

		if ($this->session->userdata('role') == 'Manager') {
			$data['content']			=	'crew/details/project_manager';
			$data['crews']				=	$this->mproject->list_contrib($kode);
			$data['task']				=	$this->mtask->task_list($kode);
			$data['list_kontributor']	=	$this->muser->list_kontributor();
			$data['list_crew']			=	$this->muser->list_unusedCrew($kode);
		} else {
			$data['content']			=	'crew/details/project_kontributor';
			$data['undone_task']		=	$this->mtask->undone_taskByID($kode);
			$data['done_task']			=	$this->mtask->done_taskByID($kode);
			$data['ignored_task']		=	$this->mtask->ignored_taskByID($kode);
		}

		if ($this->session->userdata('role') == 'Manager') {
			$this->load->view('crew/manager/app', $data);
			$this->session->set_flashdata('notif', '<b>Deadline</b> project ini sudah dekat. Harap hubungi para kontributor yang belum mengerjakan task.');
		} else {
			$this->load->view('crew/kontributor/app', $data);
		}
	}

	//Update Task
	public function update_task($kode)
	{
		$id 	= $this->input->post('id_task');	
		$count	= count($this->input->get_post('id_task'));
		$date 	= new DateTime('now', new DateTimezone('Asia/Jakarta'));
		for ($i = 0; $i < $count; $i++) {
			$data[] = array(	'id'			=>	$id[$i],
								'submitted'		=>	$date->format('Y-m-d'),
								'on'			=>	$date->format('h:i:s A'),
								'status'		=>	'Accomplished'
							);
		}

		$this->db->update_batch('task', $data, 'id');
		$this->session->set_flashdata('berhasil', '<strong>Berhasil!</strong> Task berhasil diupdate.');
		redirect($this->agent->referrer(),'refresh');
	}

}

/* End of file Crew.php */
/* Location: ./application/controllers/Crew.php */
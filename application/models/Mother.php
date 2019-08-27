<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mother extends CI_Model {

	//
	//
	// Dashboard Things
	//
	//

	//Completed Project
	public function completed_project()
	{
		$this->db->select('project.*, users.nama AS nama_manager');
		$this->db->from('project');
		$this->db->join('users', 'project.id_manager = users.id', 'inner');
		$this->db->where('project.id_manager', $this->session->userdata('id'));
		$this->db->where('project.status', 'Done');
		$query = $this->db->get();
		return $query->result();
	}

	//Ongoing Projects
	public function ongoing_project()
	{
		$this->db->select('project.*, users.nama AS nama_manager');
		$this->db->from('project');
		$this->db->join('users', 'project.id_manager = users.id', 'inner');
		$this->db->where('project.id_manager', $this->session->userdata('id'));
		$this->db->where('project.status', 'Ongoing');
		$query = $this->db->get();
		return $query->result();
	}

	//Undone Task by ID
	public function undone_taskByID()
	{
		$this->db->select('task.task, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->where('task.id_crew', $this->session->userdata('id'));
		$this->db->where('task.status', 'Set');
		$query = $this->db->get();
		return $query->result();
	}

	//Done Task by ID
	public function done_taskByID()
	{
		$this->db->select('task.task, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->where('task.id_crew', $this->session->userdata('id'));
		$this->db->where('task.status', 'Accomplished');
		$query = $this->db->get();
		return $query->result();
	}

	//Ignored Task by ID
	public function ignored_taskByID()
	{
		$this->db->select('task.task, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->where('task.id_crew', $this->session->userdata('id'));
		$this->db->where('task.status', 'Ignored');
		$query = $this->db->get();
		return $query->result();
	}

	//Kontributor Projects
	public function contrib_project()
	{
		$this->db->select('project.*, users.nama AS nama_manager');
		$this->db->from('project');
		$this->db->join('users', 'project.id_manager = users.id', 'inner');
		if ($this->session->userdata('role') == 'Kontributor') {
			$this->db->join('contrib', 'contrib.kode_project = project.kode ', 'left');
		} if ($this->session->userdata('role') == 'Manager') {
			$this->db->where('project.id_manager', $this->session->userdata('id'));
		} if ($this->session->userdata('role') == 'Kontributor') {
			$this->db->where('contrib.id_crew', $this->session->userdata('id'));
		}
		$query = $this->db->get();
		return $query->result();
	}
	
	//Total Budget
	public function total_budget()
	{
		$this->db->select('SUM(budget_real) AS total_budget');
		$this->db->from('project');
		$query = $this->db->get();
		return $query->row();
	}

	//Total Budget by ID
	public function total_budgetByID()
	{
		$this->db->select('SUM(budget_real) AS total_budget');
		$this->db->from('project');
		$this->db->where('id_manager', $this->session->userdata('id'));
		$query = $this->db->get();
		return $query->row();
	}

	//
	//
	// Non Dashboard Things
	//
	//

	//List Client
	public function list_client()
	{
		$this->db->select('*');
		$this->db->from('client');
		$this->db->order_by('client', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	//Add Client
	public function add_client($data)
	{
		$this->db->insert('client', $data);
	}

	//Update Client
	public function update_client($data)
	{
		$this->db->where('kode', $data['kode']);
		$this->db->update('client', $data);
	}

	//Delete Client
	public function delete_client($data)
	{
		$this->db->where('kode', $data['kode']);
		$this->db->delete('client', $data);
	}

	//Detail Client
	public function detail_client($kode)
	{
		$query = $this->db->get_where('client', array('kode' => $kode));
		return $query->row();
	}

	//Kodeauto Client
	public function kode_client()
	{
		$this->db->select('RIGHT(client.kode, 2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('client');
		if($query->num_rows() <> 0){     
	   		$data = $query->row();      
	   		$kode = intval($data->kode) + 1;
	   	} else {     
	   		$kode = 1;
	   	}

	  	$kodemax = str_pad($kode, 4, "000", STR_PAD_LEFT);    
	  	$kodejadi = "CL".$kodemax;     
	  	return $kodejadi;
	}

}

/* End of file Mother.php */
/* Location: ./application/models/Mother.php */
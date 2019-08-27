<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mtask extends CI_Model {

	//Add Task
	public function add_task($data)
	{
		$this->db->insert('task', $data);
	}

	//Update Task
	public function update_task($data)
	{
		$this->db->where('kode_project', $data['kode_project']);
		$this->db->update('task', $data);
	}

	//Update Unused Task
	public function update_unusedTask($data)
	{
		$this->db->where('kode_project', $data['kode_project']);
		$this->db->where('status', 'Set');
		$this->db->update('task', $data);
	}

	//Delete Task
	public function delete_task($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('task', $data);
	}

	//Detail Task
	public function detail_task($id)
	{
		$query = $this->db->get_where('task', array('id' => $id));
		return $query->row();
	}

	//Task List
	public function task_list($kode)
	{
		$this->db->select('task.*, users.nama, project.*, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->join('project', 'task.kode_project = project.kode', 'inner');
		$this->db->where('task.kode_project', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	//Undone Tasks
	public function undone_tasks($kode)
	{
		$this->db->select('task.*');
		$this->db->from('task');
		$this->db->join('project', 'task.kode_project = project.kode', 'inner');
		$this->db->where('task.kode_project', $kode);
		$this->db->where('task.status', 'Set');
		$query = $this->db->get();
		return $query->result();
	}

	//Undone Task by ID
	public function undone_taskByID($kode)
	{
		$this->db->select('task.task, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->join('project', 'task.kode_project = project.kode', 'inner');
		$this->db->where('task.kode_project', $kode);
		$this->db->where('task.id_crew', $this->session->userdata('id'));
		$this->db->where('task.status', 'Set');
		$query = $this->db->get();
		return $query->result();
	}

	//Done Task by ID
	public function done_taskByID($kode)
	{
		$this->db->select('task.*, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->join('project', 'task.kode_project = project.kode', 'inner');
		$this->db->where('task.kode_project', $kode);
		$this->db->where('task.id_crew', $this->session->userdata('id'));
		$this->db->where('task.status', 'Accomplished');
		$query = $this->db->get();
		return $query->result();
	}

	//Ignored Task by ID
	public function ignored_taskByID($kode)
	{
		$this->db->select('task.task, task.status AS task_status, task.id AS id_task');
		$this->db->from('task');
		$this->db->join('users', 'task.id_crew = users.id', 'inner');
		$this->db->join('project', 'task.kode_project = project.kode', 'inner');
		$this->db->where('task.kode_project', $kode);
		$this->db->where('task.id_crew', $this->session->userdata('id'));
		$this->db->where('task.status', 'Ignored');
		$query = $this->db->get();
		return $query->result();
	}

}

/* End of file Mtask.php */
/* Location: ./application/models/Mtask.php */
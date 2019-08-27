<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mreport extends CI_Model {

	public $tglmin;
	public $tglmax;
	public $kode_kategori;
	public $kode_client;
	public $status;

	//Get Project List
	public function get_projectList()
	{
		$this->tglmin			= $this->input->post('tglmin');
		$this->tglmax 	 		= $this->input->post('tglmax');
		$this->kode_kategori 	= $this->input->post('kode_kategori');
		$this->kode_client 		= $this->input->post('kode_client');
		$this->status 			= $this->input->post('status');

		$this->db->select('project.*, kategori.kategori, client.client, users.nama AS nama_manager');
		$this->db->from('project');
		$this->db->join('kategori', 'project.kode_kategori = kategori.kode', 'inner');
		$this->db->join('users', 'project.id_manager = users.id', 'inner');
		$this->db->join('client', 'project.kode_client = client.kode', 'inner');
		if ($this->session->userdata('role') == 'Kontributor') {
			$this->db->join('contrib', 'contrib.kode_project = project.kode ', 'left');
		} 

		// Conditional Filter
		if(!empty($this->tglmin) && !empty($this->tglmax)) {
			$this->db->where('project.start >=', $this->tglmin);
			$this->db->where('project.start <=', $this->tglmax);
		} if(!empty($this->kode_kategori) && !empty($this->kode_client)) {
			$this->db->where('kode_kategori', $this->kode_kategori);
			$this->db->where('kode_client', $this->kode_client);
		} if(!empty($this->kode_kategori)) {
			$this->db->where('kode_kategori', $this->kode_kategori);
		} if(!empty($this->kode_client)) {
			$this->db->where('kode_client', $this->kode_client);
		} if(!empty($this->status)) {
			$this->db->where('status', $this->status);
		} if ($this->session->userdata('role') == 'Manager') {
			$this->db->where('project.id_manager', $this->session->userdata('id'));
		} if ($this->session->userdata('role') == 'Kontributor') {
			$this->db->where('contrib.id_crew', $this->session->userdata('id'));
		} 

		$this->db->order_by('start', 'desc');

		$query = $this->db->get();
		return $query->result();
	}

	//Get Summed Value with Date Range
	public function get_sumWithDate()
	{
		$this->tglmin			= $this->input->post('tglmin');
		$this->tglmax 	 		= $this->input->post('tglmax');
		$this->kode_kategori 	= $this->input->post('kode_kategori');
		$this->kode_client 		= $this->input->post('kode_client');

		$this->db->select('project.*, SUM(budget_real) AS total_budget');
		$this->db->from('project');

		// Conditional Filter
		if(!empty($this->tglmin) && !empty($this->tglmax)) {
			$this->db->where('project.start >=', $this->tglmin);
			$this->db->where('project.start <=', $this->tglmax);
		} if(!empty($this->kode_kategori) && !empty($this->kode_client)) {
			$this->db->where('kode_kategori', $this->kode_kategori);
			$this->db->where('kode_client', $this->kode_client);
		} if(!empty($this->kode_kategori)) {
			$this->db->where('kode_kategori', $this->kode_kategori);
		} if(!empty($this->kode_client)) {
			$this->db->where('kode_client', $this->kode_client);
		}

		$query = $this->db->get();
		return $query->row();
	}

	//Get Client by Filter
	public function get_clientByFilter()
	{
		$this->kode_client 		= $this->input->post('kode_client');

		$this->db->select('client');
		$this->db->from('client');
		$this->db->where('kode', $this->kode_client);
		$query = $this->db->get();
		return $query->row();
	}

	//Get Kategori by Filter
	public function get_kategoriByFilter()
	{
		$this->kode_kategori 	= $this->input->post('kode_kategori');

		$this->db->select('kategori');
		$this->db->from('kategori');
		$this->db->where('kode', $this->kode_kategori);
		$query = $this->db->get();
		return $query->row();
	}

}

/* End of file Mreport.php */
/* Location: ./application/models/Mreport.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mproject extends CI_Model {

	//
	//
	// Kategori
	//
	//
	
	//List Kategori
	public function list_kategori()
	{
		$this->db->select('*');
		$this->db->from('kategori');
		$this->db->order_by('kategori', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	//Add Kategori
	public function add_kategori($data)
	{
		$this->db->insert('kategori', $data);
	}

	//Update Kategori
	public function update_kategori($data)
	{
		$this->db->where('kode', $data['kode']);
		$this->db->update('kategori', $data);
	}

	//Delete Kategori
	public function delete_kategori($data)
	{
		$this->db->where('kode', $data['kode']);
		$this->db->delete('kategori', $data);
	}

	//Detail Kategori
	public function detail_kategori($kode)
	{
		$query = $this->db->get_where('kategori', array('kode' => $kode));
		return $query->row();
	}

	//Kodeauto Kategori
	public function kode_kategori()
	{
		$this->db->select('RIGHT(kategori.kode, 2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('kategori');
		if($query->num_rows() <> 0){     
	   		$data = $query->row();      
	   		$kode = intval($data->kode) + 1;
	   	} else {     
	   		$kode = 1;
	   	}

	  	$kodemax = str_pad($kode, 4, "000", STR_PAD_LEFT);    
	  	$kodejadi = "KT".$kodemax;     
	  	return $kodejadi;
	}

	//
	//
	// Project
	//
	//
	
	//List Project
	public function list_project()
	{
		$this->db->select('project.*, kategori.kategori, users.nama AS nama_manager');
		$this->db->from('project');
		$this->db->join('kategori', 'project.kode_kategori = kategori.kode', 'inner');
		$this->db->join('users', 'project.id_manager = users.id', 'inner');

		if ($this->uri->segment(3) != '') {
			$this->db->where('project.kode_kategori', $this->uri->segment(3));
		}

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

	//Add Project
	public function add_project($data)
	{
		$this->db->insert('project', $data);
	}

	//Update Project
	public function update_project($data)
	{
		$this->db->where('kode', $data['kode']);
		$this->db->update('project', $data);
	}

	//Delete Project
	public function delete_project($data)
	{
		$this->db->where('kode', $data['kode']);
		$this->db->delete('project', $data);
	}

	//Detail Project
	public function detail_project($kode)
	{
		$this->db->select('project.*, kategori.kategori, client.client, users.nama AS nama_manager');
		$this->db->join('kategori', 'project.kode_kategori = kategori.kode', 'inner');
		$this->db->join('client', 'project.kode_client = client.kode', 'inner');
		$this->db->join('users', 'project.id_manager = users.id', 'inner');
		$query = $this->db->get_where('project', array('project.kode' => $kode));
		return $query->row();
	}

	//List Contrib
	public function list_contrib($kode){
		$this->db->select('contrib.*, project.*, users.nama AS nama_kru, users.email AS email_kru, users.specs');
		$this->db->from('contrib');	
		$this->db->join('project', 'contrib.kode_project = project.kode', 'left');
		$this->db->join('users', 'contrib.id_crew = users.id', 'left');
		$this->db->where('project.kode', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	//List File
	public function list_file($kode){
		$this->db->select('*');
		$this->db->from('file');	
		$this->db->join('project', 'file.kode_project = project.kode', 'left');
		$this->db->where('project.kode', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	//Delete File
	public function delete_fileID($data)
	{
		$this->db->where('kode_project', $data);
		$this->db->delete('file');
	}

	//List Gambar
	public function list_gambar($kode){
		$this->db->select('*');
		$this->db->from('gambar');	
		$this->db->join('project', 'gambar.kode_project = project.kode', 'left');
		$this->db->where('project.kode', $kode);
		$query = $this->db->get();
		return $query->result();
	}

	//Delete Gambar
	public function delete_gambarID($data)
	{
		$this->db->where('kode_project', $data);
		$this->db->delete('gambar');
	}

	//Delete Contrib
	public function delete_contribID($data)
	{
		$this->db->where('kode_project', $data);
		$this->db->delete('contrib');
	}

	//Delete Tasks
	public function delete_taskID($data)
	{
		$this->db->where('kode_project', $data);
		$this->db->delete('task');
	}

	//Kodeauto Project
	public function kode_project()
	{
		$this->db->select('RIGHT(project.kode, 2) as kode', FALSE);
		$this->db->order_by('kode','DESC');    
		$this->db->limit(1);
		$query = $this->db->get('project');
		if($query->num_rows() <> 0){     
	   		$data = $query->row();      
	   		$kode = intval($data->kode) + 1;
	   	} else {     
	   		$kode = 1;
	   	}

	  	$kodemax = str_pad($kode, 4, "000", STR_PAD_LEFT);    
	  	$kodejadi = "PRO".$kodemax;     
	  	return $kodejadi;
	}

}

/* End of file Mproject.php */
/* Location: ./application/models/Mproject.php */
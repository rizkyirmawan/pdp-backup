<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Muser extends CI_Model {

	//Cek User
	public function cek_user($data){
		$query = $this->db->get_where('users', $data);
		return $query;
	}

	//List User
	public function list_user()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->order_by('nama', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	//List Kontributor
	public function list_kontributor()
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('role', 'Kontributor');
		$query = $this->db->get();
		return $query->result();
	}

	//List Unused Crew
	public function list_unusedCrew($kode){
		$this->db->select('id_crew');
		$this->db->join('project', 'project.kode = contrib.kode_project', 'left');
		$this->db->where('contrib.kode_project', $kode);
		$x = $this->db->get('contrib')->result_array();

		$this->db->select('*');
		$this->db->from('users');
		foreach ($x as $key) {
			$this->db->where_not_in('users.id', $key);
		}
		$this->db->where('role', 'Kontributor');
		$query = $this->db->get();
		return $query->result();
	}

	//Add User
	public function add_user($data)
	{
		$this->db->insert('users', $data);
	}

	//Update User
	public function update_user($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('users', $data);
	}

	//Delete User
	public function delete_user($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->delete('users', $data);
	}

	//Detail User
	public function detail_user($id)
	{
		$query = $this->db->get_where('users', array('id' => $id));
		return $query->row();
	}

}

/* End of file Muser.php */
/* Location: ./application/models/Muser.php */
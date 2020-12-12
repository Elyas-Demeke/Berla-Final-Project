<?php 

class Model_group extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function create($data)
	{
		$create = $this->db->insert('role', $data);
		return ($create == true) ? true : false;
	}
	public function delete($id)
	{
		$sql = "SELECT e.accountid  from employees as e where e.id = ?";
		$query = $this->db->query($sql, array($id));
		$row = $query->row_array();
		$this->db->where('id', $id);
		$delete = $this->db->delete('employees');
		$this->db->where('id', $row['accountid']);
		$delete = $this->db->delete('accounts');
		return ($delete == true) ? true : false;
	}
	public function get_role_data($id = null)
	{
		if($id) {
			$sql = "SELECT * FROM role WHERE id = ?";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT * FROM role";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function edit( $id = null, $data = array())
	{
		$this->db->where('id', $id);
		$update = $this->db->update('role', $data);
		return ($update == true) ? true : false;	
	}
	public function getUserRole($userId = null)
	{
		if($userId)
		{
			$sql = "SELECT a.id as accid, r.name,r.permission from accounts as a, role as r WHERE a.roleId = r.id AND a.id = ?";
			$query = $this->db->query($sql,array($userId));
			return $query->row_array();
		}
		// $sql = "SELECT a.id as accid, r.name,r.permission from accounts as a, role as r WHERE a.roleId = r.id";
		// $query = $this->db->query($sql);
		// return $query->result_array();
	}

}
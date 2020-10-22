<?php 

class Model_doctor extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function add($account,$data)
	{
		$create = $this->db->insert('accounts',$account);
		if($create):
			$user_id = $this->db->insert_id();
			$data += array('accountid' => $user_id);
			$employee = $this->db->insert('employees',$data);

			return ($employee) ? 'Success' : $this->db->error();
		else:
			return $this->db->error();
		endif;
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
	public function get_doctor_data($id = null)
	{
		if($id) {
			$sql = "SELECT e.id as empid, a.roleId, e.fname, e.mname,e.lname, e.dob, e.sex, e.phone, e.officeno, e.email, e.photo, e.ward_id, w.name as wardname, a.active  FROM employees as e, accounts as a, ward as w WHERE e.ward_id = w.id AND e.accountid = a.id AND e.id = ? AND a.roleId = 2";
			$query = $this->db->query($sql, array($id));
			return $query->row_array();
		}

		$sql = "SELECT e.id as empid, a.roleId, e.fname, e.mname, e.lname, e.dob, e.sex, e.phone, e.officeno, e.email, e.photo, e.ward_id, w.name as wardname, a.active FROM employees as e, accounts as a, ward as w WHERE e.ward_id = w.id AND e.accountid = a.id AND a.roleId = 2";
		$query = $this->db->query($sql);
		return $query->result_array();
	}
	public function edit($data = array(), $id = null, $account_id = null)
	{
		$this->db->where('id', $id);
		$update = $this->db->update('employees', $data);

		// if($account_id) {
		// 	// user group
		// 	$update_user_group = array('group_id' => $group_id);
		// 	$this->db->where('user_id', $id);
		// 	$user_group = $this->db->update('user_group', $update_user_group);
		// 	return ($update == true && $user_group == true) ? true : false;	
		// }
			
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
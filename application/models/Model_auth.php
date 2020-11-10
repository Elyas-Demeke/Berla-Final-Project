<?php 

class Model_auth extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	/* 
		This function checks if the phone number exists in the database
	*/
	public function check_phone($phone) 
	{
		if($phone) {
			$sql = 'SELECT * FROM `accounts` WHERE phone = ?';
			$query = $this->db->query($sql, array($phone));
			$result = $query->num_rows();
			return ($result == 1) ? true : false;
		}

		return false;
	}

	/* 
		This function checks if the email and password matches with the database
	*/
	public function create_admin($admin = null){
		$create = $this->db->insert('role', $admin);
		return ($create == true) ? true : false;
	} 
	public function insert_to_account($admin = null){
		$create = $this->db->insert('accounts', $admin);
		return ($create == true) ? true : false;
	}
	public function insertImage($photo){
		$create = $this->db->insert('photo',$photo);
		return $create;
	}
	public function loadImage($photo = null){
		$sql = "SELECT * FROM photo";
		$get = $this->db->query($sql);
		return $get->result();
	}
	public function login($phone, $password) {
		if($phone && $password) {
			$sql = "SELECT a.id as accid,a.roleid,a.password, e.dob, e.email, e.fname,e.id, e.lname,e.mname,e.officeno,e.phone,e.photo, e.sex,e.ward_id FROM `accounts` as a, `employees` as e WHERE a.phone = ? AND a.id = e.accountid";
			$query = $this->db->query($sql, array($phone));

			if($query->num_rows() == 1) {
				$result = $query->row_array();

				$hash_password = password_verify($password, $result['password']);
				if($hash_password === true) {
					return $result;	
				}
				else {
					return false;
				}

				
			}
			else {
				return false;
			}
		}
	}
}
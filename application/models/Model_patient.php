<?php 

class Model_patient extends CI_Model
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
            $patient = $this->db->insert('patients',$data);

            return ($patient) ? 'Success' : $this->db->error();
        else:
            return $this->db->error();
        endif;
    }
    public function delete($id)
    {
        $sql = "SELECT p.accountid  from patients as p where p.id = ?";
        $query = $this->db->query($sql, array($id));
        $row = $query->row_array();
        $this->db->where('id', $id);
        $delete = $this->db->delete('patients');
        $this->db->where('id', $row['accountid']);
        $delete = $this->db->delete('accounts');
        return ($delete == true) ? true : false;
    }
    public function get_patient_data($id = null)
    {
        if($id) {
            $sql = "SELECT e.id as patid, a.roleId, e.fname, e.mname, e.lname, e.dob, e.sex, e.phone, e.home,e.in_patient,e.accountid, e.email, e.ward_id, w.name as wardname, a.active FROM patients as e, accounts as a, ward as w WHERE e.ward_id = w.id AND e.accountid = a.id AND a.roleId = 3 AND e.id = ?";
            $query = $this->db->query($sql, array($id));
            return $query->row_array();
        }

        $sql = "SELECT e.id as patid, a.roleId, e.fname, e.mname, e.lname, e.dob, e.sex, e.phone, e.home,e.in_patient,e.accountid, e.email, e.ward_id, w.name as wardname, a.active FROM patients as e, accounts as a, ward as w WHERE e.ward_id = w.id AND e.accountid = a.id AND a.roleId = 3";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function edit($data = array(), $id = null, $account_data = null)
    {
        $this->db->where('id', $id);
        $update = $this->db->update('patients', $data);
        $sql = 'SELECT accountid FROM patients WHERE id = ?';
        $query = $this->db->query($sql,array($id));
        $result = $query->row_array();
        $account_id = $result['accountid'];

        if($account_id) {
        //  // user group
            
            $this->db->where('id', $account_id);
            $doctor_account = $this->db->update('accounts', $account_data);
            return ($update == true && $doctor_account == true) ? true : false; 
        }
       
            
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
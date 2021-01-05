<?php 

class Model_laboratory extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function order($data)
    {
        $order = $this->db->insert('labratorytest',$data);
        return ($order == true) ? true : false;
    }
    public function delete($id)
    {
        
        $this->db->where('id', $id);
        $delete = $this->db->delete('appointment');
        return ($delete == true) ? true : false;
    }
    public function get_test_data($id = null)
    {
        if($id){
            $sql = "SELECT lt.id as testId, p.fname as pfname, p.mname as pmname, p.lname as plname, e.fname as efname, e.mname as emname, e.lname as elname, lt.test_order_time, lt.test_name FROM labratorytest as lt, patients as p, employees as e WHERE lt.pat_id = p.id AND lt.doctor_id = e.id AND lt.id = ?";
            $query = $this->db->query($sql,array($id));
            return $query->row_array();
        }
        $sql = "SELECT lt.id as testId, p.fname as pfname, p.mname as pmname, p.lname as plname, e.fname as efname, e.mname as emname, e.lname as elname, lt.test_order_time, lt.test_name FROM labratorytest as lt, patients as p, employees as e WHERE lt.pat_id = p.id AND lt.doctor_id = e.id";
        $query = $this->db->query($sql);
        return $query->result_array();
    } 
    public function get_result($id = null){
        if($id){
            $sql = "SELECT lr.id as resultId, lt.id as testId, p.fname as pfname, p.mname as pmname, p.lname as plname, e.fname as efname, e.mname as emname, e.lname as elname, lt.test_order_time, lt.test_name, lr.result, lr.completion_date FROM labratorytest as lt, patients as p, employees as e, labratoryresult as lr WHERE lt.pat_id = p.id AND lt.doctor_id = e.id AND lt.id = lr.lab_test_id AND lt.id = ?";
            $query = $this->db->query($sql,array($id));
            return $query->row_array();
        }
    }
    public function submit($data = null){
        $order = $this->db->insert('labratoryresult',$data);
        return ($order == true) ? true : false;
    }
    public function checksubmit($id = null){
        if($id){
            $sql = "SELECT * FROM labratoryresult as lr, labratorytest as lt WHERE lt.id = lr.lab_test_id AND lr.lab_test_id = ?";
            $check = $this->db->query($sql,array($id));
            if($check->num_rows()  > 0)
            {
                return true;
            }
            else{
                return false;
            }
        }
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
    public function edit($id = null, $data = null)
    {
        $this->db->where('lab_test_id', $id);
        $update = $this->db->update('labratoryresult',$data);
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
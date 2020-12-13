<?php 

class Model_oral extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function submit($data)
    {
        $order = $this->db->insert('oralhistory',$data);
        return ($order == true) ? true : false;
    }
    public function delete($id)
    {
        
        $this->db->where('id', $id);
        $delete = $this->db->delete('appointment');
        return ($delete == true) ? true : false;
    }
    public function get_history($id = null)
    {
        if($id){
            $sql = "SELECT o.id as oralId, p.fname as pfname, p.mname as pmname, p.lname as plname, e.fname as efname, e.mname as emname, e.lname as elname, o.date, o.diagnosis FROM oralhistory as o, patients as p, employees as e WHERE o.patient_id = p.id AND o.doctor_id = e.id AND o.id = ?";
            $query = $this->db->query($sql,array($id));
            return $query->row_array();
        }
        $sql = "SELECT o.id as oralId, p.fname as pfname, p.mname as pmname, p.lname as plname, e.fname as efname, e.mname as emname, e.lname as elname, o.date, o.diagnosis FROM oralhistory as o, patients as p, employees as e WHERE o.patient_id = p.id AND o.doctor_id = e.id";
        $query = $this->db->query($sql);
        return $query->result_array();
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
        $this->db->where('id', $id);
        $update = $this->db->update('appointment',$data);
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
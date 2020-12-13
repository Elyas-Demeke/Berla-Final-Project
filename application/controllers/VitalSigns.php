<?php 
class VitalSigns extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
        $this->load->model('Model_laboratory');
        $this->load->model('Model_vital');
		$this->data['page_title'] = 'Employees';
	}

	public function index()
	{
        if(!in_array('viewVitalSigns', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $test_data = $this->Model_vital->get_record();
		$result = array();
        foreach ($test_data as $k => $v) {

             $result[$k]['vital_info'] = $v;
             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
                // echo ' k is'.$k.'<br>';
        }

        $this->data['vital_data'] = $result;

        $this->render_template('vital/index',$this->data);
	}
    public function delete($id)
    {
        if(!in_array('deleteEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if($id) {
            if($this->input->post('confirm')) {
                    $delete = $this->Model_employee->delete($id);
                    if($delete == true) {
                        $this->session->set_flashdata('success', 'Successfully removed');
                        redirect('Employees/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Employees/', 'refresh');
                    }

            }   
        }
    }
	public function add($id){
        if(!in_array('createVitalSigns', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if($id){


            // $this->form_validation->set_rules('type', 'Lab Test Type', 'trim|required');
            $this->form_validation->set_rules('temp', 'Temprature', 'trim|required');
            $this->form_validation->set_rules('bp', 'Blood Pressure', 'trim|required');
            $this->form_validation->set_rules('pulse', 'Pulse', 'trim|required');

            if ($this->form_validation->run() == TRUE ) {
                $data = array(
                    'pat_id' => $id,
                    'emp_id' => $this->session->userdata('id'),
                    'date' => date("Y-m-d", strtotime($this->input->post('time'))),
                    'temp' => $this->input->post('temp'),             
                    'bp' => $this->input->post('bp'),             
                    'pulse' => $this->input->post('pulse'),             
                );

                $submit = $this->Model_vital->submit($data);
                if($submit == true) {
                    $this->session->set_flashdata('success', 'Successfully Submitted');
                    redirect('VitalSigns/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('VitalSigns/add/'.$id, 'refresh');
                }

            }
            else {

                $patient_data = $this->Model_vital->get_patient_data($id);
                $this->data['patient_data'] = $patient_data;
                $this->render_template('Vital/add', $this->data);
            }	
        }
        else{
            redirect('dashboard','refresh');
        }
	}
    public function edit($id = null){
        if(!in_array('updateEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
            if($id)
            {// if called properly from the edit button            
                $this->form_validation->set_rules('fname', 'First name', 'trim|required');
                $this->form_validation->set_rules('mname', 'First name', 'trim|required');
                $this->form_validation->set_rules('lname', 'First name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                // $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
                // $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|matches[password]');
                $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
                //$this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
                $this->form_validation->set_rules('office_number', 'Office Number', 'required');
                $this->form_validation->set_rules('ward', 'Ward', 'required');
                $this->form_validation->set_rules('phone', 'Phone','trim|required|min_length[5]|max_length[12]');
            if($this->form_validation->run() == TRUE){// if we are trying to run edit after editing the form
                // if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))){
                    $image = '';
                if(!empty($_FILES['photo']['name'])){

                    $config = [
                        'upload_path' => './uploads/',
                        'allowed_types' => 'gif|png|jpg|jpeg'
                    ];
                    $this->load->library('upload',$config);
                   // $this->form_validation->set_error_delimiters();
                    if($this->upload->do_upload('photo'))
                    {
                     //$data = $this->input->post();
                         $info = $this->upload->data();
                         $image_path = "uploads/".$info['raw_name'].$info['file_ext'];
                         $image = $image_path;

                         $accountdata = array(
                        'active' => $this->input->post('status[0]'),
                        'roleId' => $this->input->post('groups'),
                        );
                        $data = array(
                        'fname' => $this->input->post('fname'),
                        'mname' => $this->input->post('mname'),
                        'lname' => $this->input->post('lname'),
                        'dob' => $this->input->post('dob'),
                        'sex' => $this->input->post('gender[0]'),
                        'phone' => $this->input->post('phone'),
                        'officeno' => $this->input->post('office_number'),
                        'email' => $this->input->post('email'),
                        'ward_id' => $this->input->post('ward'),
                        'photo' => $image,
                        );
                     }
               //unset($data['submit']);
                     else{
                        $this->session->set_flashdata('errors', 'file found butupload failed');            
                    }
                }
            else{
                $this->session->set_flashdata('errors', 'no file found');
                // no file case
                    $accountdata = array(
                        'active' => $this->input->post('status[0]'),
                        'roleId' => $this->input->post('groups'),
                    );
                    $data = array(
                    'fname' => $this->input->post('fname'),
                    'mname' => $this->input->post('mname'),
                    'lname' => $this->input->post('lname'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('gender[0]'),
                    'phone' => $this->input->post('phone'),
                    'officeno' => $this->input->post('office_number'),
                    'email' => $this->input->post('email'),
                    'ward_id' => $this->input->post('ward'),
                    );
            }
                    
                    $update = $this->Model_employee->edit($data,$id,$accountdata);
                    if($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('Employees/', 'refresh');
                        }
                        else {
                            $this->session->set_flashdata('errors', $update);
                            redirect('Employees/edit/'.$id, 'refresh');
                        }

                // }//
            }
            else{
                $group_data = $this->Model_group->get_role_data();
                $this->data['group_data'] = $group_data;
                $employee_data = $this->Model_employee->get_employee_data($id);
                $this->data['Employee_data'] = $employee_data;
                $this->render_template('Employee/edit',$this->data);  
            }


            }
            else{
                redirect('Employees','refresh');
            }

    }
}
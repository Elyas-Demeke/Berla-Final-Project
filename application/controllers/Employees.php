<?php 
class Employees extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
        $this->load->model('Model_employee');
        $this->load->model('Model_group');
		$this->data['page_title'] = 'Employees';
	}

	public function index()
	{
        if(!in_array('viewEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $employees_data = $this->Model_employee->get_employee_data();
		$result = array();
        foreach ($employees_data as $k => $v) {

             $result[$k]['user_info'] = $v;
             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
                // echo ' k is'.$k.'<br>';
        }

        $this->data['user_data'] = $result;

        $this->render_template('employee/index',$this->data);
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
	public function add(){
        if(!in_array('createEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

    	$this->form_validation->set_rules('groups', 'Roles', 'required');
        $this->form_validation->set_rules('fname', 'First name', 'trim|required');
		$this->form_validation->set_rules('mname', 'First name', 'trim|required');
		$this->form_validation->set_rules('lname', 'First name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[employees.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('dob', 'DOB', 'trim|required');
		//$this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
		$this->form_validation->set_rules('office_number', 'Office Number', 'required');
        $this->form_validation->set_rules('ward', 'Ward', 'required');
		$this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[12]|is_unique[accounts.phone]');

        if ($this->form_validation->run() == TRUE ) {
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

             }
           //unset($data['submit']);
             else
             {
                $this->session->set_flashdata('errors', 'file found butupload failed');            
            }
        }
        else{
            $this->session->set_flashdata('errors', 'no file found');
            // no file case
        }

        //$this->session->set_flashdata('errors', 'form run');  

                // $this->load->model('queries');
            // if($this->model_auth->insertImage($data)){
            //     echo 'Image uploded succesfully';
            // }
            // else{
            //     echo 'Failed';
            // }
            $password = password_hash($this->input->post('password'),PASSWORD_DEFAULT);
            $account = array(
                'phone' => $this->input->post('phone'),
                'password' => $password,
                'roleId' => $this->input->post('groups'),
                'active' => $this->input->post('status[0]'),
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

        	$create = $this->Model_employee->add($account,$data);
        	if($create == 'Success') {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Employees/add', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', $create);
        		redirect('Employees/add', 'refresh');
        	}
        }
        else {
            // false case
        	// $group_data = $this->model_groups->getGroupData();
        	// $this->data['group_data'] = $group_data;
            $group_data = $this->Model_group->get_role_data();
            $this->data['group_data'] = $group_data;
            $this->render_template('employee/add', $this->data);
        }	
	}
    public function edit($id = null){
        if(!in_array('updateEmployee', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
            if($id)
            {
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
    public function profile($id = null){
        if(!in_array('viewProfile', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $user_id = $this->session->userdata('id');

        $user_data = $this->Model_employee->get_employee_data($user_id);
        $this->data['user_data'] = $user_data;

        
        $this->render_template('employee/profile', $this->data);
    }
    public function setting()
    {   
        if(!in_array('updateProfile', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $id = $this->session->userdata('id');

        if($id) {
               $this->form_validation->set_rules('fname', 'First name', 'trim|required');
                $this->form_validation->set_rules('mname', 'First name', 'trim|required');
                $this->form_validation->set_rules('lname', 'First name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required');
                // $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
                // $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|matches[password]');
                $this->form_validation->set_rules('dob', 'Birth Date', 'trim|required');
                //$this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
                $this->form_validation->set_rules('office_number', 'Office Number', 'required');
                $this->form_validation->set_rules('phone', 'Phone','trim|required|min_length[5]|max_length[12]');


            if ($this->form_validation->run() == TRUE) {
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
            if(!empty($this->input->post('password')))
                    
                    $update = $this->Model_employee->edit($data,$id,$accountdata);
                    if($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('Employees/', 'refresh');
                        }
                        else {
                            $this->session->set_flashdata('errors', $update);
                            redirect('Employees/edit/'.$id, 'refresh');
                        }

            }
            else {
                // false case
                $user_data = $this->Model_employee->get_employee_data($id);
                $this->data['user_data'] = $user_data;
                $this->render_template('employee/setting', $this->data);
            
            }   
        }
    }
}
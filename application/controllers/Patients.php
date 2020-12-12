<?php 
class Patients extends Admin_controller{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Model_patient');
		$this->not_logged_in();
		$this->data['page_title'] = 'Patients';
	}
	public function index()
	{
        if(!in_array('viewPatient', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $Patient_data = $this->Model_patient->get_patient_data();
        $result = array();
        foreach ($Patient_data as $k => $v) {

             $result[$k]['user_info'] = $v;
             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
            // echo ' k is'.$k.'<br>';
        }

        $this->data['user_data'] = $result;
		$this->render_template('Patients/index',$this->data);
	}
	public function add()
	{
        if(!in_array('createPatient', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->form_validation->set_rules('fname', 'First name', 'trim|required');
        $this->form_validation->set_rules('mname', 'First name', 'trim|required');
        $this->form_validation->set_rules('lname', 'First name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[employees.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
        $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
        $this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
        $this->form_validation->set_rules('home_number', 'Home Number', 'required');
        $this->form_validation->set_rules('ward', 'Ward', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[12]|is_unique[accounts.phone]');

        if ($this->form_validation->run() == TRUE ) {
                $image = '';
        //     if(!empty($_FILES['photo']['name'])){

        //         $config = [
        //             'upload_path' => './uploads/',
        //             'allowed_types' => 'gif|png|jpg|jpeg'
        //         ];
        //         $this->load->library('upload',$config);
        //        // $this->form_validation->set_error_delimiters();
        //         if($this->upload->do_upload('photo'))
        //         {
        //          //$data = $this->input->post();
        //          $info = $this->upload->data();
        //          $image_path = "uploads/".$info['raw_name'].$info['file_ext'];
        //          $image = $image_path;

        //      }
        //    //unset($data['submit']);
        //      else
        //      {
        //         $this->session->set_flashdata('errors', 'file found butupload failed');            
        //     }
        // }
        // else{
        //     $this->session->set_flashdata('errors', 'no file found');
        //     // no file case
        // }

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
                'roleId' => 3,
                'active' => $this->input->post('status[0]'),
            );
            $data = array(
                'fname' => $this->input->post('fname'),
                'mname' => $this->input->post('mname'),
                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'dob' => $this->input->post('dob'),
                'sex' => $this->input->post('gender[0]'),
                'phone' => $this->input->post('phone'),
                'home' => $this->input->post('home_number'),
                'ward_id' => $this->input->post('ward'),
                'in_patient' => 0,
            );

            $create = $this->Model_patient->add($account,$data);
            if($create == 'Success') {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('Patients/add', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', $create);
                redirect('Patients/add', 'refresh');
            }
        }
        else {
            // false case
            // $group_data = $this->model_groups->getGroupData();
            // $this->data['group_data'] = $group_data;
            $this->render_template('Patients/add', $this->data);
        }
	}
    public function edit($id = null){
            if(!in_array('updatePatient', $this->permission)) {
            redirect('dashboard', 'refresh');
            }
            if($id)
            {// if called properly from the edit button            
                $this->form_validation->set_rules('fname', 'First name', 'trim|required');
                $this->form_validation->set_rules('mname', 'First name', 'trim|required');
                $this->form_validation->set_rules('lname', 'First name', 'trim|required');
                $this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[employees.email]');
                // $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
                // $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
                $this->form_validation->set_rules('dob', 'DOB', 'trim|required');
                $this->form_validation->set_rules('gender[]', 'Gender', 'trim|required');
                $this->form_validation->set_rules('home_number', 'Home Number', 'required');
                $this->form_validation->set_rules('ward', 'Ward', 'required');
                $this->form_validation->set_rules('phone', 'Phone', 'trim|required|min_length[5]|max_length[12]');
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

                        $accountdata = array('active' => $this->input->post('status[0]'));
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
                    $accountdata = array('active' => $this->input->post('status[0]'));
                    $data = array(
                    'fname' => $this->input->post('fname'),
                    'mname' => $this->input->post('mname'),
                    'lname' => $this->input->post('lname'),
                    'dob' => $this->input->post('dob'),
                    'sex' => $this->input->post('gender[0]'),
                    'phone' => $this->input->post('phone'),
                    'home' => $this->input->post('office_number'),
                    'email' => $this->input->post('email'),
                    'ward_id' => $this->input->post('ward'),
                    );
            }
                    
                    $update = $this->Model_patient->edit($data,$id,$accountdata);
                    if($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('patients/', 'refresh');
                        }
                        else {
                            $this->session->set_flashdata('errors', $update);
                            redirect('patients/edit/'.$id, 'refresh');
                        }

                // }
            }
            else{

                $patient_data = $this->Model_patient->get_patient_data($id);
                $this->data['patient_data'] = $patient_data;
                $this->render_template('Patients/edit',$this->data);  
            }


            }
            else{
                redirect('patients','refresh');
            }

    }
    public function delete($id)
    {
        if(!in_array('deletePatient', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if($id) {
            if($this->input->post('confirm')) {
                    $delete = $this->Model_patient->delete($id);
                    if($delete == true) {
                        $this->session->set_flashdata('success', 'Successfully removed');
                        redirect('Patients/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Patients/', 'refresh');
                    }

            }   
        }
    }
}
<?php 
class Doctors extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->model('Model_doctor');
		$this->not_logged_in();
		$this->data['page_title'] = 'Doctors';
	}

	public function index()
	{
        $employees_data = $this->Model_doctor->get_doctor_data();
		$result = array();
        foreach ($employees_data as $k => $v) {

             $result[$k]['user_info'] = $v;
             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
                // echo ' k is'.$k.'<br>';
        }

        $this->data['user_data'] = $result;

        $this->render_template('doctors/index',$this->data);
	}
    // public function do_upload()
    // {
    //     $config['upload_path'] = './uploads/';
    //     $config['allowed_types'] = 'gif|jpg|png';
    //     $config['max_size'] = '100';
    // }
    public function delete($id)
    {
        if($id) {
            if($this->input->post('confirm')) {
                    $delete = $this->Model_doctor->delete($id);
                    if($delete == true) {
                        $this->session->set_flashdata('success', 'Successfully removed');
                        redirect('Doctors/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Doctors/', 'refresh');
                    }

            }   
        }
    }
	public function add(){

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
                'roleId' => 2,
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

        	$create = $this->Model_doctor->add($account,$data);
        	if($create == 'Success') {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Doctors/add', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', $create);
        		redirect('Doctors/add', 'refresh');
        	}
        }
        else {
            // false case
        	// $group_data = $this->model_groups->getGroupData();
        	// $this->data['group_data'] = $group_data;
            $this->render_template('Doctors/add', $this->data);
        }	
	}
    public function edit($id = null){
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
                if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))){
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
                    'officeno' => $this->input->post('office_number'),
                    'email' => $this->input->post('email'),
                    'ward_id' => $this->input->post('ward'),
                    );
            }
                    
                    $update = $this->Model_doctor->edit($data,$id,$accountdata);
                    if($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('Doctors/', 'refresh');
                        }
                        else {
                            $this->session->set_flashdata('errors', $update);
                            redirect('Doctors/edit/'.$id, 'refresh');
                        }

                }
            }
            else{

                $doctor_data = $this->Model_doctor->get_doctor_data($id);
                $this->data['doctor_data'] = $doctor_data;
                $this->render_template('Doctors/edit',$this->data);  
            }


            }
            else{
                redirect('Doctors','refresh');
            }

    }
    // public function edit($id = null){
        
    //     if($id != 1) {
    //         $this->form_validation->set_rules('groups', 'Group', 'required');
    //         $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
    //         $this->form_validation->set_rules('email', 'Email', 'trim|required');
    //         $this->form_validation->set_rules('fname', 'First name', 'trim|required');


    //         if ($this->form_validation->run() == TRUE) {
    //             // true case
    //             if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
    //                 $data = array(
    //                     'username' => $this->input->post('username'),
    //                     'email' => $this->input->post('email'),
    //                     'firstname' => $this->input->post('fname'),
    //                     'lastname' => $this->input->post('lname'),
    //                     'phone' => $this->input->post('phone'),
    //                     'gender' => $this->input->post('gender'),
    //                 );

    //                 $update = $this->model_users->edit($data, $id, $this->input->post('groups'));
    //                 if($update == true) {
    //                     $this->session->set_flashdata('success', 'Successfully created');
    //                     redirect('users/', 'refresh');
    //                 }
    //                 else {
    //                     $this->session->set_flashdata('errors', 'Error occurred!!');
    //                     redirect('users/edit/'.$id, 'refresh');
    //                 }
    //             }
    //             else {
    //                 $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
    //                 $this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

    //                 if($this->form_validation->run() == TRUE) {

    //                     $password = $this->password_hash($this->input->post('password'));

    //                     $data = array(
    //                         'username' => $this->input->post('username'),
    //                         'password' => $password,
    //                         'email' => $this->input->post('email'),
    //                         'firstname' => $this->input->post('fname'),
    //                         'lastname' => $this->input->post('lname'),
    //                         'phone' => $this->input->post('phone'),
    //                         'gender' => $this->input->post('gender'),
    //                     );

    //                     $update = $this->model_users->edit($data, $id, $this->input->post('groups'));
    //                     if($update == true) {
    //                         $this->session->set_flashdata('success', 'Successfully updated');
    //                         redirect('users/', 'refresh');
    //                     }
    //                     else {
    //                         $this->session->set_flashdata('errors', 'Error occurred!!');
    //                         redirect('users/edit/'.$id, 'refresh');
    //                     }
    //                 }
    //                 else {
    //                     // false case
    //                     $user_data = $this->model_users->getUserData($id);
    //                     $groups = $this->model_users->getUserGroup($id);

    //                     $this->data['user_data'] = $user_data;
    //                     $this->data['user_group'] = $groups;

    //                     $group_data = $this->model_groups->getGroupData();
    //                     $this->data['group_data'] = $group_data;

    //                     $this->render_template('users/edit', $this->data);  
    //                 }   

    //             }
    //         }
    //         else {
    //             // false case
    //             // $user_data = $this->model_users->getUserData($id);
    //             // $groups = $this->model_users->getUserGroup($id);

    //             // $this->data['user_data'] = $user_data;
    //             // $this->data['user_group'] = $groups;

    //             // $group_data = $this->model_groups->getGroupData();
    //             // $this->data['group_data'] = $group_data;

    //             $this->render_template('Doctors/edit', $this->data);  
    //         }   
    //     }

    // }   
        
}

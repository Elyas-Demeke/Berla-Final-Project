<?php 
class Groups extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
        $this->load->model('Model_group');
		$this->data['page_title'] = 'Groups';
	}

	public function index()
	{
        $role_data = $this->Model_group->get_role_data();
		$result = array();
        foreach ($role_data as $k => $v) {
             $result[$k]['role_info'] = $v;
             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
                // echo ' k is'.$k.'<br>';
        }

        $this->data['role_data'] = $result;

        $this->render_template('groups/index',$this->data);
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
	public function create(){
        // if(!in_array('createGroup', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
            $data = array(
                'name' => $this->input->post('group_name'),
                'permission' => $permission
            );

            $create = $this->model_groups->create($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully created');
                redirect('groups/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('groups/create', 'refresh');
            }
        }
        else {
            // false case
            $this->render_template('groups/create', $this->data);
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

                // }//
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
}
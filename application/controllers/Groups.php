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
        if(!in_array('viewRole', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
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
    public function delete($id)
    {
        if(!in_array('deleteRole', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if($id) {
            if($this->input->post('confirm')) {
                    $delete = $this->Model_group->delete($id);
                    if($delete == true) {
                        $this->session->set_flashdata('success', 'Successfully removed');
                        redirect('Groups/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Groups/', 'refresh');
                    }

            }   
        }
    }
	public function create(){
        // if(!in_array('createGroup', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        if(!in_array('createRole', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
            $data = array(
                'name' => $this->input->post('group_name'),
                'permission' => $permission
            );

            $create = $this->Model_group->create($data);
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
            if(!in_array('updateRole', $this->permission)) {
            redirect('dashboard', 'refresh');
            }
            $this->form_validation->set_rules('group_name', 'Group name', 'required');

            if ($this->form_validation->run() == TRUE) {
                // true case
                $permission = serialize($this->input->post('permission'));
                
                $data = array(
                    'name' => $this->input->post('group_name'),
                    'permission' => $permission
                );

                $update = $this->Model_group->edit($id,$data);
                if($update == true) {
                    $this->session->set_flashdata('success', 'Successfully updated');
                    redirect('groups/', 'refresh');
                }
                else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('groups/edit/'.$id, 'refresh');
                }
            }
            else {
                $group_data = $this->Model_group->get_role_data($id);
                $this->data['group_data'] = $group_data;
                $this->render_template('groups/edit', $this->data);
            } 
    }
}
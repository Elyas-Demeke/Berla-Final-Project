<?php 
class Wards extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
        $this->load->model('Model_ward');
		$this->data['page_title'] = 'Ward';
	}
    public function index(){
        if(!in_array('viewWard', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $role_data = $this->Model_ward->get_ward_data();
        $result = array();
        foreach ($role_data as $k => $v) {
             $result[$k]['ward_info'] = $v;
             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
                // echo ' k is'.$k.'<br>';
        }

        $this->data['ward_data'] = $result;

        $this->render_template('Ward/index',$this->data);
    }

}
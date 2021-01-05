<?php 
class Laboratories extends Admin_controller
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
        $this->load->model('Model_laboratory');
        $this->load->model('Model_Appointment');
		$this->data['page_title'] = 'Laboratory';
	}

	public function index()
	{
        if(!in_array('viewLabTest', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        $test_data = $this->Model_laboratory->get_test_data();
		$result = array();
        foreach ($test_data as $k => $v) {

             $checksubmit = $this->Model_laboratory->checksubmit($v['testId']);
             $v += array('submitted' => $checksubmit);
             $result[$k]['test_info'] = $v;


             // echo "v is ".$v['username'];
            // $role = $this->Model_doctor->getUserRole($v['empid']);
            //  $result[$k]['user_role'] = $role;
                // echo ' k is'.$k.'<br>';
        }

        $this->data['test_data'] = $result;

        $this->render_template('Laboratory/index',$this->data);
	}
    public function delete($id)
    {
        if(!in_array('deleteLabTest', $this->permission)) {
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
    public function submit($id = null)
    {
         if(!in_array('updateLabTest', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        
            $this->form_validation->set_rules('result', 'Test Result', 'trim|required');

        if ($this->form_validation->run() == TRUE ) {
            $data = array(
                'lab_test_id' => $id,
                'result' => $this->input->post('result'),
                'completion_date' => date("Y-m-d H:i:s", strtotime($this->input->post('time'))),            
            );

            $submit = $this->Model_laboratory->submit($data);
            if($submit == true) {
                $this->session->set_flashdata('success', 'Successfully submitted');
                redirect('Laboratories/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Laboratories/submit/'.$id, 'refresh');
            }

        }
        else {
            $checksubmit = $this->Model_laboratory->checksubmit($id);
            if(!$checksubmit){

                $test_data = $this->Model_laboratory->get_test_data($id);
                $this->data['test_data'] = $test_data;
                $this->render_template('Laboratory/submit', $this->data);
            }
            else{
                $test_data = $this->Model_laboratory->get_result($id);
                $this->data['test_data'] = $test_data;
                $this->render_template('Laboratory/result', $this->data);
            }
        }
    }
	public function order($id = null){
        if(!in_array('createLabTest', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

    	
            $this->form_validation->set_rules('type', 'Lab Test Type', 'trim|required');
            $this->form_validation->set_rules('time', 'Date & Time', 'trim|required');

        if ($this->form_validation->run() == TRUE ) {
            $data = array(
                'pat_id' => $id,
                'doctor_id' => $this->session->userdata('id'),
                'test_order_time' => date("Y-m-d H:i:s", strtotime($this->input->post('time'))),
                'test_name' => $this->input->post('type'),             
            );

            $order = $this->Model_laboratory->order($data);
            if($order == true) {
                $this->session->set_flashdata('success', 'Successfully ordered');
                redirect('Laboratories/', 'refresh');
            }
            else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('Laboratories/order/'.$id, 'refresh');
            }

        }
        else {

            $patient_data = $this->Model_Appointment->get_patient_data($id);
            $this->data['patient_data'] = $patient_data;
            $this->render_template('Laboratory/order', $this->data);
        }	
	}
    public function edit($id = null){
        if(!in_array('updateLabTest', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

           $this->form_validation->set_rules('result', 'Test Result', 'trim|required');

            if($id)
            {// if called properly from the edit button

                if($this->form_validation->run() == TRUE)
                {
                    $data = array(
                        'result' => $this->input->post('result'),
                        'completion_date' => date("Y-m-d H:i:s", strtotime($this->input->post('time'))),            
                    );


                    $update = $this->Model_laboratory->edit($id, $data);
                    if($update == true) {
                            $this->session->set_flashdata('success', 'Successfully updated');
                            redirect('Laboratories/', 'refresh');
                        }
                    else {
                        $this->session->set_flashdata('errors', $update);
                        redirect('Laboratories/edit/'.$id, 'refresh');
                    }
                }

                // }//
                
                else
                {
                        $test_data = $this->Model_laboratory->get_result($id);
                        $this->data['test_data'] = $test_data;
                        $this->render_template('Laboratory/edit', $this->data);    
                }
            }
            else
            {
                redirect('Laboratories', 'refresh');
            }
            
            

    }
}
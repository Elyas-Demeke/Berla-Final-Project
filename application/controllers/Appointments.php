<?php 
class Appointments extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		 // $this->load->model('Model_patient');
		 $this->load->model('Model_Appointment');
		$this->data['page_title'] = 'Appointment';
	}

	/* 
	* It only redirects to the manage category page
	* It passes the total product, total paid orders, total users, and total stores information
	into the frontend.
	*/
	public function index()
	{

		// $user_id = $this->session->userdata('id');
		// $is_admin = ($user_id == 1) ? true :false;

		// $this->data['is_admin'] = $is_admin;
		 if(!in_array('viewAppointment', $this->permission)) {
		 	redirect('dashboard', 'refresh');
		 }
		 $Appointment_data = $this->Model_Appointment->get_appt_data();
        $result = array();
        foreach ($Appointment_data as $k => $v) {

             $result[$k]['appt_info'] = $v;
        }
        $this->data['appt_data'] = $result;
		$this->render_template('Appointment/index', $this->data);
		// $this->load->view('welcome_message',$this->data);
	}
	public function make($id = null)
	{
            if(!in_array('createAppointment', $this->permission)) {
            redirect('dashboard', 'refresh');
            }
		
			$this->form_validation->set_rules('status[]', 'Appointment Status', 'trim|required');
			$this->form_validation->set_rules('reason', 'Reason', 'trim|required');
			$this->form_validation->set_rules('time', 'Date & Time', 'trim|required');

        if ($this->form_validation->run() == TRUE) {
            // true case
        	$data = array(
        		'patient_id' => $id,
        		'doctor_id' => $this->session->userdata('id'),
        		'appt_date' => date("Y-m-d H:i:s", strtotime($this->input->post('time'))),
        		'status' => $this->input->post('status[0]'),
        		'reason'	=> $this->input->post('reason')        		
        	);

        	$create = $this->Model_Appointment->make($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('Appointments/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('Appointments/make', 'refresh');
        	}
        }
        else 
        {
            // false case
        	// $group_data = $this->model_groups->getGroupData();
        	// $this->data['group_data'] = $group_data;
        	 $patient_data = $this->Model_Appointment->get_patient_data($id);
        	 $user_id = $this->session->userdata('id');
        	 
	         $this->data['patient_data'] = $patient_data;
            $this->render_template('Appointment/add', $this->data);
        }
	}
	public function edit($id = null){
            if(!in_array('updateAppointment', $this->permission)) {
            redirect('dashboard', 'refresh');
            }
           if($id){

			$this->form_validation->set_rules('status[]', 'Appointment Status', 'trim|required');
			$this->form_validation->set_rules('reason', 'Reason', 'trim|required');
			$this->form_validation->set_rules('time', 'Date & Time', 'trim|required');

		        if ($this->form_validation->run() == TRUE) {
		            // true case
		        	$data = array(
		        		'patient_id' => $id,
		        		'doctor_id' => $this->session->userdata('id'),
		        		'appt_date' => date("Y-m-d H:i:s", strtotime($this->input->post('time'))),
		        		'status' => $this->input->post('status[0]'),
		        		'reason'	=> $this->input->post('reason')        		
		        	);

		        	$update = $this->Model_Appointment->edit($id, $data);
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated');
		        		redirect('Appointments/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('Appointments/make', 'refresh');
		        	}
		        }
	            else{

	                $patient_data = $this->Model_Appointment->get_appt_data($id);
	                $this->data['appt_data'] = $patient_data;
	                $this->render_template('Appointment/edit',$this->data);  
	            }


            }
           
        
            else{
                redirect('Appointment','refresh');
            }

    }
    public function delete($id = null)
    {
    	if(!in_array('deleteAppointment', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
        if($id) {
            if($this->input->post('confirm')) {
                    $delete = $this->Model_Appointment->delete($id);
                    if($delete == true) {
                        $this->session->set_flashdata('success', 'Successfully removed');
                        redirect('Appointments/', 'refresh');
                    }
                    else {
                        $this->session->set_flashdata('error', 'Error occurred!!');
                        redirect('Appointments/', 'refresh');
                    }

            }   
        }
    }
}